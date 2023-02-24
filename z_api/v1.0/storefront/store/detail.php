<?php 
	if($requestMethod=='GET'){
		try {
			$responses = [
		        'status' => 200,
		    ];

		    $responses = [
		        'status' => 200,
		    ];
		    $idStore=$match['params']['id'];
			$_GET['id']=$idStore;
			$arraycheck=array('id');
		    $responses_check = $Validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		    if(!$responses_check['error']){
		    	$sqlNum = "select id,id_list,id_cat,photo,slugvi,namevi,numb,status from #_store where find_in_set('hienthi',status) and id=".$idStore." order by date_created desc";
		    	$rowStore = $d->rawQueryOne($sqlNum);

		    	$rowStore['thumb']=$configBase.THUMBS.'/300x300x1/'.UPLOAD_STORE_L.$rowStore['photo'];
		    	$rowStore['photo']=$configBase.UPLOAD_STORE_L.$rowStore['photo'];
		    	if(!empty($rowStore['id_list'])){
		        	$row=$d->rawQueryOne("select namevi,id from #_product_list where id=?",array($rowStore['id_list']));
		        	$list['id']=$row['id'];
		        	$list['name']=$row['namevi'];
		        	$rowStore['id_list']=$list;
		        }
		        if(!empty($rowStore['id_cat'])){
		        	$row=$d->rawQueryOne("select namevi,id from #_product_cat where id=?",array($rowStore['id_cat']));
		        	$cat['id']=$row['id'];
		        	$cat['name']=$row['namevi'];
		        	$rowStore['id_cat']=$cat;
		        }
		    	$responses['data']=$rowStore;
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
	}else{
		header('HTTP/1.0 405 Method Not Allowed', true, 405);
	}
?>