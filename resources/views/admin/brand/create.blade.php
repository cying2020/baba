<link rel="stylesheet" href="\static\admin\css\bootstrap.min.css">
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<h3>品牌添加</h3>
{{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
        {{--<ul>--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--@endif--}}
<form class="form-horizontal" action="{{url('/brand/store')}}" role="form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" name="brand_name" class="form-control" value="{{session('data')['brand_name']}}" id="firstname" placeholder="请输入名字">
            <b style="color: red">{{ $errors->first('brand_name') }}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" name="brand_url" class="form-control" id="lastname" placeholder="请输入姓">
            <b style="color: red">{{ $errors->first('brand_url') }}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="col-sm-10">
            <input type="file" name="brand_logo" class="form-control" id="lastname" placeholder="请输入姓">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-10">
            <textarea type="text" name="brand_desc" class="form-control" id="lastname" placeholder="请输入姓"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-default">添加</button>
        </div>
    </div>
</form>
<script>


    $('input[name="brand_name"]').blur(function(){
        $(this).next().text('');
        var brand_name = $(this).val();
        checkname(brand_name);
    });

    $('input[name="brand_url"]').blur(function(){
        $(this).next().text('');
        var brand_url = $(this).val();
        checkUrl(brand_url);
    });

    function checkUrl(brand_url){
        var reg = /^http:\/\/*/;
        if(!reg.test(brand_url)){
            $('input[name="brand_url"]').next().text('品牌网址需以http开头!');
            return false;
        }
        return true;
    }

    function checkname(brand_name){
        var flag = true;
        var reg = /^[\u4e00-\u9fa5\w.\-]{1,16}$/;
        if(!reg.test(brand_name)){
            $('input[name="brand_name"]').next().text('品牌名称需要是中文、字母、数字、下划线、点和-组成长度为1-16位！');
            return false;
        }
        //ajax验证唯一性
            $.ajax({
                method:"get",
                url:"/brand/checkOnly",
                data:{brand_name:brand_name},
                async:false,
            }).done(function(res){
                if(res!=0){
                    $('input[name="brand_name"]').next().text('品牌名称已存在');
                    flag = false;
                }
            });
        return flag;
    }

//    提交验证
    $('[type="button"]').click(function(){
    //    名称
        $('input[name="brand_name"]').next().text('');
        var brand_name = $('input[name="brand_name"]').val();
        var nameflag = checkname(brand_name);

    //    网址
        $('input[name="brand_url"]').next().text('');
        var brand_url = $('input[name="brand_url"]').val();
        var urlflag = checkUrl(brand_url);
        if(nameflag==true && urlflag==true){
            $('form').submit();
        }

    });

</script>