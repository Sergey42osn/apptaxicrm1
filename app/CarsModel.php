<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarsModel extends Model
{
    protected $table = 'name_cars';

    protected $fillable = [
        'name_car','id_model','id_category',
    ];
}
