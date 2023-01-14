<?php

namespace App\Http\Controllers\Api\Drivers;

use DB;
use App\User;
use App\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
     public function login(Request $request)
	{
		//dd($request);
		
	    $cred = $request->only('login', 'password');

	    //dd($cred);

        $driver = Driver::find($request['login']);

        //dd($driver);

        if(!$driver){

            return response()->json([
                'result'    => false,
                'msg' => 'Данные не верны!',
                'errors' => 'Unauthorised'
            ], 200);

        }

        if(!$driver->attempt($cred)){
            return response()->json([
                'result'    => false,
                'msg' => 'Данные не верны!',
                'errors' => 'Unauthorised'
            ], 200);
        }

        $user = User::find($driver->id_user);

        if(!$driver->hasConfirmed()){

            if(!$user->hasVerifiedEmail()){
                $user->sendEmailVerificationNotification();
            }

            return response()->json([
                'result' => false,
                'msg'   => 'Статус водителя не подтвержден'
            ]);
        }

        //$token = $user->token;

        $token = $user->createToken(config('app.name'))->accessToken;

        return response()->json([
            'result'        => true,
            'token_type' => 'Bearer',
            'token' => $token
        ], 200);
	}

	public function logout()
	{
        //dd('logout');

	    $accessToken = auth()->user()->token();

	    $refreshToken = DB::table('oauth_refresh_tokens')
	        ->where('access_token_id', $accessToken->id)
	        ->update([
	            'revoked' => true
	        ]);

	    $accessToken->revoke();

        // dd($accessToken);

	    return response()->json(['result' => true ,'status' => 200]);
	}

	public function user(Request $request)
    {
    	//dd($request);

        return response()->json([
                   // $request->user(),
                    'result' => true,
                    'user'  => [
                        'name'      =>   $request->user()->name,
                        'is_admin'  =>   $request->user()->is_admin
                    ]
                ]);
    }

    public function auth(Request $request)
    {
        //dd($request);

        return response()->json(['result' => true]);
    }
}
