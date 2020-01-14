@foreach($data as $v)
    <tr>
        <td>{{$v->s_id}}</td>
        <td><img src="{{env('UPLOAD_URL')}}{{$v->s_img}}" width="50" height="50"/>{{$v->s_name}}</td>
        <td>{{$v->s_price}}</td>
        <td>{{$v->cate_id}}</td>
        <td>{{$v->brand_id}}</td>
        <td><a href="{{url('/shop/edit',$v->s_id)}}" class="btn btn-info">编辑</a>
            <a href="{{url('/shop/destroy',$v->s_id)}}" class="btn btn-danger">删除</a>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="4">{{$data->links()}}</td>
</tr>