<?php 

	if($requestMethod=='GET'){

		try {

			$responses = [

		        'status' => 200,

		    ];

		    $arraycheck=array('id_cat');

		    $responses_check = $Validation->storefrontCheckNull(json_encode($_GET),$arraycheck);

		    if(!$responses_check['error']){

		    	$param=array();

			    $where =" where id_cat=?";

				array_push($param,$_GET['id_cat']);

				$sqlNum = "select id,namevi from #_product_item $where order by date_created desc";

			    $row = $d->rawQuery($sqlNum,$param);

			    $responses['data']=$row;

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