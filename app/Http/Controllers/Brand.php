<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\BrandModel;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Cache;
class Brand extends Controller
{
    /**
     * Display a listing of the resource.
     *列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        存
//        Cookie::queue('test','aaa',1);
//        取
//        echo Cookie::get('test');
//        showMsg(1,'Hello World!');

        $brand_name = request()->brand_name??'';
        $brand_desc = request()->brand_desc ?? '';
        $page = request()->page?:1;
//        echo 'brand_'.$page.'_'.$brand_name;
//        $data必须要和查询数据库的变量一致
        $data = Cache::get('brand_'.$page.'_'.$brand_name.'_'.$brand_desc);//获取
//        dump($data);
        if(!$data) {
echo "DB";
            $where = [];
            if ($brand_name) {
                $where[] = ['brand_name', 'like', "%$brand_name%"];
            }

            if ($brand_desc) {
                $where[] = ['brand_desc', 'like', "%$brand_desc%"];
            }
//        DB::connection()->enableQueryLog();
//        $data = DB::table('brand')->orderBy('brand_id','desc')->paginate(2);
            $data = BrandModel::where($where)->orderBy('brand_id', 'desc')->paginate(2);
            Cache::put('brand_'.$page.'_'.$brand_name.'_'.$brand_desc, $data, 60); //存储
        }



//        $logs = DB::getQueryLog();
//        dump($logs);
        //        接收全部值
        $query = request()->all();
//        判断是否是ajax请求
        if(request()->ajax()){
            return view('admin.brand.ajaxindex',['data'=>$data,'query'=>$query]);
        }
        return view('admin.brand.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
//        第二种验证
//    public function store(StoreBrandPost $request)
    {

//        第一种验证
//        $validatedData = $request->validate([
//            'brand_name' => 'required|unique:brand|max:255',
//            'brand_url' => 'required',
//        ],[
//            'brand_name.required'=>'品牌名称必填！',
//            'brand_name.unique'=>'品牌名称已存在！',
//            'brand_url.required'=>'品牌网站必填！',
//        ]);
        $post = $request ->except('_token');
        //        第三种验证
        $validator = Validator::make($post, [
//            'brand_name' => 'required|unique:brand|max:255',
            'brand_name' => [
                'required',
                'unique:brand',
                'max:255',
                'regex:/^[\x{4e00}-\x{9fa5}]+$/u',
            ],
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填！',
            'brand_name.regex'=>'品牌名称必须是中文字母数字下划线组成！',
            'brand_name.unique'=>'品牌名称已存在！',
            'brand_url.required'=>'品牌网站必填！',
        ]);
        if ($validator->fails()) {
            return redirect('brand/create')
                ->WITH('data',$post)
                ->withErrors($validator)
                ->withInput();
        }

//        dump($post);
//        DB操作
//        $res = DB::table('brand')->insert($post);

//        文件上传
        if($request->hasFile('brand_logo')){
            $post['brand_logo'] = upload('brand_logo');
        }
//        dd($post);
//        第一种方法
//        $res = BrandModel::create($post);
//        第二种方法
        $res = BrandModel::insert($post);
//        第三种方法
//        $brand = new BrandModel();
//        $brand -> brand_name = $post['brand_name'];
//        $brand -> brand_url = $post['brand_url'];
//        $brand -> brand_logo = $post['brand_logo'];
//        $brand -> brand_desc = $post['brand_desc'];
//        $res = $brand -> save();
        if($res){
            return redirect('/brand');
        }
    }



    /**
     * Display the specified resource.
     *详情展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $data = DB::table('brand')->where('brand_id',$id)->first();
        $data = BrandModel::find($id);
        return view('admin.brand.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');
//        $res = DB::table('brand')->where('brand_id', $id)->update($post);
//        $res = BrandModel::where('brand_id',$id)->update($post);
        $brand = BrandModel::find($id);
        $brand -> brand_name = $post['brand_name'];
        $brand -> brand_url = $post['brand_url'];
//        $brand -> brand_logo = $post['brand_logo'];
        $brand -> brand_desc = $post['brand_desc'];
        $res = $brand ->save();
        if($res !== false){
            return redirect('/brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//        $res = DB::table('brand')->where('brand_id',$id)->delete();
        $res = BrandModel::destroy($id);
        if($res){
            if(request()->ajax()){
                echo json_encode(['code'=>'00000','msg'=>'删除成功']);die;
            }
            return redirect('/brand');
        }
    }

    public function checkOnly(){
        $brand_name = request()->brand_name;
        $where = [];
        if($brand_name){
            $where['brand_name'] = $brand_name;
        }

        $count = BrandModel::where($where)->count();
        echo intval($count);
    }
}
