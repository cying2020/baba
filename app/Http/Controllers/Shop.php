<?php

namespace App\Http\Controllers;
use App\ShopModel;
use Illuminate\Http\Request;
use App\BrandModel;
use App\Category;
use App\CartModel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;
class Shop extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');
        $s_name = request()->s_name??'';
        $where = [];
        if($s_name){
            $where[] = ['s_name','like',"%$s_name%"];
        }
        $data = ShopModel::select('shop.*','brand.brand_name','category.cate_name')
                ->leftjoin('brand','shop.brand_id','=','brand.brand_id')
                ->leftjoin('category','shop.cate_id','=','category.cate_id')
                ->where($where)
                ->paginate($pageSize);
//        dd($data);
        $query = request()->all();
        if(request()->ajax()){
            return view('admin.shop.ajaxindex',['data'=>$data,'query'=>$query]);
        }
        return view('admin.shop.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        获取品牌数据
        $brand = BrandModel::get();
//        获取分类数据
        $category = Category::get();
        $category = createTree($category);
        return view('admin.shop.create',[
            'brand' => $brand,
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request -> except('_token');
//        单文件上传
        if($request->hasFile('s_img')){
            $post['s_img'] = upload('s_img');
        }
//        多文件上传
        if($post['s_imgs']){
            $post['s_imgs'] = moreupload('s_imgs');
            $post['s_imgs'] = implode('|',$post['s_imgs']);
        }
        $post['add_time'] = time();
        $post['update_time'] = time();

        $res = ShopModel::insert($post);
        if($res){
            return redirect('/shop');
        }
    }

    public function upload($filename){
        if (request()->file($filename)->isValid()) {
//            接收文件
            $photo = request()->file($filename);
//            上传文件
            $store_result = $photo->store('uploads');
            return $store_result;
        }
        exit('没有文件上传或者文件上传出错');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = Redis::setnx('show_'.$id,1);
        if(!$res){
            Redis::incr('show_'.$id);
        }
        $current = Redis::get('show_'.$id);
        $shop = ShopModel::find($id);
        return view('admin.shop.show',['shop'=>$shop,'current'=>$current]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = BrandModel::get();
        $cate = Category::get();
        $data = ShopModel::find($id);
        return view('admin.shop.edit',['data'=>$data,'brand'=>$brand,'cate'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');
        $res = ShopModel::where('s_id',$id)->update($post);
        if($res !== false){
            return redirect('/shop');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = ShopModel::destroy($id);
        if($res){
            return redirect('/shop');
        }
    }

//    添加购物车
    public function addcart(){
        $s_id = request()->s_id;
        $buy_number = 1;
//        判断用户是否登录
        if(!$this->isLogin()){
//            不允许用户存入cookie
//            echo json_encode(['code'=>'00001','msg'=>'未登录，请登录']);die;
//            未登录存入cookie
            $this->addCookiecart($s_id,$buy_number);
        }
//        登录存入数据库
        $this->addDBcart($s_id,$buy_number);
    }

    public function addCookiecart($s_id,$buy_number){
        //       求商品信息
        $shop = ShopModel::where('s_id',$s_id)->first();
        $data['cart_'.$s_id] = [
            's_id'=>$s_id,
            'buy_number'=>1,
            's_price'=>$shop->s_price,
            'addtime'=>time(),
        ];
        dd($data);
        $res = Cookie::queue('cart',$data,30);
        dd($res);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'加入购物车成功']);die;
        }
    }

    public function addDBcart($s_id,$buy_number){
//       求商品信息
        $shop = ShopModel::where('s_id',$s_id)->first();
        //       判断库存
        if($shop->s_number<$buy_number){
            echo json_encode(['code'=>'00002','msg'=>'库存不足']);die;
        }

        $u_id = session('admin')['u_id'];
//        判断用户是否之前购买过
        $cart = CartModel::where(['s_id'=>$s_id,'u_id'=>$u_id])->first();
        if($cart){
            //       判断库存
            if($cart->buy_number+$buy_number>$shop->s_number){
                echo json_encode(['code'=>'00002','msg'=>'库存不足']);die;
            }
            //更新购买数量
            $res = CartModel::where(['s_id'=>$s_id,'u_id'=>$u_id])->increment('buy_number');
            if($res){
                echo json_encode(['code'=>'00000','msg'=>'加入购物车成功']);die;
            }
        }
//        没有购买过 则 正常添加数据

        $data = [
            'u_id'=>$u_id,
            's_id'=>$s_id,
            'buy_number'=>1,
            's_price'=>$shop->s_price,
            'addtime'=>time(),
        ];
        $res = CartModel::insert($data);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'加入购物车成功']);die;
        }
    }

    public function isLogin(){
        $user = session('admin');
        if(!$user){
            return false;
        }
        return true;
    }
}
