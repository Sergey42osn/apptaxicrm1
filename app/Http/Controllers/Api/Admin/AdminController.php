<?php

namespace App\Http\Controllers\Api\Admin;

use Validator;
use App\User;
use App\Car;
use App\CarsCats;
use App\CarsBrands;
use App\CarsModel;
use App\CarsColor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.welcome');
    }

    public function user(Request $request)
    {
    	dd($request);

        return response()->json([$request->user(),'result' => true]);
    }

    public function getcarscats()
    {
    	//dd('123');

    	$cats = CarsCats::all();

    	//dd($cats);

       	return response()->json([$cats,'result' => true]);
    }

    public function getcarbrands(Request $request)
    {
        //dd($request);

        $cat_id = $request['cat_id'];

        $brands = CarsBrands::where('id_cat',$cat_id)->get();

        //dd($cats);

        return response()->json([$brands,'result' => true]);
    }

    public function addcarscat(Request $request)
    {
        //dd($request['namecat']);

        CarsCats::create([
            'name_category' => $request['namecat']
        ]);

        return response()->json(['status' => 201,'result' => true]);
    }

    public function addcarsbrand(Request $request)
    {
        //dd($request);

        $id_cat = intval($request['id_cat'] );

        CarsBrands::create([
            'name_model'    => $request['namebrand'],
            'id_cat'        =>  $id_cat    
        ]);

        return response()->json(['status' => 201,'result' => true]);
    }

    public function getcarmodels(Request $request)
    {
       // dd($request);

        $cat_id = intval($request['cat_id']);

        //dd($cat_id);

        $models = CarsModel::where('id_model',$cat_id)->get();

        //dd($cats);

        return response()->json([$models,'result' => true]);
    }

     public function addcarsmodel(Request $request)
    {
       // dd($request);

        $cat_id = intval($request['id_cat']);

        $brand_id = intval($request['id_brand']);

        //dd($cat_id);

        CarsModel::create([
            'name_car'        => $request['namemodel'],
            'id_category'     =>  $cat_id,
            'id_model'        =>  $brand_id   
        ]);

        //dd($cats);

        return response()->json(['status' => 201,'result' => true]);
    }

      public function addcar(Request $request)
    {
        //dd($request);

         $v = Validator::make($request->all(), [
          'car_namber' => 'required|unique:cars',
        ]);

         if ($v->fails()) {
           // dd($v->messages());

            $errors = $v->errors();

            if ($errors->has('car_namber')) {

                $message = ['car_namber' => $errors->first('car_namber')];
                # code...
            }

             return response()->json(['message' => $message,'status' => 200,'result' => false]);
        }

        $id_model = intval($request['id_model']);

        $id_brand = intval($request['id_brand']);
        $id_category = intval($request['id_category']);
        $id_color = intval($request['id_color']);

        $car_namber = htmlspecialchars($request['car_namber']);

        //dd($cat_id);

        Car::create([
            'id_model'        => $id_model,
            'id_brand'        => $id_brand,
            'id_category'     =>  $id_category,
            'id_color'        =>  $id_color,
            'car_namber'        =>  $car_namber,   
        ]);

        //dd($cats);

        return response()->json([
                        'status' =>     200,
                        'result' =>     true,
                        'message'   =>  'Автомобиль создан'
                    ]);
    }

     public function addcarscolor(Request $request)
    {
       // dd($request);

        CarsColor::create([
            'name_color'        => $request['namecolor']  
        ]);

        //dd($cats);

        return response()->json(['status' => 201,'result' => true]);
    }

    public function getcarscolors()
    {

        $corols = CarsColor::all();

        //dd($cats);

        return response()->json([$corols,'result' => true]);
    }
}
