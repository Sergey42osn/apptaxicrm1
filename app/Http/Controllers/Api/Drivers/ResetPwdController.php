<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPwdController extends Controller
{
    public function reset(Request $request)
    {
        //dd($request->all());

        $driver = Driver::find($request['login']);

        if(!$driver){
            return response()->json([
                "result" => false,
                "msg" => "Данные не верны"
            ]);
        }

        //$pwd = $driver->resetPwd();

        $res = $driver->sendEmailResetPwdDriverNotification();

        if(!$res){
            return response()->json([
                "result" => false,
                'msg'      => 'Ошибка запроса.Повторите позже!'
            ]);
        }

        return response()->json([
            "result" => true,
            'msg'    => 'Данные для входа в приложение отправлены вам на почту'
        ]);

    }
}
