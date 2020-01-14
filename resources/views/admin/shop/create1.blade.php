<!doctype html>
<html lang="sa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('/shop/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>商品名称</td>
            <td><input type="text" name="s_name"></td>
        </tr>
        <tr>
            <td>商品价格</td>
            <td><input type="text" name="s_price"></td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td><input type="file" name="s_img"></td>
        </tr>
        <tr>
            <td>分类</td>
            <td>
                <select name="cate_id">
                    @foreach($cate as $v)
                    <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>品牌</td>
            <td>
                <select name="brand_id">
                    @foreach($brand as $v)
                    <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="提交"></td>
        </tr>
    </table>
</form>
</body>
</html>