<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LostModel extends Model
{
    //
     public $timestamps = false;
     // protected $connection = 'db';
    protected $table = "tablelost";

    protected $fillable = [
        'lost_id',
        'lost_name' ,
        'lost_time' ,
        'lost_place' ,
        'lost_detail',
        'lost_img' ,
        'lost_person' ,
        'lost_phone' ,
        'lost_status' ,
        'created_at' ,
        'found_at',
        'updated_at',

    ];
}
