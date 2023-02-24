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


			/* Where product */
            $whereProduct = " A.status = ? and A.status_user = ? and A.id_member = ? ";
            $paramsProduct = array('xetduyet', 'hienthi', $id_member);

            /* SQL num */
            $sqlProductNum = "select count(A.id) as num from #_$tableProductMain as A inner join #_$tableProductComment as C on C.id = (select id from #_$tableProductComment as LJ_C where A.id = LJ_C.id_product limit 0,1) and find_in_set('hienthi',C.status) where $whereProduct order by C.date_posted desc";

            /* Get data */
            if (!empty($sqlProductNum)) {

            	$count = $d->rawQueryOne($sqlProductNum,$paramsProduct);
                // $total = (!empty($count)) ? $count['num'] : 0;
            }

		
		    $responses['total']=$count['num'];
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
