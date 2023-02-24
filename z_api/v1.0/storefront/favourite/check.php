<?php 
	if($requestMethod=='GET'){
		

	    $arraycheck=array('id_member');
	    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
	    if(!$responses_check['error'] ){
	    	$responses = [
		        'status' => 200,
		        'total' => 0,
		        'data' => []
		    ];

	    	$id_member=$_GET['id_member'];
		    $where =" where id_member= ? and variant = ? and type = ? ";
	    	$param=array($id_member,'product', $sector['type']);

			$sqlNum = "select count(*) as 'num' from #_member_favourite $where order by id desc";
		    $count = $d->rawQueryOne($sqlNum,$param);
		    $total = (!empty($count)) ? $count['num'] : 0;
		    $responses['total']=$total;
		    returnData($responses);
	    }else{
	    	$responses = [
		        'status' => 409,
		        'data' => $responses_check
		    ];
	    	returnData($responses);
	    }
	}else {
	    header('HTTP/1.0 405 Method Not Allowed', true, 405);
	}
