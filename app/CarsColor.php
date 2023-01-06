<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarsColor extends Model
{
	protected $table = 'colors_car';
	
    protected $fillable = [
        'name_color',
    ];
}
