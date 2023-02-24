<?php 
	if($requestMethod=='POST'){
				
	
	    $arraycheck=array('id_member','id_variant');
	    $responses_check = $validation->storefrontCheckNull(json_encode($_POST),$arraycheck);
	    if(!$responses_check['error'] ){

	    	$responses = [
		        'status' => 200,
		        'total' => 0,
		        'data' => []
		    ];

            $id_member=$_POST['id_member'];
	    	$id_variant=$_POST['id_variant'];

            $d->rawQuery("delete from #_member_favourite where id_member = ? and id_variant = ? and type = ? and variant = ?", array($id_member, $id_variant, $sector['type'], 'product'));

            /* Delete cache */
            if ($cache->delete()) {
            	// $responses['data']['member']=$id_member;	
            	// $responses['data']['variant']=$id_variant;	
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