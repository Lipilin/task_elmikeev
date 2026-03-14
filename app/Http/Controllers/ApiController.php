<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Income;
use App\Models\Sale;
use App\Models\Order;

class ApiController extends Controller
{
    public function get_entity(Request $request){
    	$path = $request->path();
    	$url = config('app.api_test_task.BASE_HOST')."/$path";
    	$dateFrom = new \DateTime('2026-01-01');
    	$dateTo = new \DateTime('today');
    	$params = [
    		'key' => config('app.api_test_task.KEY'),
    		'limit' => 500, 
    		'page' => 1,
    		'dateFrom' => $dateFrom->format('Y-m-d'),
    		'dateTo' => $dateTo->format('Y-m-d'),
    	];
		switch ($path) {
            case 'api/stocks':
                $model = new Stok();
                break;
                
            case 'api/incomes':
                $model = new Income();
                break;
                
            case 'api/sales':
                $model = new Sale();
                break;
                
            case 'api/orders':
                $model = new Order();
                break;
                
            default:
                return response()->json([
                    'error' => 'No Such Model',
                    'available' => ['Stock', 'Income', 'Order', 'Sale']
                ], 400);
        }
        $data = $this->processApiRequest($url, $params);
        if(sizeof($data) == 0){
        	 return response()->json([
                    'error' => 'No Data was Found',
             ], 400);
        }
    	$model->truncate();
    	foreach($data as $entity){
    		$model->create($entity);
    	}
    }

    private function processApiRequest($url = null, $params = []){
    	if ($url == null){
    		return [];
    	}
    	$final_response = [];
    	while (True){
    		$ch = curl_init("$url?".http_build_query($params));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			$response = json_decode($response, true);
			if($response == null or sizeof($response['data']) == 0){
				break;
			}
			$final_response = array_merge($final_response, $response['data']);
			$params['page'] += 1;
    	}
    	return $final_response;
    }
    
}
