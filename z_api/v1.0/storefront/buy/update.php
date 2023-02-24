<?php 
if($requestMethod=='POST'){
	try {
		$rawData = json_encode($_POST);
		$rawDataJson=json_decode($rawData,true);
		$arraycheck=array('id_buy','is_readed');
		$responses_check = $validation->storefrontCheckNull($rawData,$arraycheck);
		if(!$responses_check['error']){
			$CheckOrder=$d->rawQueryOne("select is_readed,id from #_newsletter where id = ? ",array($rawDataJson['id_buy']));

			if(empty($CheckOrder['id'])){
				$responses = ['status' => 409,'data' => ['error'=>true,'messenger'=>'Order not found']];
			    returnData($responses);
			}else{
				
				$is_readed = array(1);
				if(!empty($rawDataJson['is_readed']) && in_array($rawDataJson['is_readed'],$is_readed)){
					$dataUpdate['is_readed'] = $rawDataJson['is_readed'];
					$dataUpdate['date_updated'] = time();
					$d->where('id', $rawDataJson['id_buy']);
					if($d->update('newsletter', $dataUpdate)){
						$responses = ['status' => 200,'data' => ['messenger'=>'You have successfully cancel orders']];
					}else{
						$responses = ['status' => 409,'data' => ['error'=>true,'messenger'=>'There was an error processing, Please try again later']];
					}
					returnData($responses);
				}else{
					$responses = ['status' => 409,'data' => ['error'=>true,'messenger'=>'Order not found']];
			    	returnData($responses);
				}
			}

		}else{
			$responses = ['status' => 409,'data' => $responses_check];
	    	returnData($responses);
		}
	}catch (Exception $e) {
		$responses = ['status' => 409,'data' => $e];
    	returnData($responses);
	}
}else{
	header('HTTP/1.0 405 Method Not Allowed', true, 405);
}
?>