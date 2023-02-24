<?php 
	if($requestMethod=='GET'){
		try {
	    	$responses = [
		        'status' => 200,
		        'data' => []
		    ];

		    $status = array();
		    $payments = array();
            $order_status = $d->rawQuery("select id, namevi, class_order from #_order_status");
            $order_payments = $d->rawQuery("select id, namevi from #_news where type = 'hinh-thuc-thanh-toan'");
            foreach ($order_status as $key => $value) {
            	$status[] = $value;
            }
            foreach ($order_payments as $key => $value) {
            	$payments[] = $value;
            }
            $responses['data']['order_status']=$status;
            $responses['data']['order_payments']=$payments;

		    returnData($responses);
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
?>