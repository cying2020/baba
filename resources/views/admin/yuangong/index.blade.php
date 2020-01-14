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

    <table border="1">
        <tr>
            <td>id</td>
            <td>员工姓名</td>
            <td>员工号</td>
            <td>部门</td>
            <td>员工头像</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->y_id}}</td>
            <td>{{$v->y_name}}</td>
            <td>{{$v->y_hao}}</td>
            <td>{{$v->y_bu}}</td>
            <td>{{$v->y_img}}</td>
            <td>
                <a href="{{url('/yuangong/destroy',$v->y_id)}}">删除</a>
                <a href="{{}}">编辑</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>