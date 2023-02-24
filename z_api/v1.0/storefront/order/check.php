<?php 
	if($requestMethod=='GET'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $arraycheck=array('id_user');
		    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		    if(!$responses_check['error']){
		    	$param=array();
			    $id_user=$_GET['id_user'];
			    $where =" where id_user=?";
				array_push($param,$id_user);
				$sqlNum = "select count(*) as 'num' from #_order $where order by date_created desc";
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