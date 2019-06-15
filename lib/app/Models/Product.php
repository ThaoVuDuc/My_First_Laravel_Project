<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    //bảng
    protected $table = 'products';
    protected $primaryKey = 'prod_id';
    protected $guarded = [];
}
