<?php 
	if($requestMethod=='POST'){
		try {
			$arraycheck=array('id_order','id_user');
			$rawData = json_encode($_POST);
			$rawDataJson=json_decode($rawData,true);
			$responses_check = $validation->storefrontCheckNull($rawData,$arraycheck);
			if(!$responses_check['error']){
				if(empty($rawDataJson['order_status']) or $rawDataJson['order_status']!='5'){
					$responses = [
				        'status' => 409,
				        'data' => [
				        	'error'=>true,
				        	'messenger'=>'Invalid data'
				        ]
				    ];
			    	returnData($responses);
			    	die;
				}
				$table=(!empty($rawDataJson['isMain']))?'order':"order_group";
				$CheckOrder=$d->rawQueryOne("select order_status,id from #_$table where id=? and id_user=?",array($rawDataJson['id_order'],$rawDataJson['id_user']));
				if(empty($CheckOrder['id'])){
					$responses = [
				        'status' => 409,
				        'data' => [
				        	'error'=>true,
				        	'messenger'=>'Order not found'
				        ]
				    ];
				    returnData($responses);
				    die;
				}
				if($CheckOrder['order_status']!=1){
					$responses = [
				        'status' => 409,
				        'data' => [
				        	'error'=>true,
				        	'messenger'=>'Orders in progress cannot be canceled at this time'
				        ]
				    ];
			    	returnData($responses);
			    	die;
				}else{
					$dataUpdate['order_status'] = $rawDataJson['order_status'];
					$dataUpdate['date_updated'] = time();
					$d->where('id', $rawDataJson['id_order']);
					$d->where('id_user', $rawDataJson['id_user']);
					if($d->update($table, $dataUpdate)){
						if(empty($rawDataJson['isMain'])) $func->updateOrderMainStatus($rawDataJson['id_order']);
						else{
							$dataOrderGroup = array();
			                $dataOrderGroup['order_status'] = 5;
			                $d->where('id_order', $CheckOrder['id']);
			                $d->update('order_group', $dataOrderGroup);
						}
						$responses = [
					        'status' => 200,
					        'data' => [
					        	'messenger'=>'You have successfully cancel orders'
					        ]
					    ];
					}else{
						$responses = [
					        'status' => 409,
					        'data' => [
					        	'error'=>true,
					        	'messenger'=>'There was an error processing, Please try again later'
					        ]
					    ];
					}
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
	}else{
		header('HTTP/1.0 405 Method Not Allowed', true, 405);
	}
?>