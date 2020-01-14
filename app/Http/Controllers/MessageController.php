<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Memcache;
use Illuminate\Support\Facades\Cache;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_name=request()->user_name??'';
        $page=request()->page?:1;
        $data=cache('data_'.$page.'_'.$user_name);
        if(!$data){
            echo '走数据库';
         $where=[];
        if($user_name){
            $where[]=['user_name','like',"%$user_name%"];
        }
        $data=DB::table('message')->where($where)->paginate(3);
        cache(['data_'.$page.'_'.$user_name=>$data],40);
    }
        $user_name=session('admin')['u_name'];
        // $result=$this->memcache();
        // dd($result);
        // dd($user_name);
        $query=request()->all();
         return view('admin.message.index',['data'=>$data,'user_name'=>$user_name,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $post=$request->except('_token');
        $post['add_time']=time();
        //dd($post);
        if($post){
            $data=DB::table('message')->insert($post);
            if($data){
                return redirect('message');
            }
        } 
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
        //echo $id;
        $name=session('admin')['u_name'];
        $user_name=DB::table('message')->where('message_id','=',$id)->value('user_name');
        //dd($user_name);
        if($name==$user_name){
          $data=DB::table('message')->where('message_id','=',$id)->delete();  
        }else{
            exit('您不是此留言的主人，请不要打扰哦~');
        }
        if($data){
            return redirect('message');
        }

    }
}
