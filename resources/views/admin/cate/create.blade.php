<link rel="stylesheet" href="\static\admin\css\bootstrap.min.css">
<h3>分类添加</h3>
{{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
        {{--<ul>--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--@endif--}}
<form class="form-horizontal" action="{{url('/cate/store')}}" role="form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">分类名称</label>
        <div class="col-sm-10">
            <input type="text" name="cate_name" class="form-control" id="firstname" placeholder="请输入名字">
            <b style="color: red">{{ $errors->first('brand_name') }}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">父类名称</label>
        <div class="col-sm-10">
            <select name="parent_id" class="form-control">
                <option value="0">请选择父级分类</option>
                <option value=""></option>
                @foreach($data as $v)
                    <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
                @endforeach

            </select>
            <b style="color: red">{{ $errors->first('brand_url') }}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-10">
            <input type="radio" name="is_show" value="1" checked>是
            <input type="radio" name="is_show" value="2">否
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否导航显示</label>
        <div class="col-sm-10">
            <input type="radio" name="is_nav_show" value="1">是
            <input type="radio" name="is_nav_show" value="2" checked>否
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
        </div>
    </div>
</form>