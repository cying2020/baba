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
<form action="{{url('/yuangong/store')}}" method="post" enctype="multipart/form-data">
    @csrf
     <table>
         <tr>
             <td>员工姓名</td>
             <td><input type="text" name="y_name"></td>
         </tr>
         <tr>
             <td>员工号</td>
             <td><input type="text" name="y_hao"></td>
         </tr>
         <tr>
             <td>部门</td>
             <td><input type="text" name="y_bu"></td>
         </tr>
         <tr>
             <td>员工头像</td>
             <td><input type="file" name="y_img"></td>
         </tr>
         <tr>
             <td></td>
             <td><input type="submit" value="提交"></td>
         </tr>

     </table>
</form>
</body>
</html>