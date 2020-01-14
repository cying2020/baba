<form action="{{url('article/store')}}" method="post" enctype="multipart/form-data">
   @csrf
    <table>
        <tr>
            <td>文章标题</td>
            <td><input type="text" name="a_biaoti">
                <b style="color: red">{{ $errors->first('a_biaoti') }}</b>
            </td>
        </tr>
        <tr>
            <td>文章分类</td>
            <td>
                <select name="a_cate">
                    <option value="0">请选择</option>
                    <option value="1">手机促销</option>
                    <option value="2">3G资讯</option>
                    <option value="3">站内快讯</option>
                </select>
                <b style="color: red">{{ $errors->first('a_cate') }}</b>
            </td>
        </tr>
        <tr>
            <td>文章重要性</td>
            <td>
                <input type="radio" name="a_zhong" value="普通" checked>普通
                <input type="radio" name="a_zhong" value="置顶">置顶
                <b style="color: red">{{ $errors->first('a_zhong') }}</b>
            </td>
        </tr>
        <tr>
            <td>是否显示</td>
            <td>
                <input type="radio" name="a_xian" value="显示">显示
                <input type="radio" name="a_xian" value="不显示" checked>不显示
                <b style="color: red">{{ $errors->first('a_xian') }}</b>
            </td>
        </tr>
        <tr>
            <td>文章作者</td>
            <td><input type="text" name="a_zuozhe"></td>
        </tr>
        <tr>
            <td>作者email</td>
            <td><input type="text" name="a_email"></td>
        </tr>
        <tr>
            <td>关键字</td>
            <td><input type="text" name="a_guan"></td>
        </tr>
        <tr>
            <td>网页描述</td>
            <td><textarea name="a_desc"></textarea></td>
        </tr>
        <tr>
            <td>上传文件</td>
            <td><input type="file" name="a_img"></td>
        </tr>
        <tr>
            <td><input type="submit" value="确定"></td>
            <td><input type="reset" value="重置"></td>
        </tr>
    </table>
</form>