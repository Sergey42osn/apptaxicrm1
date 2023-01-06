<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Carbon\Carbon;
//use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\VerifiesEmails;
//use Illuminate\Auth\Access\AuthorizationExeption;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | Driver that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    //use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //dd('123');
        $this->middleware('api');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        //dd($request);

        //return response()->json($request, 200);

        if (!$request->hasValidSignature()) {
           return response()->json([
                            "result"    => false,
                            "msg"       => "Ссылка активации просрочена",
                            "href"      => "/email/resend/?user_id=".$request->id,
                            "user_id"   => $request->id
                        ], 200);
        }

        $user = User::findOrFail($request->id);

       // dd($user);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            $driver = Driver::find($user->id_driver);

            $driver->markConfirmed();

            //dd($user->hasVerifiedEmail());
        }

        if($user->id_driver){
            $user->sendEmailResetPwdDriverNotification();



            return redirect('email/verify/drivers/noticpwd/?verify=true');

        }

        //dd('8888');

        return redirect('email/verify/notic/?verify=true');

    }

    public function resend(Request $request) {

        //dd('123');

        //dd($request);

        $user = User::find($request->user_id);

       // dd($user->id);

        if ($user->hasVerifiedEmail()) {
           return response()->json(["result" => false,"send" => false,"msg" => "Ваша почта уже подтверждена."], 200);
        }

        //dd($user->id);

        if ($user->sendEmailVerificationNotification()) {

            return response()->json(["result" => true,"send" => true,"msg" => "Ссылка успешно отправлена вам на почту"]);
        }else{
             return response()->json(["result" => false,"msg" => "При отправке ссылки на почту произошла ошибка"]);
        }

    }

     public function check(Request $request) {

        ///dd('123');

        //dd($request);

        $user = User::find($request->user_id);

       // dd($user);

        if ($user->hasVerifiedEmail()) {
           return response()->json(["result" => false,"send" => false,"msg" => "Ваша почта уже подтверждена."], 200);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));

            return response()->json(["result" => true,"send" => true,"msg" => "Ссылка успешно отправлена вам на почту"]);
        }

        return response()->json(["result" => false,"msg" => "При отправке ссылки на почту произошла ошибка"]);

    }
}
