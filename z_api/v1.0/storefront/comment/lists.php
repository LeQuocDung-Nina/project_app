<?php 
	if($requestMethod=='GET'){
        $arraycheck=array('id_member');
        $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
        if(!$responses_check['error'] ){
	    	$responses = [
		        'status' => 200,
		        'total' => 0,
		        'limit' => 24,
		        'data' => []
		    ];

	    	$id_member=$_GET['id_member'];
	    	$curPage = (!empty($_GET['p']))?$_GET['p']:1;
	        $perPage = $responses['limit'];
	        $startpoint = ($curPage * $perPage) - $perPage;

			/* Where product */
            $whereProduct = "A.id_shop = $idShop and A.status = ? and A.status_user = ? and A.id_member = ?";
            $paramsProduct = array('xetduyet', 'hienthi', $id_member);

            /* SQL main */
            $sqlProduct = "select A.id as id, A.namevi as namevi, A.photo as photo, A.slugvi as slugvi, A.date_created as date_created from #_$tableProductMain as A inner join #_$tableProductComment as C on C.id = (select id from #_$tableProductComment as LJ_C where A.id = LJ_C.id_product limit 0,1) and find_in_set('hienthi',C.status) where $whereProduct order by C.date_posted desc limit $startpoint,$perPage";

     

            /* SQL num */
            $sqlProductNum = "select count(*) as 'num' from #_$tableProductMain as A inner join #_$tableProductComment as C on C.id = (select id from #_$tableProductComment as LJ_C where A.id = LJ_C.id_product limit 0,1) and find_in_set('hienthi',C.status) where $whereProduct order by C.date_posted desc";

            /* Get data */
            $products = $d->rawQuery($sqlProduct,$paramsProduct);
            $count = $d->rawQueryOne($sqlProductNum,$paramsProduct);

            $total = (!empty($count)) ? $count['num'] : 0;
            $url = $func->getCurrentPageURL();
            $paging = $func->pagination($total, $perPage, $curPage, $url);

            if ($products) {
                $comment = new Comments($d, $func, ['shop' => $tableShop, 'main' => $tableProductComment, 'photo' => $tableProductCommentPhoto, 'video' => $tableProductCommentVideo], $sectorType);
                foreach ($products as $key => $value) {
                    $products[$key]['photo']= $sector['url'].'thumbs/400x300x1/'.UPLOAD_PRODUCT_L.$value['photo'];
                    $products[$key]['slugvi']= $sector['url'].$sectorType.'/'.$value['slugvi'].'/'.$value['id'];

                    $products[$key]['totalComment'] = $comment->totalByID($value['id']);
                    $products[$key]['newComment'] = $comment->newPost($value['id'], 'new-member');
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
