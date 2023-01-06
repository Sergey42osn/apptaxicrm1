<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CorsController extends Controller
{
     public function cors(Request $request)
	{
		dd($request);
		
	     $credentials = $request->only('email', 'password');

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

        return response()->json(['result1' => true,'user' => $request->user()]);
    }
}
