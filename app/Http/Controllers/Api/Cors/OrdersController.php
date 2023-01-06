<?php

namespace App\Http\Controllers\Api\Cors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function get()
    {
        return response()->json(['result' => true,'data' => 'ok']);
    }
}
