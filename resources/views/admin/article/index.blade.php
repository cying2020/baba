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
<a href="{{url('/article/create')}}"> 添加</a>
<form action="">
    <input type="text" name="a_biaoti" placeholder="请输入文章标题">
    <select name="a_cate">
        <option value="0">请选择</option>
        <option value="1">手机促销</option>
        <option value="2">3G资讯</option>
        <option value="3">站内快讯</option>
    </select>
    <button>搜索</button>
</form>
<table border="1">
    <tr>
        <td>编号</td>
        <td>文章标题</td>
        <td>文章分类</td>
        <td>文章重要性</td>
        <td>是否显示</td>
        <td>添加日期</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->a_id}}</td>
        <td><img src="{{env('UPLOAD_URL')}}{{$v->a_img}}" width="50" height="50">{{$v->a_biaoti}}</td>
        <td>{{$v->a_cate}}</td>
        <td>{{$v->a_zhong}}</td>
        <td>{{$v->a_xian=='显示'? '√' : '×' }}</td>
        <td>{{date('Y-m-d H:i:s',$v->a_time)}}</td>
        <td>
            <a href="{{url('/article/edit',$v->a_id)}}">编辑</a>
            <a href="{{url('/article/destroy',$v->a_id)}}">删除</a>
        </td>
    </tr>
    @endforeach

        <td colspan="4">{{$data->appends($query)->links()}}</td>

</table>
</body>
</html>