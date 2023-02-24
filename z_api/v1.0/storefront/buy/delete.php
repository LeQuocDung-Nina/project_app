<?php 
	if($requestMethod=='POST'){
	
	    // $arraycheck=array('id_member','id_variant');
        $arraycheck=array('id_buy');

	    $responses_check = $validation->storefrontCheckNull(json_encode($_POST),$arraycheck);
	    if(!$responses_check['error'] ){

	    	$responses = [
		        'status' => 200,
		        'total' => 0,
		        'data' => []
		    ];

            $id_buy=$_POST['id_buy'];


            $d->rawQuery("delete from #_newsletter where id = ? ", array($id_buy));
            

            /* Delete cache */
            if ($cache->delete()) {
            	// $responses['data']['member']=$id_member;		
            }else{
                $responses = [
                    'status' => 500
                ];
            }

		    returnData($responses);
	    }else{
	    	$responses = [
                'post' => $_POST,
		        'status' => 409,
		        'data' => $responses_check
		    ];
	    	returnData($responses);
	    }
	}else {
	    header('HTTP/1.0 405 Method Not Allowed', true, 405);
	}
?>