<?php

namespace App\Http\Controllers;
use App\Users;
use Illuminate\Http\Request;

class Logins extends Controller
{
    public function index(){
        return view('admin.logins.index');
    }

    public function do(Request $request){
        $post = $request ->except('_token');
        $user = Users::where($post)->first();
        if($user){
            session(['admin'=>$user]);
            request()->session()->save();
            return redirect('/shop');
        }
        return redirect('logins')->with('msg','没有此用户！请联系管理员');
    }

    public function logout(){
        session(['admin'=>null]);
        request()->session()->save();
        return redirect('/logins');
    }
}

