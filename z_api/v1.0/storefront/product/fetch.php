<?php 
	if($requestMethod=='GET'){
		
		try{
			$responses = [
		        'status' => 200,
		        'total' => 0,
		        'limit' => 40,
		        'data' => []
		    ];
			$rawData = json_encode($_GET);
			$rawDataJson=json_decode($rawData,true);
			$arraycheck=array('id_member');
			$responses_check = $validation->storefrontCheckNull($rawData,$arraycheck);
			
		    if(!$responses_check['error']){
				$tableProductMain = (!empty($sector['tables']['main'])) ? $sector['tables']['main'] : '';
		        $tableProductContent = (!empty($sector['tables']['content'])) ? $sector['tables']['content'] : '';
		        $tableProductInfo = (!empty($sector['tables']['info'])) ? $sector['tables']['info'] : '';
		        $tableProductPhoto = (!empty($sector['tables']['photo'])) ? $sector['tables']['photo'] : '';
		        $tableProductTag = (!empty($sector['tables']['tag'])) ? $sector['tables']['tag'] : '';
		        $tableProductSale = (!empty($sector['tables']['sale'])) ? $sector['tables']['sale'] : '';
		        $tableProductVideo = (!empty($sector['tables']['video'])) ? $sector['tables']['video'] : '';
		        $tableProductContact = (!empty($sector['tables']['contact'])) ? $sector['tables']['contact'] : '';
		        $tableProductComment = (!empty($sector['tables']['comment'])) ? $sector['tables']['comment'] : '';
		        $tableProductCommentPhoto = (!empty($sector['tables']['comment-photo'])) ? $sector['tables']['comment-photo'] : '';
		        $tableProductCommentVideo = (!empty($sector['tables']['comment-video'])) ? $sector['tables']['comment-video'] : '';
		        $tableProductVariation = (!empty($sector['tables']['variation'])) ? $sector['tables']['variation'] : '';
		        $tableProductSeo = (!empty($sector['tables']['seo'])) ? $sector['tables']['seo'] : '';
		        $tableProductReport = (!empty($sector['tables']['report-product'])) ? $sector['tables']['report-product'] : '';
		        $tableProductReportInfo = (!empty($sector['tables']['report-product-info'])) ? $sector['tables']['report-product-info'] : '';
		        $tableShop = (!empty($sector['tables']['shop'])) ? $sector['tables']['shop'] : '';
		        $tableShopSubscribe = (!empty($sector['tables']['shop-subscribe'])) ? $sector['tables']['shop-subscribe'] : '';
				
				$where =" id<>0 and id_member=?";
				$paramsProduct=array($rawDataJson['id_member']);
				$curPage = (!empty($rawDataJson['p']))?$rawDataJson['p']:1;
		        $perPage = 40;
		        $startpoint = ($curPage * $perPage) - $perPage;

				$sqlProductNum = "select count(*) as 'num' from #_$tableProductMain where $where";
				$sqlProduct=" select id,namevi,slugvi,photo,descvi,regular_price,real_price,status,date_created,status_user from #_$tableProductMain where $where limit $startpoint,$perPage";
				$products=array();
				$products = $d->rawQuery($sqlProduct, $paramsProduct);
		        $count = $d->rawQueryOne($sqlProductNum, $paramsProduct);
		        $total = (!empty($count)) ? $count['num'] : 0;
		        $responses['total']=$total;

		        
		        foreach ($products as $v) {
		        	$v['thumb']=$configBaseSectors.THUMBS.'/300x300x1/'.UPLOAD_PRODUCT_L.$v['photo'];
		        	$v['photo']=$configBaseSectors.UPLOAD_PRODUCT_L.$v['photo'];
		        	$v['slugvi']=$configBaseSectors.$sector['type'].'/'.$v['slugvi'].'/'.$v['id'];
		        	$v['priceType'] = $variation->get($tableProductVariation, $v['id'], 'loai-gia', 'vi');
		        	if($rawDataJson['video']=='true'){
		        		$rowDetailVideo = $d->rawQueryOne("select photo, video, name$lang, type from #_$tableProductVideo where id_parent = ? and name$lang != '' and video != ''", array($v['id']));
		        		$rowDetailVideo['video']=$configBaseSectors.UPLOAD_VIDEO_L.$rowDetailVideo['video'];
		        		$rowDetailVideo['photo']=$configBaseSectors.UPLOAD_PHOTO_L.$rowDetailVideo['photo'];
		        		$v['video'] = $rowDetailVideo;
		        	}
		        	if($rawDataJson['gallery']=='true'){
			            $rowDetailPhoto = $d->rawQuery("select id, photo from #_$tableProductPhoto where id_parent = ?", array($v['id']));
			            foreach ($rowDetailPhoto as $v1) {
			            	$data_photo=array();
				        	$data_photo['id']=$v1['id'];
				        	$data_photo['thumb']=$configBaseSectors.THUMBS.'/300x300x1/'.UPLOAD_PRODUCT_L.$v1['photo'];
				        	$data_photo['photo']=$configBaseSectors.UPLOAD_PRODUCT_L.$v1['photo'];
				        	$v['gallery'][]=$data_photo;
			            }
		        	}
		        	
		        	$responses['data'][]=$v;
		        }
		        
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
	}else {
	    header('HTTP/1.0 405 Method Not Allowed', true, 405);
	}
?>

