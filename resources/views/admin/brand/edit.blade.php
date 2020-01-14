<link rel="stylesheet" href="\static\admin\css\bootstrap.min.css">
<h3>品牌编辑</h3>
<form class="form-horizontal" action="{{url('/brand/update',$data->brand_id)}}" role="form" method="post">
    @csrf
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" name="brand_name" class="form-control" value="{{$data->brand_name}}" id="firstname" placeholder="请输入名字">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" name="brand_url" class="form-control" value="{{$data->brand_url}}" id="lastname" placeholder="请输入姓">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-10">
            <textarea type="text" name="brand_desc" class="form-control" id="lastname" placeholder="请输入姓">{{$data->brand_desc}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>
</form>