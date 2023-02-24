<?php 
	if($requestMethod=='POST'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $arraycheck=array('id_member','id');
		    foreach ($_POST as $k => $v) {
		    	$rawDataJson[$k]=$v;
		    }
			$responses_check = $validation->storefrontCheckNull(json_encode($rawDataJson),$arraycheck);
			if(!$responses_check['error'] && (!empty($rawDataJson['status_user']) or !empty($rawDataJson['content']))){
				$tableProductMain = (!empty($sector['tables']['main'])) ? $sector['tables']['main'] : '';
		        $tableProductContent = (!empty($sector['tables']['content'])) ? $sector['tables']['content'] : '';
		        $tableProductInfo = (!empty($sector['tables']['info'])) ? $sector['tables']['info'] : '';
		        $tableProductPhoto = (!empty($sector['tables']['photo'])) ? $sector['tables']['photo'] : '';
		        $tableProductTag = (!empty($sector['tables']['tag'])) ? $sector['tables']['tag'] : '';
		        $tableProductSale = (!empty($sector['tables']['sale'])) ? $sector['tables']['sale'] : '';
		        $tableProductVideo = (!empty($sector['tables']['video'])) ? $sector['tables']['video'] : '';
		        $tableProductContact = (!empty($sector['tables']['contact'])) ? $sector['tables']['contact'] : '';
		        $tableProductVariation = (!empty($sector['tables']['variation'])) ? $sector['tables']['variation'] : '';
		        $tableProductSeo = (!empty($sector['tables']['seo'])) ? $sector['tables']['seo'] : '';
		        $tableProductReport = (!empty($sector['tables']['report-product'])) ? $sector['tables']['report-product'] : '';
		        $tableProductReportInfo = (!empty($sector['tables']['report-product-info'])) ? $sector['tables']['report-product-info'] : '';
		        $tableShop = (!empty($sector['tables']['shop'])) ? $sector['tables']['shop'] : '';
		        $tableShopSubscribe = (!empty($sector['tables']['shop-subscribe'])) ? $sector['tables']['shop-subscribe'] : '';


		        $rowCheck = $d->rawQueryOne("select id,id_member from #_$tableProductMain where id=? and id_member=?",array($rawDataJson['id'],$rawDataJson['id_member']));
		        
		        if(!empty($rowCheck['id'])){
		        	$dataPosting['date_updated']=time();
		        	if(!empty($rawDataJson['status_user'])) $dataPosting['status_user'] = $rawDataJson['status_user'];
		        	if(!empty($rawDataJson['content'])){
				    	$dataPostingMemberContent['contentvi'] = (!empty($rawDataJson['content'])) ? $rawDataJson['content'] : null;
				    	if ($dataPostingMemberContent) {
		                    foreach ($dataPostingMemberContent as $column => $value) {
		                        $dataPostingMemberContent[$column] = htmlspecialchars($func->sanitize($value));
		                    }
		                    $d->where('id_parent', $rowCheck['id']);
	                    	$d->update($tableProductContent, $dataPostingMemberContent);
		                }
				    }

				    if ($dataPosting) {
	                    foreach ($dataPosting as $column => $value) {
	                        $dataPosting[$column] = htmlspecialchars($func->sanitize($value));
	                    }
	                    $dataPosting['date_updated']=time();
	                    $d->where('id', $rowCheck['id']);
	                    $d->where('id_member', $rowCheck['id_member']);
                    	$d->update($tableProductMain, $dataPosting);
	                }
				    $responses = [
				        'status' => 200,
				        'messenger' => [
				        	'messenger' => 'The data has been updated successfully'
				        ]
				    ];
				    returnData($responses);
		        }else{
		        	$responses = [
				        'status' => 409,
				        'data' => [
				        	'error' => true,
				        	'messenger' => 'Data does not exist'
				        ]
				    ];
			    	returnData($responses);
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