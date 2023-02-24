<?php 
	if($requestMethod=='GET'){
		try {
			$responses = [
		        'status' => 200,
		    ];
		    $idProduct=$match['params']['id'];
			$_GET['id']=$idProduct;
			$arraycheck=array('id');
		    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		    if(!$responses_check['error']){
		    	$tableProductMain = (!empty($sector['tables']['main'])) ? $sector['tables']['main'] : '';
		        $tableProductContent = (!empty($sector['tables']['content'])) ? $sector['tables']['content'] : '';
		        $tableProductPhoto = (!empty($sector['tables']['photo'])) ? $sector['tables']['photo'] : '';
		        $tableProductTag = (!empty($sector['tables']['tag'])) ? $sector['tables']['tag'] : '';
		        $tableProductSale = (!empty($sector['tables']['sale'])) ? $sector['tables']['sale'] : '';
		        $tableProductVideo = (!empty($sector['tables']['video'])) ? $sector['tables']['video'] : '';
		        $tableProductContact = (!empty($sector['tables']['contact'])) ? $sector['tables']['contact'] : '';
		        $tableProductVariation = (!empty($sector['tables']['variation'])) ? $sector['tables']['variation'] : '';
		        $tableShop = (!empty($sector['tables']['shop'])) ? $sector['tables']['shop'] : '';
		        $tableShopSubscribe = (!empty($sector['tables']['shop-subscribe'])) ? $sector['tables']['shop-subscribe'] : '';
		        $tableShopRating = (!empty($sector['tables']['shop-rating'])) ? $sector['tables']['shop-rating'] : '';

				$colsDetailSelect = "id,id_list,id_cat,password,id_member,id_region,id_city,id_district,id_wards,id_interface,id_store,photo,slug,slug_url,username,name,status,status_user";
				$sqlDetail = "select $colsDetailSelect from #_$tableShop where id=?";
				$paramsDetail = array($idProduct);
				$rowDetail = $d->rawQueryOne($sqlDetail, $paramsDetail);
				$rowDetail['options']=json_decode($rowDetail['options'],true);
				$rowDetail['thumb']=$configBaseSectors.THUMBS.'/380x260x1/'.UPLOAD_SHOP_L.$rowDetail['photo'];
		        $rowDetail['photo']=$configBaseSectors.UPLOAD_SHOP_L.$rowDetail['photo'];
		        $rowDetail['slug_url']=$configBaseSectors.'shop/'.$rowDetail['slug_url'];
		        $rowDetail['slug_url_admin']=$configBaseSectors.'shop/'.$rowDetail['slug_url'].'/admin';


		        if(!empty($rowDetail['id_list'])){
		        	$row=$d->rawQueryOne("select namevi,id from #_product_list where id=?",array($rowDetail['id_list']));
		        	$list['id']=$row['id'];
		        	$list['name']=$row['namevi'];
		        	$rowDetail['id_list']=$list;
		        }
		        if(!empty($rowDetail['id_cat'])){
		        	$row=$d->rawQueryOne("select namevi,id from #_product_cat where id=?",array($rowDetail['id_cat']));
		        	$cat['id']=$row['id'];
		        	$cat['name']=$row['namevi'];
		        	$rowDetail['id_cat']=$cat;
		        }

		        if(!empty($rowDetail['id_item'])){
		        	$row=$d->rawQueryOne("select namevi,id from #_product_item where id=?",array($rowDetail['id_item']));
		        	$item['id']=$row['id'];
		        	$item['name']=$row['namevi'];
		        	$rowDetail['id_item']=$item;
		        }
		        if(!empty($rowDetail['id_sub'])){
		        	$row=$d->rawQueryOne("select namevi,id from #_product_sub where id=?",array($rowDetail['id_sub']));
		        	$sub['id']=$row['id'];
		        	$sub['name']=$row['namevi'];
		        	$rowDetail['id_sub']=$sub;
		        }
		        if(!empty($rowDetail['id_city'])){
					$city['id']=$rowDetail['id_city'];
					$city['text']=$func->getInfoDetail('id_region, name', "city", $rowDetail['id_city'])['name'];
					$rowDetail['id_city']=$city;
				}
				if(!empty($rowDetail['id_district'])){
					$district['id']=$rowDetail['id_district'];
					$district['text']=$func->getInfoDetail(' name', "district", $rowDetail['id_district'])['name'];
					$rowDetail['id_district']=$district;
				}
				
				if(!empty($rowDetail['id_wards'])){
					$wards['id']=$rowDetail['id_wards'];
					$wards['text']=$func->getInfoDetail(' name', "wards", $rowDetail['id_wards'])['name'];
					$rowDetail['id_wards']=$wards;
				}
				if(!empty($rowDetail['id_store'])){
					$row=$d->rawQueryOne("select namevi,id from #_store where id=?",array($rowDetail['id_store']));
		        	$store['id']=$row['id'];
		        	$store['name']=$row['namevi'];
		        	$rowDetail['id_store']=$store;
				}
				if(!empty($rowDetail['id_member'])){
		        	$restApi = new RestApi();
				    $apiResp = $restApi->get(str_replace('{id}',$rowDetail['id_member'],$apiRoutes['storefront']['member']['detail']));
				    $groupInfo = $restApi->decode($apiResp, true);
				    $data_seller['id']=$groupInfo['data']['id'];
				    $data_seller['fullname']=$groupInfo['data']['fullname'];
				    $data_seller['email']=$groupInfo['data']['email'];
				    $data_seller['username']=$groupInfo['data']['username'];
				    $rowDetail['UserMember']=$data_seller;
		        }
				$responses['data']=$rowDetail;
		       	returnData($responses);
		    }else{
		    	$responses = [
			        'status' => 409,
			        'data' => $responses_check
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
	}else{
		header('HTTP/1.0 405 Method Not Allowed', true, 405);
	}
