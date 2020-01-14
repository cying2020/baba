<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.min.js"></script> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>Document</title>
</head>
<body>
<h3 style="color:red">留言板</h3>
    <form action="{{url('message/store')}}" method="post">
    @csrf
    <input type="hidden" name="user_name" value={{$user_name}}>
    <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">内容</label>
    <div class="col-sm-10">
    <textarea name="message_content" id="" cols="50" rows="5"></textarea>
    </div>
  </div>
    <input type="submit" class="btn btn-danger" value="发布">
    </form>
<h3>留言列表</h3>
<form>
<input type="text" name="user_name" id="" value="{{$query['user_name']??''}}" placeholder="请输入用户名">
<input type="submit" value="搜索">
<form>
<h5>当前页面浏览量：</h5>
<table class="table table-striped">
  <!-- <caption>文章列表</caption> -->
  <thead>
    <tr>
      <th>编号</th>
      <th>留言内容</th>
      <th>姓名</th>
      <th>时间</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($data as $v)
    <tr>
      <td>{{$v->message_id}}</td>
      <td>{{$v->message_content}}</td>
      <td>{{$v->user_name}}</td>
      <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
      <td><a href="{{url('message/destroy/'.$v->message_id)}}" class="btn btn-info">删除</a></td>
    </tr>
@endforeach
    <tr>
    <td colspan="5">{{$data->appends($query)->links()}}</td>
    </tr>
  </tbody>

</table>
</table>
</body>
</html>