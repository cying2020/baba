<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopModel extends Model
{
    protected $table = 'shop';
    protected $primaryKey = 's_id';
    public $timestamps = false;
}
