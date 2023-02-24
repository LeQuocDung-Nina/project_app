<?php 
	if($requestMethod=='GET'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $arraycheck=array('id_member');
		    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		    if(!$responses_check['error']){
		    	$param=array();
			    $id_user=$_GET['id_member'];
			    $where =" where id_member=?";
				array_push($param,$id_user);
				$sqlNum = "select count(*) as 'num' from #_newsletter $where order by date_created desc";
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
		        'data' => $e,
				'total' => 0
		    ];
	    	returnData($responses);
		}
	}else{
		header('HTTP/1.0 405 Method Not Allowed', true, 405);
	}
?>