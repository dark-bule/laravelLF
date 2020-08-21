<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    // // 加上对应的字段
    protected $fillable = ['name', 'pass','num'];
}
