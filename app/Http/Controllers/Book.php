<?php

namespace App\Http\Controllers;
use App\BoookModel;
use Illuminate\Http\Request;
use Validator;

use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;


class Book extends Controller
{

    public function sendemail()
    {
//        收件人
        Mail::to('599870032@qq.com')->send(new SendCode());
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BoookModel::get();
        return view('admin.book.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request ->except('_token');
        $validator = Validator::make($post, [
            'b_name' => 'required|unique:book|max:255',
            'b_zuozhe' => 'required',
        ],[
            'b_name.required' => '图书名必填！',
            'b_name.unique' => '图书名已存在！',
            'b_zuozhe.required' => '作者必填！',
        ]);
        if ($validator->fails()) {
            return redirect('book/create')
                ->withErrors($validator)
                ->withInput();
        }
        if(request()->hasFile('b_img')){
            $post['b_img'] = $this->upload('b_img');
        }
        $res = BoookModel::insert($post);
        if($res){
            return redirect('/book');
        }
    }

    public function upload($filename)
    {
        if ( request()->file($filename)->isValid()) {
//            接收文件
            $photo = request()->file($filename);
//            上传文件  目录
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
