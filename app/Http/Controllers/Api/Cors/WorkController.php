<?php

namespace App\Http\Controllers\Api\Cors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Work;

class WorkController extends Controller
{
   public function index(){
      return response()->json([
         'message' => 'Неправильный логин или пароьль',
         'errors' => 'No auth'
     ], 200);
   }

   public function create(Request $request){

     return response()->json([
         'result' => true,
         'user'   => $request['user']
     ], 200);

      if($request['user']){
        // $res_decode = json_decode($request['user']);

        $phone = $request['user']['phone'];
        $name = $request['user']['name'];

         $res = Work::updateOrCreate(
            ['id_car' 	=> $request['user']['id_car']],
           ['phone'     => $phone,
            'name'     => $name,
				'status'	   => 1]
         );

         $data = [
            'result'    => true,
            'data'      => $res,
            'user'      => $request['user']
         ];

      }else{
         $data = [
            'result'    => false,
            'data'      => $res,
            'user'      => $request['user']
         ];

      }

      /*if($request->user){
         Work::create([
            'id_car' 	=> $request->id_car,
				'lat'		   => $request->latitude,
				'lng'		   => $request->longitude,
				'status'	   => $request->status
         ]);
      }*/

      return response()->json($data, 200);
   }

   public function update(Request $request)
   {
    // return response()->json(['result' => true,'status' => $request['status']], 200);

      $res = Work::where('id_car', $request['id_car'])
			 ->update(['status' => $request['status']]);

      if($res){

         $data = [
            'result' => true
         ];

      }else{

         $data = [
            'result' => false
         ];

      }

      return response()->json($data, 200);
   }
}