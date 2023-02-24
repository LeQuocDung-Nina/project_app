<?php 
if($requestMethod=='POST'){
	try {
		$arraycheck=array('id_order','id_member');
		$rawData = json_encode($_POST);
		$rawDataJson=json_decode($rawData,true);
		$responses_check = $validation->storefrontCheckNull($rawData,$arraycheck);
		if(!$responses_check['error']){
			$CheckOrder=$d->rawQueryOne("select order_status,id from #_order_group where id=? and id_member=?",array($rawDataJson['id_order'],$rawDataJson['id_member']));

			if(empty($CheckOrder['id'])){
				$responses = ['status' => 409,'data' => ['error'=>true,'messenger'=>'Order not found']];
			    returnData($responses);
			    die;
			}else{
				$dataUpdate['order_status'] = !empty($rawDataJson['order_status']) ? htmlspecialchars($rawDataJson['order_status']) : 0;
				$dataUpdate['notes'] = htmlspecialchars($rawDataJson['notes']);
				$dataUpdate['date_updated'] = time();
				$d->where('id', $rawDataJson['id_order']);
				$d->where('id_member', $rawDataJson['id_member']);
				if($d->update('order_group', $dataUpdate)){
					$responses = ['status' => 200,'data' => ['messenger'=>'You have successfully cancel orders']];
				}else{
					$responses = ['status' => 409,'data' => ['error'=>true,'messenger'=>'There was an error processing, Please try again later']];
				}
				returnData($responses);
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