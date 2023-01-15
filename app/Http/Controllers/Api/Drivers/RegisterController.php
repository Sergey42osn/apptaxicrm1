<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Driver;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

use App\Http\Requests\Drivers\RegisterFormRequest;

class RegisterController extends Controller
{
	public function index()
	{
		return view('drivers.auth.register');
	}

	/*public function __invoke(RegisterFormRequest $request) {
      $user = User::create($request->validated());

		dd($user);
   }*/

    public function register(RegisterFormRequest $request)
	{
		dd('111');

		//$driver_pwd = Str::upper(Str::random(16));

		/*$str = [];

		for ($i=1; $i < 7; $i++) { 
			$str[] = rand(0,9);
		}

		$driver_pwd = implode("",$str);*/

		//dd(intval($driver_pwd));

		$driver = Driver::create([
			'name' 		=> request('name'),
			'f_name'		=> request('f_name'),
			'email' 		=> request('email'),
			'phone'		=> request('phone'),
			'password' 	=> bcrypt($request['password'])
		]);

		if($driver->id){
			//dd($driver->id);

			$driver_id = $driver->id;

			$driver->login = $driver_id;

			$driver->save();

		}else{
			$driver_id = null;
		}

		$user = User::create([
			'name' 		=> request('name'),
			'f_name'		=> request('f_name'),
			'email' 		=> request('email'),
			'phone'		=> request('phone'),
			'id_driver'	=> $driver_id,
			'password' 	=> bcrypt($request['password'])
		]);

		if(!$user->id){
			return response()->json([
				'result' => false,
				'msg'		=> 'Ошибка создания пользователя'
			]);
		}

		//$token = $user->createToken(config('app.name'))->accessToken;

		//dd($token);

		$driver->id_user = $user->id;

		$driver->save();

		//event(new Registered($user));

	    $user->sendEmailVerificationNotification();

	    return response()->json([
			'result' => true,
			'href'	=> '/email/verify/notic'
		]);
	}

	
}
