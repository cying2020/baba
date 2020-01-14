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
<form action="{{url('shops/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>商品名称</td>
            <td><input type="text" name="s_name"></td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td><input type="file" name="s_img"></td>
        </tr>
        <tr>
            <td><input type="submit" value="添加"></td>
            <td></td>
        </tr>
    </table>
</form>
</body>
</html>