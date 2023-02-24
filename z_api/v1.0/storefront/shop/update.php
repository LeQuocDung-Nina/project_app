<?php 
	if($requestMethod=='POST'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $arraycheck=array('id_member','id');
			$rawData = json_encode($_POST);
			$rawDataJson=json_decode($rawData,true);
			
			$responses_check = $validation->storefrontCheckNull($rawData,$arraycheck);
			if(!$responses_check['error']){
		        $tableShop = (!empty($sector['tables']['shop'])) ? $sector['tables']['shop'] : '';
		        $payloadFile = 'file';
		        $dataUpdate=array();

		        $rowCheck=$d->rawQueryOne("select id,photo from #_$tableShop where id_member=? and id=?",array($rawDataJson['id_member'],$rawDataJson['id']));
		        if(!empty($rowCheck['id'])){
		        	if ($func->hasFile($payloadFile)) {
			        	$fileName = $func->uploadName($_FILES[$payloadFile]["name"]);
			        	$root_path=$_SERVER['DOCUMENT_ROOT'];
        				$root_file=str_replace('api', $sector['sub'], $root_path);

			        	if ($photo = $func->uploadImage($payloadFile, '.jpg|.png|.JPG|.PNG', $root_file.'/'.UPLOAD_SHOP_L, $fileName)) {
		                    $dataUpdate['photo'] = $photo;
		                    if (!empty($rowCheck['photo'])) {
	                            $func->deleteFile(UPLOAD_SHOP_L . $rowCheck['photo']);
	                        }
		                }
			        }
			        if(!empty($rawDataJson['password'])){
			        	$dataUpdate['password'] = $rawDataJson['password'];
			        }
			        if(!empty($rawDataJson['status_user'])){
			        	$dataUpdate['status_user'] = $rawDataJson['status_user'];
			        }
			        if(!empty($rawDataJson['status'])){
			        	$dataUpdate['status'] = $rawDataJson['status'];
			        }
			        if(!empty($dataUpdate)){
			        	$d->where('id', $rawDataJson['id']);
			        	$d->where('id_member', $rawDataJson['id_member']);
	                    $d->update($tableShop, $dataUpdate);
	                    unset($dataUpdate);
	                    $responses = [
					        'status' => 200,
					        'messenger' => [
					        	'messenger' => 'The data has been updated successfully'
					        ]
					    ];
					    returnData($responses);
			        }else{
			        	$responses = [
					        'status' => 200,
						    'data' => []
					    ];
				    	returnData($responses);
			        }
		        }else{
		        	$responses = [
				        'status' => 409,
					    'data' => ['error'=>true,'messenger'=>'Invalid data']
				    ];
			    	returnData($responses);
		        }
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
	}else {
	    header('HTTP/1.0 405 Method Not Allowed', true, 405);
	}
?>