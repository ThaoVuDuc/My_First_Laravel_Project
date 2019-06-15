<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comment';
    protected $primaryKey = 'com_id';
    protected $guarded = [];// không có trường nào được bảo vệ vì tương tác với tất cả cở sở dữ liệu
}
