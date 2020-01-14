<?php

namespace App\Http\Controllers;
use App\Users;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function index(){
        return view('admin.login.index');
    }

    public function do(Request $request){
        $post = $request ->except('_token');
        $user = Users::where($post)->first();
        if($user){
            session(['admin'=>$user]);
            request()->session()->save();
            return redirect('/message');
        }
        return redirect('login')->with('msg','没有此用户！请联系管理员');
    }

    public function logout(){
        session(['admin'=>null]);
        request()->session()->save();
        return redirect('/login');
    }
}
