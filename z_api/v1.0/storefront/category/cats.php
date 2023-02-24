<?php 
	if($requestMethod=='GET'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $sector = $defineSectors['types'][$sectors];
		    $id_list=$sector['id'];
		    $param=array();
		    $where =" where id_list=?";
			array_push($param,$id_list);
			$sqlNum = "select id,namevi from #_product_cat $where order by date_created desc";
		    $row = $d->rawQuery($sqlNum,$param);
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