<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <td>id</td>
        <td>书名</td>
        <td>作者</td>
        <td>售价</td>
        <td>封面</td>

    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->b_id}}</td>
        <td>{{$v->b_name}}</td>
        <td>{{$v->b_zuozhe}}</td>
        <td>{{$v->b_price}}</td>
        <td><img src="{{env('UPLOAD_url')}}{{$v->b_img}}" width="50" height="50"></td>
    </tr>
    @endforeach
</table>
</body>
</html>