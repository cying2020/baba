<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$shop->s_name}}</title>
    <link rel="stylesheet" href="\static\admin\css\bootstrap.min.css">
    <script src="/static/admin/js/jquery-3.2.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h3>{{$shop->s_name}}</h3>
    <span>访问量：{{$current}}</span>
    <hr/>
       <p>价格：{{$shop->s_price}}</p>
       <p>{{$shop->content}}</p>
    <button>购买</button>
</body>
<script>
    $('button').click(function(){
       var s_id = {{$shop->s_id}};
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
        $.post('/shop/addcart',{s_id:s_id},function(res){
            if(res.code=='00001'){
                alert(res.msg);
                location.href='/logins';
            }
            if(res.code=='00002'){
                alert(res.msg);
            }
            if(res.code=='00000'){
                alert(res.msg);
                location.href='/shop';
            }
        },'json');
    });
</script>
</html>

