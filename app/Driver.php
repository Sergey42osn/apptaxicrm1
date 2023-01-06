<?php

namespace App;

use Hash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Notifications\Drivers\ResetPwdDriverEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;

class Driver extends Model
{
    use Notifiable,HasApiTokens;

    protected $fillable = [
        'f_name', 'name', 'phone','email','id_car','confirmed','login','password',
    ];

    public function attempt($request)
    {
        //dd($request);

        //dd($this->password);

        //dd(bcrypt($request['password']));

        if (Hash::check($request['password'], $this->password))  {
            return true;
        }

        return false;
    }

    public function resetPwd()
    {
        $str = [];

		for ($i=1; $i < 7; $i++) { 
			$str[] = rand(0,9);
		}

		$driver_pwd = implode("",$str);

        $this->password = bcrypt($driver_pwd);

        $this->save();

        return $driver_pwd;
    }

    public function sendEmailResetPwdDriverNotification()
    {
        $this->notify(new ResetPwdDriverEmail);

        return true;
    }

    public function markConfirmed()
    {
        $this->confirmed = 1;

        $this->save();
    }

    public function hasConfirmed()
    {
        return $this->confirmed;
    }

}
