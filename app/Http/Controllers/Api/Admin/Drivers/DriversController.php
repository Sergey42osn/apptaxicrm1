<?php

namespace App\Http\Controllers\Api\Admin\Drivers;

use App\Driver;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DriversController extends Controller
{
    public function addriver(Request $request)
    {
        //dd($request);

        $v = Validator::make($request->all(), [
          'f_name' => 'required|min:3',
          'name' => 'required|min:3',
          'phone' => 'required|unique:drivers|digits:11',
        ]);

        //dd($v);

        if ($v->fails()) {
           // dd($v->messages());

            $errors = $v->errors();

            if ($errors->has('f_name')) {

                $message = ['f_name' => $errors->first('f_name')];
                # code...
            }

            if ($errors->has('name')) {

                $message = ['name' => $errors->first('name')];
                # code...
            }

            if ($errors->has('phone')) {

                $message = ['phone' => $errors->first('phone')];
                # code...
            }

             return response()->json(['message' => $message,'status' => 200,'result' => false]);
        }

        if ($request['confirmed']) {
            $confirmed = true;
        }else{
            $confirmed = false;
        }

        Driver::create([
            'f_name' => htmlspecialchars($request['f_name']),
            'name' => htmlspecialchars($request['name']),
            'confirmed' => $confirmed,
            'phone' => $request['phone']
        ]);

        return response()->json(['message' => 'Водитель успешно создан','status' => 200,'result' => true]);
    }
}
