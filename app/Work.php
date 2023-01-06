<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'id_car','name','phone', 'status', 'lat','lng',
    ];
}
