<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
            <tr>
                <td>小区名</td>
                <td><input type="text" name="d_name" value="{{$data->d_name}}"></td>
            </tr>
            <tr>
                <td>地理位置</td>
                <td><input type="text" name="d_add" value="{{$data->d_add}}"></td>
            </tr>
            <tr>
                <td>面积</td>
                <td><input type="text" name="d_square" value="{{$data->d_square}}"></td>
            </tr>
            <tr>
                <td>导购员</td>
                <td><input type="text" name="d_yuan" value="{{$data->d_yuan}}"></td>
            </tr>
            <tr>
                <td>联系电话</td>
                <td><input type="text" name="d_tel" value="{{$data->d_tel}}"></td>
            </tr>
            <tr>
                <td>图片</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$data->d_img}}" width="50" height="50"></td>
            </tr>
        </table>
</body>
</html>