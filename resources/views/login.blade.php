<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/login')}}" method="post">
    @csrf
       用户名<input type="text" name="name"><br>
       密码<input type="password" name="pwd">
         <button>提交</button>
    </form>
</body>
</html>