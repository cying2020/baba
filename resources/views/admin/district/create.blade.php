<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加</title>
</head>
<body>
    <form action="{{url('/district/store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td>小区名</td>
                <td><input type="text" name="d_name"></td>
            </tr>
            <tr>
                <td>地理位置</td>
                <td><input type="text" name="d_add"></td>
            </tr>
            <tr>
                <td>面积</td>
                <td><input type="text" name="d_square"></td>
            </tr>
            <tr>
                <td>导购员</td>
                <td><input type="text" name="d_yuan"></td>
            </tr>
            <tr>
                <td>联系电话</td>
                <td><input type="text" name="d_tel"></td>
            </tr>
            <tr>
                <td>楼盘主图</td>
                <td><input type="file" name="d_img"></td>
            </tr>
                <td><input type="submit" value="提交"></td>
            <tr>
            </tr>
        </table>
    </form>
</body>
</html>