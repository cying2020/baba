<link rel="stylesheet" href="\static\admin\css\bootstrap.min.css">
<form class="form-horizontal" action="{{url('shop/update',$data->s_id)}}" role="form" method="post">
    @csrf
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-10">
            <input type="text" name="s_name" class="form-control" value="{{$data->s_name}}" id="firstname" placeholder="请输入名字">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-10">
            <input type="text" name="s_price" class="form-control" value="{{$data->s_price}}" id="lastname" placeholder="请输入姓">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">分类</label>
        <div class="col-sm-10">
            <select name="cate_id">
                @foreach($cate as $v)
                <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                    @endforeach
            </select>
        </div>
    </div><div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌</label>
        <div class="col-sm-10">
            <select name="brand_id">
                @foreach($brand as $vv)
                <option value="{{$vv->brand_id}}">{{$vv->brand_name}}</option>
                    @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>
</form>