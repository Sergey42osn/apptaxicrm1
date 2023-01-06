<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarsBrands extends Model
{
    protected $table = 'model_cars';

    protected $fillable = [
        'name_model','id_cat',
    ];
}
