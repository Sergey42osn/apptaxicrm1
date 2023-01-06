<?php

namespace App;

use App\Notifications\CustomVerifyEmail;
use App\Notifications\Drivers\UserResetPwdDriverEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{

    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','f_name','phone','id_driver',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function is_admin($request)
    {
        # code...
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);

        return true;
    }

    public function hasVerifiedEmail()
    {
        return $this->confirmed;
    }

    public function markEmailAsVerified()
    {
        $this->email_verified_at = Carbon::now()->getTimestamp();

        $this->confirmed = 1;

        $this->save();
    }

    public function sendEmailResetPwdDriverNotification()
    {
        $this->notify(new UserResetPwdDriverEmail);

        return true;
    }

}
