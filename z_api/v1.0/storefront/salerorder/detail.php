<?php 
if($requestMethod=='GET'){
	try {
		$arraycheck=array('id_member', 'code');
		$responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		if(!$responses_check['error']){
			$responses = [
		        'status' => 200,
		        'data' => []
		    ];

		    $idMember = htmlspecialchars($_GET['id_member']);
		    $orderCode = htmlspecialchars($_GET['code']);
		    
		    $sqlOrderTotal = "select id, total_price, notes, order_status, date_created, date_updated, code, order_group_detail, order_group_info, order_payment from #_order_group where id_member='".$idMember."' and code='".$orderCode."' order by date_created desc";
			$rowDataTotal=$d->rawQueryOne($sqlOrderTotal);

			$rowPayment = $func->getInfoDetail('namevi', 'news', $rowDataTotal['order_payment']);
			$order_status = $func->getInfoDetail('namevi, class_order', 'order_status', $rowDataTotal['order_status']);

			$responses['data']['id']=$rowDataTotal['id'];
			$responses['data']['id_order_payment']=$rowDataTotal['order_payment'];
			$responses['data']['order_payment']=$rowPayment['namevi'];
			$responses['data']['order_status']=$rowDataTotal['order_status'];
			$responses['data']['status']=$order_status['namevi'];
			$responses['data']['status_class']=$order_status['class_order'];
			$responses['data']['date_created']=$rowDataTotal['date_created'];
			$responses['data']['date_updated']=$rowDataTotal['date_updated'];
			$responses['data']['notes']=$rowDataTotal['notes'];
			$responses['data']['total']=$rowDataTotal['total_price'];
			$infoUser = json_decode($rowDataTotal['order_group_info'],true);
			if(!empty($infoUser['city'])){
				$city['id']=$infoUser['city'];
				$city['text']=$func->getInfoDetail('id_region, name', "city", $infoUser['city'])['name'];
				$infoUser['city']=$city;
			}
			if(!empty($infoUser['district'])){
				$district['id']=$infoUser['district'];
				$district['text']=$func->getInfoDetail(' name', "district", $infoUser['district'])['name'];
				$infoUser['district']=$district;
			}
			if(!empty($infoUser['wards'])){
				$wards['id']=$infoUser['wards'];
				$wards['text']=$func->getInfoDetail(' name', "wards", $infoUser['wards'])['name'];
				$infoUser['wards']=$wards;
			}
			unset($infoUser['payments']);
			$responses['data']['buyer']= $infoUser;
			$detail=array_values(json_decode($rowDataTotal['order_group_detail'],true));
			foreach ($detail as $k_detail => $v_detail) {
				$v_detail['thumb']=$configBaseSectors.THUMBS.'/300x300x1/'.UPLOAD_PRODUCT_L.$v_detail['photo'];
	        	$v_detail['photo']=$configBaseSectors.UPLOAD_PRODUCT_L.$v_detail['photo'];
				$responses['data']['dataOrder'][$k_detail]=$v_detail;
			}
		    returnData($responses);
		}else{
			$responses = [
		        'status' => 409,
		        'data' => $responses_check
		    ];
	    	returnData($responses);
		}
	}catch (Exception $e) {
		$responses = [
	        'status' => 409,
	        'data' => $e
	    ];
    	returnData($responses);
	}
}else {
    header('HTTP/1.0 405 Method Not Allowed', true, 405);
}