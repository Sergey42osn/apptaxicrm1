<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	//protected $table = 'colors_car';

    protected $fillable = [
        'id_user', 'car_namber', 'id_model','id_brand','id_category','id_color','is_working','is_free',
    ];
}
