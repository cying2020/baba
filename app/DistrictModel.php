<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictModel extends Model
{
    protected $table = 'district';
    protected $primaryKey = 'd_id';
    public $timestamps = false;
    protected $guarded = [];
}
