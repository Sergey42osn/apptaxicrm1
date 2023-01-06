<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes(['verify' => true]);

//Route::get('/email/verify/{id}/{hash}','\Api\VerificationController\@verify');

/*Route::get('/email/verify/{id}/{hash}', function (Request $request) {

	dd($request);

	 if (!$request->hasValidSignature()) {
           return response()->json([
                            "result"    => false,
                            "msg"       => "Ссылка активации просрочена",
                            "href"      => "/email/resend/?user_id=".$request->id,
                            "user_id"   => $request->id
                        ], 200);
        }

        $user = User::findOrFail($request->id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        dd($user);

        dd('stop');

        return redirect()->to('/');
});*/

Route::get('/{any}','IndexController@index')->where('any','.*');
