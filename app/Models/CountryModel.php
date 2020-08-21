<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    //
    protected $table = "demos";

    protected $fillable = [
        'id',
        'name',
        'pass',
        'num',
        'created_at',
        'updated_at',

    ];
}
