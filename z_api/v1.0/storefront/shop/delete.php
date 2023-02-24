 <?php 
	if($requestMethod=='POST'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $arraycheck=array('id_member','id');
			// $rawData = file_get_contents("php://input");
			// $rawDataJson=json_decode($rawData,true);
			$rawData = json_encode($_POST);
			$rawDataJson=json_decode($rawData,true);
			$responses_check = $validation->storefrontCheckNull($rawData,$arraycheck);

			if(!$responses_check['error']){
				// $sector = $defineSectors['types'][$sectors];
				$tableShop = (!empty($sector['tables']['shop'])) ? $sector['tables']['shop'] : '';
				$tableShopSubscribe = (!empty($sector['tables']['shop-subscribe'])) ? $sector['tables']['shop-subscribe'] : '';

				if (isset($rawDataJson['status']) && $rawDataJson['status']=="deleted-favourite") {
			        $row = $d->rawQueryOne("select id from #_member_subscribe where id_member=? and id_shop=? limit 0,1", array($rawDataJson['id_member'],$rawDataJson['id']));
			        if ($row) {
			            $d->rawQuery("delete from #_member_subscribe where id = ? ", array($row['id']));

			            /* Delete cache */
			            if ($cache->delete()) {
			            	$d->rawQuery("UPDATE #_".$tableShopSubscribe." SET quantity = quantity - 1 where id_shop = ? ", array($rawDataJson['id']));
			            	// $responses['data']['id']=$row['id'];	
			            	// $responses['data']['variant']=$id_variant;	
			            	$responses = [
						        'status' => 200,
						        'data' => [
						        	'messenger' => 'Delete Subscribe'
						        ]
						    ];
			            }else{
			                $responses = [
			                    'status' => 500
			                ];
			            }
			        }else{
			        	$responses = [
					        'status' => 200,
					        'data' => [
					        	'messenger' => 'Data does not exist'
					        ]
					    ];
			        }
					returnData($responses);
					
				}else{
			        $row = $d->rawQueryOne("select id, id_member, id_admin, name, photo, folder, status, status_attr from #_" . $tableShop . " where id = ? and id_member=? and id_shop=? limit 0,1", array($arraycheck['id'],$arraycheck['id_member'],0));

			        if (!empty($row['id'])) {
			        	$paths = array(
		                    'shop' => UPLOAD_SHOP_L,
		                    'filemanager' => UPLOAD_FILEMANAGER_L,
		                    'product' => UPLOAD_PRODUCT_L,
		                    'photo' => UPLOAD_PHOTO_L,
		                    'news' => UPLOAD_NEWS_L,
		                    'contact-file' => UPLOAD_FILE_L,
		                    'seopage' => UPLOAD_SEOPAGE_L,
		                    'static' => UPLOAD_NEWS_L,
		                );

			        	$func->deleteShop($row, $sector, $paths);
				        $d->runMaintain();
				        $responses['data'] = [
				        	'messenger' => 'The data has been deleted successfully'
				        ];
				    } else {
				        $responses = [
					        'status' => 409,
					        'data' => [
					        	'error' => true,
					        	'messenger' => 'Data does not exist'
					        ]
					    ];
				    	returnData($responses);
				    }
			    }
		    }else{
		    	$responses = [
			        'status' => 409,
			        'data' => [
			        	'error' => true,
			        	'messenger' => 'Invalid data'
			        ]
			    ];
		    	returnData($responses);
		    }
		} catch (Exception $e) {
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
