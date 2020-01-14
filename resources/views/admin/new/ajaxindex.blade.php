
@foreach($data as $v)
    <tr>
        <td>{{$v->n_id}}</td>
        <td>{{$v->n_biaoti}}</td>
        <td>{{$v->c_name}}</td>
        <td>{{$v->n_zuozhe}}</td>
    </tr>
@endforeach
<tr>
    <td colspan="4">{{$data->appends($query)->links()}}</td>
</tr>
