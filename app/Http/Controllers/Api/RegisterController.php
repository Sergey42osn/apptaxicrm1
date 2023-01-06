<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Auth\Events\Registered;

use App\Http\Requests\RegisterFormRequest;

class RegisterController extends Controller
{
    public function register(RegisterFormRequest $request)
	{
		//dd($request);

		/*$validator = Validator::make($request->all(), [
			'name'      =>  'required',
         'f_name'    =>  'required',
         'email'     =>  'required|email|unique:users',
         'phone'     =>  'required',
         'password'  =>  'required|min:6|confirmed',
			'password_confirmation'  =>  'required'
		 ]);

		 //dd($validator->errors()->messages());
	
		 if ($validator->fails()) {
			return response()->json([
				'status' => 200,
				'error'	=> $validator->errors()->first(),
				'result' => false
			]);
		 }*/

		 dd('444');

	    $user=User::create([
	        'name' => request('name'),
	        'f_name' => request('f_name'),
	        'email' => request('email'),
	        'password' => bcrypt(request('password'))
	    ]);

	   	//event(new Registered($user));

	    $user->sendEmailVerificationNotification();

	    return response()->json(['status' => 201,'result' => true]);
	}

	
}
