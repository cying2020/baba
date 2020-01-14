<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加</title>
</head>
<body>
<form action="{{url('/book/store')}}" method="post" enctype="multipart/form-data">
    @csrf
   <table>
       <tr>
           <td>图书名</td>
           <td><input type="text" name="b_name">
               <b style="color: red">{{ $errors->first('b_name') }}</b>
           </td>
       </tr>
       <tr>
           <td>作者</td>
           <td><input type="text" name="b_zuozhe">
               <b style="color: red">{{ $errors->first('b_zuozhe') }}</b>
           </td>
       </tr>
       <tr>
           <td>售价</td>
           <td><input type="text" name="b_price"></td>
       </tr>
       <tr>
           <td>封面</td>
           <td><input type="file" name="b_img"> </td>
       </tr>
       <tr>
           <td></td>
           <td><input type="submit" value="提交"></td>
       </tr>
   </table>
</form>
</body>
</html>