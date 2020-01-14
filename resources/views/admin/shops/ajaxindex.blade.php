@foreach($data as $v)
    <tr>
        <td>{{$v->s_id}}</td>
        <td>{{$v->s_name}}</td>
        <td><img src="{{env('UPLOAD_URL')}}{{$v->s_img}}" width="50" height="50"></td>
        <td>
            <a onclick="ajaxdel({{$v->s_id}})" href="javascript:void(0)">删除</a>
        </td>
    </tr>
@endforeach
<tr>
    <td>{{$data->links()}}</td>
</tr>