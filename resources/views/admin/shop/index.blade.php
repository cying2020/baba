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
</head>
<body>

<a href="{{url('/shop/create')}}">添加</a>
<h3>欢迎 【{{session('admin')->u_name??''}}】登录，<a href="{{'/logins'}}">退出</a></h3>
<form>
    <input type="text" name="s_name" value="{{$query['s_name']??''}}" placeholder="请输入商品关键字">
    <button>搜索</button>
</form>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>商品名称</th>
        <th>商品货号</th>
        <th>品牌名称</th>
        <th>分类名称</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $v)
        <tr>
            <td>{{$v->s_id}}</td>
            <td>{{$v->s_name}}</td>
            <td>{{$v->s_sn}}</td>
            <td>{{$v->brand_name}}</td>
            <td>{{$v->cate_name}}</td>
            <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
            <td><a href="{{url('/shop/show',$v->s_id)}}" class="btn btn-info">预览</a>
                <a href="{{url('/shop/edit',$v->s_id)}}" class="btn btn-info">编辑</a>
                <a href="{{url('/shop/destroy',$v->s_id)}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="4">{{$data->appends($query)->links()}}</td>
    </tr>
    </tbody>
</table>
<script>
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