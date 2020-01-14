<form action="{{url('/news/store')}}" method="post">
    @csrf
    <table>
        <tr>
            <td>新闻标题</td>
            <td><input type="text" name="n_biaoti">
                <b style="color: red">{{ $errors->first('n_biaoti') }}</b>
            </td>
        </tr>
        <tr>
            <td>新闻分类</td>
            <td>
                <select name="c_id" >
                    <option value="0">请选择分类</option>
                    @foreach($data as $v)
                        <option value="{{$v->c_id}}">{{$v->c_name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>新闻作者</td>
            <td><input type="text" name="n_zuozhe">
                <b style="color: red">{{ $errors->first('n_zuozhe') }}</b>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="提交"></td>
            <td></td>
        </tr>
    </table>
</form>