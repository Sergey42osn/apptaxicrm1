<?php

namespace App;

use App\CarsColor;
use App\CarsBrands;
use App\CarsModel;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	//protected $table = 'colors_car';

    protected $fillable = [
        'id_user', 'car_namber', 'id_model','id_brand','id_category','id_color','is_working','is_free',
    ];

    public function get_car_color()
    {
        return CarsColor::find($this->id_color)->name_color;
    }

    public function get_car_number()
    {
        return $this->car_namber;
    }

    public function get_car_brand()
    {
        return CarsBrands::find($this->id_brand)->name_model;
    }

    public function get_car_model()
    {
        return CarsModel::find($this->id_model)->name_car;
    }
}
