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
             <td>ID</td>
             <td>姓名</td>
             <td>性别</td>
             <td>班级</td>
             <td>操作</td>
         </tr>
         @foreach ($data as $v)
         <tr>
             <td>{{$v->s_id}}</td>
             <td>{{$v->s_name}}</td>
             <td>{{$v->s_sex}}</td>
             <td>{{$v->s_class}}</td>
             <td>
                 <a href="{{url('/students/edit',$v->s_id)}}">编辑</a>
                 <a href="{{url('/students/destroy',$v->s_id)}}">删除</a>
             </td>
         </tr>
         @endforeach
         <tr>
             <td colspan="4">{{$data->links()}}</td>
         </tr>
     </table>
</body>
</html>