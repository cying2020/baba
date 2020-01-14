
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<table border="1">
    <tr>
        <td>id</td>
        <td>小区名</td>
        <td>地理位置</td>
        <td>面积</td>
        <td>导购员</td>
        <td>联系电话</td>
        <td>楼盘主图</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->d_id}}</td>
        <td><a href="{{url('district/xiangqing',$v->d_id)}}">{{$v->d_name}}</a></td>
        <td>{{$v->d_add}}</td>
        <td>{{$v->d_square}}</td>
        <td>{{$v->d_yuan}}</td>
        <td>{{$v->d_tel}}</td>
        <td><img src="{{env('UPLOAD_URL')}}{{$v->d_img}}" width="50" height="50"></td>
        <td>
        <a onclick="ajaxdel({{$v->d_id}})" href="javascript:void(0)">删除</a>
        </td>
    </tr>
    @endforeach
</table>
<script>
  function ajaxdel(id){
            if(!id){
                return;
            }
            $.get('/district/destroy/'+id,function(res){
                if(res.code=='00000') {
                    alert(res.msg);
                    location.reload();
                }
            },'json');
        }
</script>