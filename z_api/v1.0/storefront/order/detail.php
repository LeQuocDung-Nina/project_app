<?php 
if($requestMethod=='GET'){
	try {
		$orderCode=$match['params']['code'];
		$_GET['code']=$orderCode;
		$arraycheck=array('code');
		$responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		if(!$responses_check['error']){
			$responses = [
		        'status' => 200,
		        'data' => []
		    ];
		    
		    $sqlOrderTotal = "select id,code,order_status,order_payment,total_price,notes,date_created,date_updated,order_info,id_user from #_order where code=? order by date_created desc";
		    $param=array($orderCode);
			$rowDataTotal=$d->rawQueryOne($sqlOrderTotal,$param);

		    $sqlOrder = "select id,order_status,id_shop,id_member,sector_prefix as sector,total_price,order_group_detail from #_order_group where code=? order by date_created desc";
		    $param=array($rowDataTotal['code']);
			$rowData=$d->rawQuery($sqlOrder,$param);

			$rowPayment = $func->getInfoDetail('namevi', 'news', $rowDataTotal['order_payment']);

			$responses['data']['id']=$rowDataTotal['id'];
			$responses['data']['id_order_payment']=$rowDataTotal['order_payment'];
			$responses['data']['order_payment']=$rowPayment['namevi'];
			$responses['data']['order_status']=$rowDataTotal['order_status'];
			$responses['data']['date_created']=$rowDataTotal['date_created'];
			$responses['data']['date_updated']=$rowDataTotal['date_updated'];
			$responses['data']['notes']=$rowDataTotal['notes'];
			$responses['data']['total']=$rowDataTotal['total_price'];
			$infoUser = json_decode($rowDataTotal['order_info'],true);
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
			$dataOrder=array();
			foreach ($rowData as $k => $v) {
				if (!empty($v['id_shop'])) {
	                $groupInfo = $d->rawQueryOne("select id, name as name, slug from #_shop_" . $v['sector'] . " where id = ?", array($v['id_shop']));
	                $data_seller['id']=$groupInfo['id'];
				    $data_seller['fullname']=$groupInfo['name'];
				    $data_seller['url_shop']=$configBaseSectors.'shop/'.$groupInfo['slug'].'/';
	            } else if (!empty($v['id_member'])) {
	            	$restApi = new RestApi();
				    /* Validate data */
				    $apiResp = $restApi->get(str_replace('{id}', $v['id_member'], $apiRoutes['storefront']['member']['detail']));
				    $groupInfo = $restApi->decode($apiResp, true);
				    $data_seller['id']=$groupInfo['data']['id'];
				    $data_seller['fullname']=$groupInfo['data']['fullname'];
				    $data_seller['email']=$groupInfo['data']['email'];
				    $data_seller['username']=$groupInfo['data']['username'];
				    $data_seller['phone']=$groupInfo['data']['phone'];
	            }
	            $v['id_shop'] = !empty($v['id_shop']) ? $v['id_shop'] : '';
	            $v['seller']=$data_seller;
	            $id_order_status = $v['order_status'];
	            $order_status = $d->rawQueryOne("select namevi, class_order from #_order_status where id = ?", array($id_order_status));
	            $v['status']=$order_status['namevi'];
	            $v['status_class']=$order_status['class_order'];
	            $v['detail']=array_values(json_decode($v['order_group_detail'],true));
				foreach ($v['detail'] as $k_detail => $v_detail) {
					$v_detail['thumb']=$configBaseSectors.THUMBS.'/300x300x1/'.UPLOAD_PRODUCT_L.$v_detail['photo'];
		        	$v_detail['photo']=$configBaseSectors.UPLOAD_PRODUCT_L.$v_detail['photo'];
					$v['detail'][$k_detail]=$v_detail;
				}
				unset($v['order_group_detail']);
				unset($v['id_member']);
				unset($v['sector']);
				$responses['data']['dataOrder'][]=$v;
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