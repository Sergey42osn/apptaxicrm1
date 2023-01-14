<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::get('/email','Api\EmailController\@email');

Route::group(['prefix' => '/v1','namespace' => 'Api','middleware' => ['api'], 'as' => 'api.'], function () {

  	Route::post('/register', 'RegisterController@register');
	Route::post('/login', 'LoginController@login');

	Route::post('/drivers/login', 'Drivers\LoginController@login');

	Route::get('/drivers/register', 'Drivers\RegisterController@index');
	Route::post('/drivers/register', 'Drivers\RegisterController@register');

	Route::post('/drivers/resetpwd', 'Drivers\ResetPwdController@reset');

	//Route::post('/cors/login', 'CorsController@cors')->middleware('cors');

	Route::get('/email/verify/{id}/{hash}','VerificationController@verify')->name('verification.verify');

	Route::get('/email/verify/drivers/noticpwd','VerificationController@verify');

	//Route::get('/email/verify','VerificationController@verify')->name('email-verify');
	Route::get('/email/verify/check','VerificationController@check');

	Route::post('/email/resend','VerificationController@resend');   

	//Route::post('/logout', 'Drivers\LoginController@logout')->middleware('auth:api-drivers');

	Route::post('/cors/login', 'CorsController@cors');

	//Route::post('/register/drivers', 'Drivers/RegisterController@register')->middleware('auth:api');

	//Route::post('/cors/works/update', 'WorkController@update')->middleware(['auth:api','cors']);

	Route::middleware('auth:api')->group(function () {

		Route::group(['prefix' => '/cors','namespace' => 'Cors','middleware' => ['cors', 'json.response']], function () {
			//Route::post('/login', 'CorsController@cors');
	
			Route::get('/check', 'CorsController@check');

			Route::post('/sendCords', 'CordsCarController@saveCords');

			//Route::post('/work/{id}', 'WorksController@saveCords');

			///Route::resource('works', 'WorkController');

			Route::get('/works', 'WorkController@index');

			Route::post('/works', 'WorkController@create');

			Route::post('/works/update', 'WorkController@update');

			Route::post('/orders', 'OrdersController@get');

		});

	    Route::get('user', 'LoginController@user');

		 Route::post('/logout', 'LoginController@logout');

		 Route::get('getdriver', 'Drivers\DriversController@getdriver');

	    Route::group(['prefix' => '/admin','namespace' => 'Admin','middleware' => ['admin']], function () {

	    	Route::get('/admin', 'AdminController@index');

	    	Route::get('/auth', 'AdminController@auth');

	    	Route::get('/getcarscats', 'AdminController@getcarscats');

	    	Route::get('/getcarscolors', 'AdminController@getcarscolors');

	    	Route::post('/addcarscat', 'AdminController@addcarscat');

	    	Route::post('/getcarbrands', 'AdminController@getcarbrands');

	    	Route::post('/getcarmodels', 'AdminController@getcarmodels');

	    	Route::post('/addcarsbrand', 'AdminController@addcarsbrand');

	    	Route::post('/addcarsmodel', 'AdminController@addcarsmodel');

	    	Route::post('/addcarscolor', 'AdminController@addcarscolor');

	    	Route::post('/addriver', 'Drivers\DriversController@addriver');

	    	Route::post('/addcar', 'AdminController@addcar');

	    });

	    Route::get('/usersactive', 'UserController@getUserActive');

	    Route::post('/cords', 'CordsCarController@saveCordCar');

	    Route::get('/getcords', 'CordsCarController@getCordsCars');

	    //Route::post('cors/check', 'CorsController@check');

	   // Route::post('cors/cords', 'CordsCarController@saveCorsCordCar');

	});

	Route::middleware('auth:api-drivers')->group(function () {

	
	});

});
