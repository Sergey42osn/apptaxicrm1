<?php

namespace App\Http\Controllers\Api\Cors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cord;
use App\Work;

class CordsCarController extends Controller
{
    public function saveCords(Request $request)
    {
		/*return response()->json(['result' => true,
		'id_car' 	=> $request['id_car'],
		'lat'		=> $request['latitude'],
		'lng'		=> $request['longitude']
										]);*/
    		//dd($row);

			//$this->saveCorsCordCar($request);

			Cord::create([
				'id_car'    => intval($request['id_car']),
				'lat'       => $request['latitude'],
				'lng'       => $request['longitude'],
				'id_status' => 1
		  ]);

			 $res = Work::where('id_car', $request['id_car'])
			 ->update(['lat' => $request['latitude'],
			 				'lng' => $request['longitude']]
						);

			if($res){
				return response()->json(['result' => true,'data' => $res]);
			}else{
				return response()->json(['result' => false, 'data' => $res]);
			}
    }

    public function getCordsCars()
    {
    	$rows = Cord::whereBetween('created_at', [now()->subSeconds(30), now()])->get();

    	//dd($rows);

    	if ($rows) {

    		$data = [];

    		foreach ($rows as $key => $row) {

	    		$data[] = [
	    			'id_car'	=> $row->id_car,
	    			'lat'		=>	$row->lat,
	    			'lng'		=>	$row->lng
	    		];

    		}

	    	//dd($data);

    	}

    	return response()->json([
							'status' => 200,
							'result' => true,
							'data'	=> $data
						]);
    }

    public function saveCorsCordCar($request)
    {
        //dd($request);

            //dd($row);
           $res = Cord::create([
                'id_car'    => intval($request['id_car']),
                'lat'       => $request['latitude'],
                'lng'       => $request['longitude'],
                'id_status' => 1
            ]);

           return response()->json(['result' => true]);
    }
}
