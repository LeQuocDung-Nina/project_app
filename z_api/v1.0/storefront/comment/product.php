<?php 
if($requestMethod=='GET'){

    $arraycheck=array('id');
    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
	if(!$responses_check['error']){
		$responses = [
	        'status' => 200,
	        'total' => 0,
	        'data' => []
	    ];
	    $id_pro=$_GET['id'];

        if (!empty($tableProductMain) && !empty($tableProductComment)) {
            /* Where logic when owner or shop unactive */
            $whereLogicOwner = $func->getLogicOwner($tableShop, $sector, false);
            $where = $whereLogicOwner['where'];

            /* Get data detail */
            $productDetail = $cache->get("select id, namevi, slugvi, slugen, photo, date_created from #_$tableProductMain as A where A.id = ?  $where limit 0,1", array($id_pro), 'fetch', 7200);

            /* Check data detail */
            if (!empty($productDetail)) {
                /* Comment */
                $comment = new Comments($d, $func, ['shop' => $tableShop, 'main' => $tableProductComment, 'photo' => $tableProductCommentPhoto, 'video' => $tableProductCommentVideo], $sectorType, $productDetail['id']);
                $productDetail['count_comment']=$comment->total;
                $productDetail['total_star']=$comment->total_star;
                $productDetail['count_star']=$comment->count_star;
                $productDetail['star']=$comment->star;
                $productDetail['avgPoint'] = $comment->avgPoint();
                $productDetail['avgStar'] = $comment->avgStar();
                $productDetail['total'] = $comment->total;
                $productDetail['rate'][5] = $comment->perScore(5);
                $productDetail['rate'][4] = $comment->perScore(4);
                $productDetail['rate'][3] = $comment->perScore(3);
                $productDetail['rate'][2] = $comment->perScore(2);
                $productDetail['rate'][1] = $comment->perScore(1);
                $productDetail['photo']=$sector['url'].'thumbs/90x90x1/'.UPLOAD_PRODUCT_L.$productDetail['photo'];
                $productDetail['slugvi']=$sector['url'].$sector['type'].'/'.$productDetail['slugvi'].'/'.$productDetail['id'];
            } 
        }
        $responses['data'] = $productDetail;
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