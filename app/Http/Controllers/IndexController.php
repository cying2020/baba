<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function test(){
        $name = '小黑孩';
       return view('hello',['name'=>$name]);    
    }

    public function dologin(){
        $post = request()->all();
        dd($post);
    }

    public function login(){
        $post = request()->all();
        dump($post);
        return view('login');
    }

    public function goods($id){
        echo 'ID:'.$id;
    }

    public function getgoods($goods_id,$goods_name=''){
        echo 'ID：'.$goods_id;
        echo '名称:'.$goods_name;
    }
}
