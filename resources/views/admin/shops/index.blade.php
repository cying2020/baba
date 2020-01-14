<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
</head>
<body>

<table border="1">
    <tr>
        <td>编号</td>
        <td>商品名称</td>
        <td>图片</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->s_id}}</td>
        <td>{{$v->s_name}}</td>
        <td><img src="{{env('UPLOAD_URL')}}{{$v->s_img}}" width="50" height="50"></td>
        <td>
            <a onclick="ajaxdel({{$v->s_id}})" href="javascript:void(0)">删除</a>
        </td>
    </tr>
    @endforeach
    <tr>
        <td>{{$data->links()}}</td>
    </tr>
</table>
<script>
    function ajaxdel(id){
        if(!id){
            return;
        }
        $.get('/shops/destroy/'+id,function(res){
            if(res.code=='00000') {
                alert(res.msg);
                location.reload();
            }
        },'json');
    }
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