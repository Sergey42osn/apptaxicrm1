<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Requests\LoginFormRequest;

class LoginController extends Controller
{
     public function login(LoginFormRequest $request)
	{
		//dd($request);
		
	     $credentials = $request->only('email', 'password');

	  // dd($credentials);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        //dd('ok');

       // dd(Auth::user());

        if (!Auth::user()->email_verified_at) {

            return response()->json([
                'result'    => false,
                'user_id'   => Auth::user()->id,
                'href'      => '/email/resend/?user_id='.Auth::user()->id,
                'message'   => 'E-mail адрес не подтвержден',
                'error'     => 'verifyemail'
            ], 200);

           // dd(Auth::user()->email_verified_at);
        }

        //dd('stop');

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
