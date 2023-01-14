<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function getdriver(Request $request)
    {
       // dd($request->user());

        $user = $request->user();

        if(!$user->id_driver){
            return response()->json([
                'result'    => false,
                'msg' => 'Данные не найдены!'
            ], 200);
        }

        $cars = Car::where('status', 1)
                    ->where('id_driver', $user->id_driver)
                    ->get();

        if($cars){
            $car = Car::find($cars[0]->id);
        }

        //dd($car);

        return response()->json([
            'result'    => true,
            'user'      => [
                'id_driver' => $user->id_driver,
                'status'    => 'driver',
                'phone' => $user->phone,
                'car'   => [
                    'id'        => $car->id,
                    'number'    => $car->get_car_number() ? $car->get_car_number() : false,
                    'color'     => $car->get_car_color() ? $car->get_car_color() : false,
                    'brand'     => $car->get_car_brand() ? $car->get_car_brand() : false,
                    'model'     => $car->get_car_model() ? $car->get_car_model() : false
                ]
            ] 
        ], 200);
    }
}
