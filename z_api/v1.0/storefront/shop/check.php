<?php 
	if($requestMethod=='GET'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $arraycheck=array('id_member');
		    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		    if(!$responses_check['error']){
				$tableShopMain = (!empty($sector['tables']['shop'])) ? $sector['tables']['shop'] : '';


			    $id_member=$_GET['id_member'];
				$param=array($id_member,'taman','deleted');
				if (isset($_GET['favourite']) && $_GET['favourite'] > 0) {
					$where =" where id_member<>? and (status!=? and status!=?)";

		        	$shopFavourite = $d->rawQuery("select id_shop from #_member_subscribe where id_member = ?", array($id_member));
					if ($shopFavourite) {
						$arr_shop = "0";
						foreach ($shopFavourite as $key => $value) {
							$arr_shop .= ",". $value['id_shop'];
						}
			        
						$where .= " and FIND_IN_SET(id,'".$arr_shop."') > 0 ";
					}else{
						$responses['total']=0;
					    returnData($responses);
					    exit();
					}
				}else{
					$where =" where id_member=?  and (status!=? and status!=?)";
				}
				$sqlNum = "select count(*) as 'num' from #_$tableShopMain $where";
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