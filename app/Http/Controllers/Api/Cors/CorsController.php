<?php

namespace App\Http\Controllers\Api\Cors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Driver;

class CorsController extends Controller
{
     public function cors(Request $request)
	{
		//dd('$request');
		
	     $credentials = $request->only('email', 'password');

         
       // return response()->json([
          //  'name' => $credentials,
       // ],200);

	     //dd($credentials);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Неправильный логин или пароьль',
                'errors' => 'No auth'
            ], 401);
        }

        $token = Auth::user()->createToken(config('app.name'));

        //dd($token);

        $token->token->expires_at = $request->remember_me ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();

        $token->token->save();

        return response()->json([
            'result'        => true,
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
        ], 200);
	}

    public function check(Request $request)
    {
        //dd($request);

        $id_driver = $request->user()->id_driver;

        if($id_driver){
            $driver = Driver::where('id',$id_driver)->first();
            $phone = $driver->phone;
        }

        $user = [
            'id_driver' => $request->user()->id_driver,
            'name' => $request->user()->name,
            'id_car' => $request->user()->id_car,
            'phone' => $phone ? $phone : ''
        ];

        return response()->json(['result' => true,'user' => $user]);
    }
}
