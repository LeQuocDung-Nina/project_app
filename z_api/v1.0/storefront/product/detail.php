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

				$colsDetailSelect = "id,id_shop,id_list,id_item,id_cat,id_sub,id_member,id_admin,id_region,id_city,id_district,id_wards,photo,options,slugvi,namevi,descvi,regular_price,real_price,coordinates,views,numb,status,status_user,status_attr,date_created,date_updated";
				$sqlDetail = "select $colsDetailSelect from #_$tableProductMain where id=?";
				$paramsDetail = array($idProduct);
				$rowDetail = $d->rawQueryOne($sqlDetail, $paramsDetail);
				$rowDetail['options']=json_decode($rowDetail['options'],true);
				$rowDetail['priceType'] = $variation->get($tableProductVariation, $rowDetail['id'], 'loai-gia', 'vi');
				if($Idsectors==5 || $Idsectors==6){
					$rowDetail['level'] = $variation->get($tableProductVariation, $rowDetail['id'], 'trinh-do-hoc-van', 'vi');
					$rowDetail['experience'] = $variation->get($tableProductVariation, $rowDetail['id'], 'kinh-nghiem', 'vi');
				}
				$rowDetailVideo = $d->rawQueryOne("select photo, video, name$lang, type from #_$tableProductVideo where id_parent = ? and name$lang != '' and video != ''", array($rowDetail['id']));
		        $rowDetail['video'] = $rowDetailVideo;
		        $rowDetail['video']['photo']=$configBaseSectors.UPLOAD_PHOTO_L.$rowDetail['video']['photo'];
		        $rowDetail['video']['video']=$configBaseSectors.UPLOAD_VIDEO_L.$rowDetail['video']['video'];
		        $rowDetailPhoto = $d->rawQuery("select id, photo from #_$tableProductPhoto where id_parent = ?", array($rowDetail['id']));



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



		        foreach ($rowDetailPhoto as $v) {
		        	$data_photo=array();
		        	$data_photo['id']=$v['id'];
		        	$data_photo['thumb']=$configBaseSectors.THUMBS.'/300x300x1/'.UPLOAD_PRODUCT_L.$v['photo'];
		        	$data_photo['photo']=$configBaseSectors.UPLOAD_PRODUCT_L.$v['photo'];
		        	$rowDetail['Gallery'][]=$data_photo;
		        }

				$rowDetail['thumb']=$configBaseSectors.THUMBS.'/300x300x1/'.UPLOAD_PRODUCT_L.$rowDetail['photo'];
		        $rowDetail['photo']=$configBaseSectors.UPLOAD_PRODUCT_L.$rowDetail['photo'];
		        $rowDetail['slugvi']=$configBaseSectors.$sector['type'].'/'.$rowDetail['slugvi'].'/'.$rowDetail['id'];

		        $rowTag=$d->rawQuery("select a.id,a.namevi as name from #_product_tags as a, #_$tableProductTag as b where a.id=b.id_tag and b.id_parent=? and find_in_set('hienthi',a.status)",array($rowDetail['id']));
		        $rowDetail['Tags']=$rowTag;

				if(!empty($tableProductSale)){
					$rowSize=$d->rawQuery("select a.id,a.namevi as name from #_product_size as a, #_$tableProductSale as b where a.id=b.id_size and b.id_parent=?",array($rowDetail['id']));
					$rowDetail['Size']=$rowSize;
	
					$rowColor=$d->rawQuery("select a.id,a.namevi as name from #_product_color as a, #_$tableProductSale as b where a.id=b.id_color and b.id_parent=?",array($rowDetail['id']));
					$rowDetail['Color']=$rowColor;
				}
		     
		        $rowContent=$d->rawQueryOne("select propertiesvi as properties,contentvi,id from #_$tableProductContent where id_parent=?",array($rowDetail['id']));
		        if(!empty($rowContent['id'])){
		        	$Properties=json_decode($rowContent['properties'],true);
		        	foreach ($Properties as $k => $v) {
		        		$row_properties = $d->rawQueryOne("select id,namevi from #_variation where id=".$k." and find_in_set('hienthi',status) and type='thuoc-tinh-dong'");
		        		$list=array();
		        		$list['id']=$k;
		        		$list['name']=$row_properties['namevi'];
		        		$list['content']=$v;
		        		$rowContentData['properties'][]=$list;
		        	}
		        	$rowContentData['content']=$rowContent['contentvi'];
		        	$rowDetail['Content']=$rowContentData;
		        }
		        

		        $rowUserInfo=$d->rawQueryOne("select fullname,phone,address,email,id from #_$tableProductContact where id_parent=?",array($rowDetail['id']));
		        $rowDetail['UserContact']=$rowUserInfo;
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
