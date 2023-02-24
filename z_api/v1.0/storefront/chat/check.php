<?php 
	if($requestMethod=='GET'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $arraycheck=array('id_member');
		    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		    if(!$responses_check['error']){
				$tableShop = (!empty($sector['tables']['main'])) ? $sector['tables']['shop'] : '';
				$tableShopChat = (!empty($sector['tables']['main'])) ? $sector['tables']['shop-chat'] : '';
				
		    	$param=array();
			    $id_member=$_GET['id_member'];
			    $where =" where id_member=?";
				array_push($param,$id_member);
				$sqlNum = "select count(*) as 'num' from #_$tableShopChat $where";
			    $count = $d->rawQueryOne($sqlNum,$param);
			    $total = (!empty($count)) ? $count['num'] : 0;
			    $responses['total']=$count['num'];
			    returnData($responses);
		    }else{
		    	$responses = [
			        'status' => 409,
			        'data' => $responses_check
			    ];
		    	returnData($responses);
		    }
		} catch (Exception $e) {
			$responses = [
		        'status' => 409,
		        'data' => $e
		    ];
	    	returnData($responses);
		}
	}else{
		header('HTTP/1.0 405 Method Not Allowed', true, 405);
	}
?>