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
		        $tableShopRating = (!empty($sector['tables']['shop-rating'])) ? $sector['tables']['shop-rating'] : '';
				if (isset($rawDataJson['favourite']) && $rawDataJson['favourite'] > 0) {
					$shopFavourite = $d->rawQuery("select id_shop from #_member_subscribe where id_member = ?", array($rawDataJson['id_member']));
			
					if ($shopFavourite) {
						$arr_shop = "0";
						foreach ($shopFavourite as $key => $value) {
							$arr_shop .= ",". $value['id_shop'];
						}
						$where =" id<>0 and id_member<>? and (status!=? and status!=?) and FIND_IN_SET(id,'".$arr_shop."') > 0";
			
					}else{
						$responses['total']=0;
					    returnData($responses);
					    exit();
					}

				}else{
					$where =" id<>0 and id_member=? and (status!=? and status!=?)";
				}
				$paramsProduct=array($rawDataJson['id_member'],'taman','deleted');
				$curPage = (!empty($rawDataJson['p']))?$rawDataJson['p']:1;
		        $perPage = 40;
		        $startpoint = ($curPage * $perPage) - $perPage;

				$sqlProductNum = "select count(*) as 'num' from #_$tableShop where $where";
				$sqlProduct=" select id,photo,slug,slug_url,name,status,status_user,numb,id_region,id_city,id_district,id_wards,date_created,id_interface from #_$tableShop where $where limit $startpoint,$perPage";
				$products=array();
				$products = $d->rawQuery($sqlProduct, $paramsProduct);
		        $count = $d->rawQueryOne($sqlProductNum, $paramsProduct);
		        $total = (!empty($count)) ? $count['num'] : 0;
		        $responses['total']=$total;
		 


		        foreach ($products as $v) {
		        	$sampleData = $d->rawQueryOne("select header, banner, logo as photo, favicon, social, slideshow from #_sample where id_interface = ? limit 0,1", array($v['id_interface']));

		        	$logo =  $d->rawQueryOne("select id, photo, options from #_photo where id_shop = ? and type = ? and act = ? limit 0,1", array($v['id'], 'logo', 'photo_static'));
					$logoPhoto = (!empty($logo)) ? $logo : ((!empty($sampleData)) ? $sampleData : array());


		        	$Subscribe=$d->rawQueryOne("select * from #_$tableShopSubscribe where id_shop=?",array($v['id']));
		        	$Star=$d->rawQueryOne("select score from #_$tableShopRating where id_shop=?",array($v['id']));
		        	$v['thumb']=$configBaseSectors.THUMBS.'/300x300x1/'.UPLOAD_SHOP_L.$v['photo'];
		        	$v['photo']=$configBaseSectors.UPLOAD_SHOP_L.$v['photo'];
		        	$v['logo']=$configBaseSectors.UPLOAD_PHOTO_L.$logoPhoto['photo'];
		        	$v['logothumb']=$configBaseSectors.THUMBS.'/120x120x2/'.UPLOAD_PHOTO_L.$logoPhoto['photo'];
		        	$v['slug_url']=$configBaseSectors.'shop/'.$v['slug_url'];
		        	$v['slug_url_admin']=$configBaseSectors.'shop/'.$v['slug_url'].'/admin';
		        	$v['subscribe']=(!empty($Subscribe['quantity']))?$Subscribe['quantity']:0;
		        	$v['star']=(!empty($Star['score']))?$Star['score']:0;
		        	$v['address']=$func->getInfoDetail('name', "wards", $v['id_wards'])['name'].', '.$func->getInfoDetail('name', "district", $v['id_district'])['name'].', '.$func->getInfoDetail('name', "city", $v['id_city'])['name'];
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

