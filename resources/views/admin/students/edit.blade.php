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
     <form action="{{url('/students/update',$data->s_id)}}" method="post">
         @csrf
         <table>
             <tr>
                 <td>学生姓名</td>
                 <td><input type="text" name="s_name" value="{{$data->s_name}}"></td>
             </tr>
             <tr>
                 <td>性别</td>
                 <td><input type="text" name="s_sex" value="{{$data->s_sex}}"></td>
             </tr>
             <tr>
                 <td>班级</td>
                 <td><input type="text" name="s_class" value="{{$data->s_class}}"></td>
             </tr>
             <tr>
                 <td></td>
                 <td><input type="submit" value="修改"></td>
             </tr>
         </table>
     </form>
</body>
</html>