<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoookModel extends Model
{
    protected $table = 'book';
    protected $primaryKey = 'b_id';
//    屏蔽时间
    public $timestamps = false;
}
