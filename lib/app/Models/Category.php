<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    protected $primaryKey = 'cate_id';
    protected $guarded = [];// không có trường nào được bảo vệ vì tương tác với tất cả cở sở dữ liệu
}
