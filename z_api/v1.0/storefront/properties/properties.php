<?php 

	if($requestMethod=='GET'){

		try {

			$responses = [

		        'status' => 200,

		    ];

		    $param=array();


			if($Idsectors==5 || $Idsectors==6){
				$sqlNum = "select id,namevi,properties from #_product_item where find_in_set('hienthi',status) order by date_created desc";
			}else{
				$sqlNum = "select id,namevi,properties from #_product_sub where find_in_set('hienthi',status) order by date_created desc";
			}


		    $row = $d->rawQuery($sqlNum);

		    
		    foreach ($row as $k => $v_sub) {

		    	$v_sub['properties_list']=array();

		    	if(!empty($v_sub['properties'])){

		    		$row_properties = $d->rawQuery("select id,namevi from #_variation where id in (".$v_sub['properties'].") and find_in_set('hienthi',status) and type='thuoc-tinh-dong'");

		    		foreach ($row_properties as $v) {

		    			$v_sub['properties_list'][]=$v;

		    		}

		    		unset($v_sub['properties']);

		    		$responses['data'][]=$v_sub;

		    	}else{

		    		unset($row[$k]);

		    	}

		    	

		    }

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