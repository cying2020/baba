<?php

namespace App\Http\Controllers;
use App\ArticleModel;
use Illuminate\Http\Request;

class Article extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a_biaoti = request()->a_biaoti??'';
        $where = [];
        if($a_biaoti){
            $where[] = ['a_biaoti','like',"%$a_biaoti%"];
        }
        $a_cate = request()->a_cate??'';
        $where = [];
        if($a_cate){
            $where[] = ['a_cate','=',$a_cate];
        }
        $data = ArticleModel::where($where)->paginate(2);
        $query = request()->all();
        return view('admin.article.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
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
        $post['a_time'] = time();
        if($request->hasFile('a_img')){
           $post['a_img'] = $this->upload('a_img');
        }
        $validatedData = $request->validate([
            'a_biaoti' => 'required|unique:article|max:255',
            'a_cate' => 'required',
            'a_zhong' => 'required',
            'a_xian' => 'required',
        ],[
            'a_biaoti.required' => '文章标题必填！',
            'a_biaoti.unique' => '文章标题已存在！',
            'a_cate.required' => '文章分类必填！',
            'a_zhong.required' => '文章重要性必填！',
            'a_xian.required' => '是否显示必填！',
        ]);

        $res = ArticleModel::insert($post);
        if($res){
            return redirect('/article');
        }
    }


    public function upload($filename){
        if (request()->file($filename)->isValid()) {
            $photo = request()->file($filename);
            $store_result = $photo->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ArticleModel::find($id);
        return view('admin.article.edit',['data'=>$data]);
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
        $res = ArticleModel::where('a_id','=',$id)->update($post);
        if($res !== false){
            return redirect('/article');
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
        $res = ArticleModel::destroy($id);
        if($res){
            return redirect('/article');
        }
    }
}
