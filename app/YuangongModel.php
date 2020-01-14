<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YuangongModel extends Model
{
    protected $table = 'yuangong';
    protected $primaryKey = 'y_id';
    public $timestamps = false;
}