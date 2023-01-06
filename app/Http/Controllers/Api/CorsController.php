<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class CorsController extends Controller
{
     public function cors(Request $request)
	{		
	     $credentials = $request->only('email', 'password');

	     //dd($credentials);

        Log::info('login ' . $request->has('email') ? $request->get('email') : 'null');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'result'    => false,
                'message' => 'Неправильный логин или пароьль',
                'errors' => 'No auth'
            ], 200);
        }

        return response()->json([
            'result'    => true,
            'user'      => Auth::user(),
            'message'   => 'Успех',
        ], 200);

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

        return response()->json(['result' => true,$request->user()]);
    }
}
