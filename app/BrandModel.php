<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
//    屏蔽时间戳
    public $timestamps = false;
//    黑名单create这个方法需要设置
    protected $guarded = [];
}
