<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoundModel extends Model
{
    //
     public $timestamps = false;
     // protected $connection = 'db';
    protected $table = "tablefound";

    protected $fillable = [
        'found_name' ,
        'found_time' ,
        'found_place' ,
        'found_detail',
        'found_img' ,
        'found_person' ,
        'found_phone' ,
        'found_status' ,
        'created_at' ,

    ];
}
