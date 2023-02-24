<?php 
	if($requestMethod=='GET'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $param=array();
			$sqlNum = "select id,namevi from #_product_tags where find_in_set('hienthi',status) order by date_created desc";
		    $row = $d->rawQuery($sqlNum);
		    $responses['data']=$row;
		    returnData($responses);
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