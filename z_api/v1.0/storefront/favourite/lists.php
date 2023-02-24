<?php 
if($requestMethod=='GET'){


	$arraycheck=array('id_member');
	$responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
	if(!$responses_check['error'] ){
		$responses = [
			'status' => 200,
			// 'sector' => $sector,
			'total' => 0,
			'limit' => 24,
			'data' => []
		];

		$id_member=$_GET['id_member'];
		$curPage = (!empty($_GET['p']))?$_GET['p']:1;
		$perPage = $responses['limit'];
		$startpoint = ($curPage * $perPage) - $perPage;

		$sampleData = $cache->get("select id_interface, logo from #_sample", null, 'result', 7200);

		if (!empty($sampleData)) {
			$sampleData['interface'] = array();
			foreach ($sampleData as $k => $v) {
				if ($func->isNumber($k)) {
					$sampleData['interface'][$v['id_interface']] = $v;
				}
			}
		}

		/* Get favourite */
		$favourites = $cache->get("select id_variant,type from #_member_favourite where id_member = ? and type = ? and variant = ?", array($id_member, $sector['type'], 'product'), "result", 7200);

		/* Check favourite */
		if (!empty($favourites)) {
			/* Progess favourite */
			$IDFavourites = (!empty($favourites)) ? $func->joinCols($favourites, 'id_variant') : '';
			$favourites = (!empty($IDFavourites)) ? explode(",", $IDFavourites) : array();

			/* Where product */
			$whereProduct = "A.status = ?";
			$paramsProduct = array('xetduyet');

			/* Where logic when owner or shop unactive */
			$whereLogicOwner = $func->getLogicOwner($tableShop, $sector);
			$whereProduct .= $whereLogicOwner['where'];

			/* Where favourite */
			$whereProduct .= " and A.id in ($IDFavourites)";

			/* Where logic when shop unactive */
			$whereProduct .= $func->getLogicShop($tableShop, $whereLogicOwner);
			/* SQL main */
			if ($sector['id']==3) {
				$selectProduct = "A.id as id, A.namevi as namevi,A.acreage as descvi ,A.slugvi as slugvi, A.photo as photo, A.regular_price as regular_price, A.date_created as date_created ";
			}else{
				$selectProduct = "A.id as id, A.namevi as namevi,A.descvi as descvi ,A.slugvi as slugvi, A.photo as photo, A.regular_price as regular_price, A.date_created as date_created ";
			}
			$sqlProduct = "select $selectProduct from #_$tableProductMain as A  where $whereProduct order by A.date_created desc limit $startpoint,$perPage";

			/* SQL num */
			$sqlProductNum = "select count(*) as 'num' from #_$tableProductMain  as A where $whereProduct order by A.date_created desc";

			/* Get data */
			if (!empty($sqlProduct)) {
				$products = $cache->get($sqlProduct, $paramsProduct, 'result', 7200);
				if ($products) {
					foreach ($products as $key => $value) {
						$products[$key]['type']=$sector['type'];
						$products[$key]['photo']= $sector['url'].'thumbs/180x140x1/'.UPLOAD_PRODUCT_L.$value['photo'];
						$products[$key]['slugvi']= $sector['url'].$sector['type'].'/'.$value['slugvi'].'/'.$value['id'];
						$products[$key]['priceType'] = $variation->get($tableProductVariation, $value['id'], 'loai-gia', $lang);
						if ($sector['id']==6 || $sector['id']==5) {
							$v_product['experience'] = $variation->get($tableProductVariation, $value['id'], 'kinh-nghiem', $lang);
							$products[$key]['descvi'] = "Kinh nghiệm: ".$v_product['experience'];
						}
						if ($sector['id']==3) {
							$products[$key]['descvi'] = "Diện tích: ".$v_product['descvi'] ."m";
						}
					}
				}
				$count = $cache->get($sqlProductNum, $paramsProduct, 'fetch', 7200);
				$total = (!empty($count)) ? $count['num'] : 0;
				$url = $func->getCurrentPageURL();
				$paging = $func->pagination($total, $perPage, $curPage, $url);
			}
		}

		$responses['total']=$total;
		$responses['data']=$products;
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
