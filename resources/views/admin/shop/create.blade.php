<link rel="stylesheet" href="\static\admin\css\bootstrap.min.css">
<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
<script src="/static/admin/js/bootstrap.min.js"></script>
<h3>商品添加</h3>
{{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
        {{--<ul>--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--@endif--}}
<form class="form-horizontal" action="{{url('/shop/store')}}" role="form" method="post" enctype="multipart/form-data">
    @csrf

    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#home" data-toggle="tab">
                基础信息
            </a>
        </li>
        <li><a href="#ios" data-toggle="tab">商品相册</a></li>
        <li><a href="#desc" data-toggle="tab">商品详情</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <p>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品名称</label>
                <div class="col-sm-10">
                    <input type="text" name="s_name" class="form-control" id="firstname" placeholder="请输入名字">
                    <b style="color: red"></b>
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品货号</label>
                <div class="col-sm-10">
                    <input type="text" name="s_sn" class="form-control" id="lastname" placeholder="请输入姓">
                    <b style="color: red"></b>
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品品牌</label>
                <div class="col-sm-10">
                    <select name="brand_id" class="form-control">
                        <option value="0">请选择商品品牌</option>
                        @foreach($brand as $v)
                            <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                        @endforeach
                    </select>
                    <b style="color: red"></b>
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品分类</label>
                <div class="col-sm-10">
                    <select name="cate_id" class="form-control">
                        <option value="0">请选择商品分类</option>
                        @foreach($category as $v)
                            <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
                        @endforeach
                    </select>
                    <b style="color: red"></b>
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品价格</label>
                <div class="col-sm-10">
                    <input type="text" name="s_price" class="form-control" id="lastname" placeholder="请输入姓">
                    <b style="color: red"></b>
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品库存</label>
                <div class="col-sm-10">
                    <input type="text" name="s_number" class="form-control" id="lastname" placeholder="请输入姓">
                    <b style="color: red"></b>
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品缩略图</label>
                <div class="col-sm-10">
                    <input type="file" name="s_img" class="form-control" id="lastname" placeholder="请输入姓">
                </div>
            </div>

            </p>
        </div>
        <div class="tab-pane fade" id="ios">
            <p>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品相册</label>
                <div class="col-sm-10">
                    <input type="file" name="s_imgs[]" class="form-control" multiple="multiple" id="lastname" placeholder="请输入姓">
                </div>
            </div>

            </p>
        </div>
        <div class="tab-pane fade" id="desc">
            <p>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品详情</label>
                <div class="col-sm-10">
                    <textarea type="text" name="content" class="form-control" id="lastname" placeholder="请输入姓"></textarea>
                </div>
            </div>
            </p>
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
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