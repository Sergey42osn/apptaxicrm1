<?php

namespace App\Http\Controllers\Api\Admin;

use App\User;
use App\CarsCats;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.welcome');
    }

    public function user(Request $request)
    {
    	dd($request);

        return response()->json([$request->user(),'result' => true]);
    }

    public function getcarscats()
    {
    	dd('123');

    	$cats = CarsCats::all();

    	//dd($cats);

       	return response()->json([$cats,'result' => true]);
    }
}
