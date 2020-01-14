<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="\static\admin\css\bootstrap.min.css">
    <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h3>品牌展示</h3>
<a href="{{url('/brand/create')}}">添加</a>
<h3>欢迎 【{{session('admin')->u_name??''}}】登录，<a href="{{'/login'}}">退出</a></h3>
<form>
    <input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入关键字">
    <input type="text" name="brand_desc" value="{{$query['brand_desc']??''}}" placeholder="请输入描述关键字">
    <button>搜索</button>
</form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>品牌名称</th>
                <th>品牌网址</th>
                <th>品牌描述</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
          @foreach($data as $v)
            <tr>
                <td>{{$v->brand_id}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="50" height="50"/>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
                <td>{{$v->brand_desc}}</td>
                <td><a href="{{url('/brand/edit',$v->brand_id)}}" class="btn btn-info">编辑</a>
                    <a onclick="ajaxdel({{$v->brand_id}})" href="javascript:void(0)" class="btn btn-danger">删除</a>
                </td>
            </tr>
           @endforeach
        <tr>
            <td colspan="4">{{$data->appends($query)->links()}}</td>
        </tr>
        </tbody>
    </table>
<script>
// ajax删除
//     function ajaxdel(id){
    //    第一种
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    // }
    // });
    //     $.ajax({
    //         method: "POST",
    //         url: "/brand/destroy/" + id,
    //         data: '',
    //         dataType:'json',
    //     }).done(function(res){
    //         if(res.code=='00000'){
    //             alert(res.msg);
    //             location.reload();
    //         }
    //     })

    //    第二种
        function ajaxdel(id){
            if(!id){
                return;
            }
            $.get('/brand/destroy/'+id,function(res){
                if(res.code=='00000') {
                    alert(res.msg);
                    location.reload();
                }
            },'json');
        }


    {{--ajax分页--}}
    // $('.pagination a').click(function(){
    $(document).on('click','.pagination a',function(){
       var url = $(this).attr('href');

       $.get(url,function(res){
          $('tbody').html(res);
       });
       return false;
    });
</script>
</body>
</html>