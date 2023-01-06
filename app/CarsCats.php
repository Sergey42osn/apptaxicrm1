<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarsCats extends Model
{
    protected $table = 'categories_cars';

    protected $fillable = [
        'name_category',
    ];
}
