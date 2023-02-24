<?php 
	if($requestMethod=='GET'){
		

	    $arraycheck=array('limitFrom','limitGet','idProduct','type');
	    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
	    if(!$responses_check['error'] ){
	    	$responses = [
		        'status' => 200,
		        'total' => 0,
		        'data' => []
		    ];
			
			$limitFrom = $_GET['limitFrom'];
	        $limitGet = $_GET['limitGet'];
	        $id_product = $_GET['idProduct'];

	        $id_parent = (!empty($_GET['idParent'])) ? $_GET['idParent'] : 0;
	        $is_admin = (!empty($_GET['isAdmin']) && $_GET['isAdmin']==1) ? true : false;
	        $is_check = (!empty($_GET['isCheck']) && $_GET['isCheck']==1) ? true : false;
	        $is_owner = (!empty($_GET['isOwner']) && $_GET['isOwner']==1) ? true : false;
        	$variant = (!empty($_GET['variant'])) ? $_GET['variant'] : '';
        	$markdownType = (!empty($is_admin)) ? 'admin' : 'customer';
	
            $comment = new Comments($d, $func, ['shop' => $tableShop, 'main' => $tableProductComment, 'photo' => $tableProductCommentPhoto, 'video' => $tableProductCommentVideo], $sectorType);
	        $where = (!empty($is_admin)) ? "" : "find_in_set('hienthi',A.status) and";

    		if ($_GET['type']=='limitReplies') {
		        if (!empty($tableShop)) {
		            $rows = $d->rawQuery("select A.id as id, A.id_parent as id_parent, A.id_shop as id_shop, A.id_product as id_product, A.id_member as id_member, A.star as star, A.title as title, A.content as content, A.poster as poster, A.status as status, A.date_posted as date_posted, S.id_interface as shopInterface, S.name as shopName, P.photo as shopLogo, M.avatar as memberAvatar, M.fullname as memberName, M.phone as memberPhone, M.email as memberEmail, U.fullname as adminName, U.phone as adminPhone, U.email as adminEmail from #_$tableProductComment as A left join #_$tableShop as S on A.id_shop = S.id and S.status = 'xetduyet' and S.status_user = 'hienthi' left join #_photo as P on A.id_shop = P.id_shop and P.sector_prefix = ? and P.type = 'logo' left join #_member as M on A.id_member = M.id and find_in_set('hienthi',M.status) and !find_in_set('virtual',M.status) left join #_user as U on A.id_admin = U.id and find_in_set('hienthi',U.status) where $where A.id_parent = ? and A.id_product = ? order by A.date_posted desc limit $limitFrom,$limitGet", array($table['prefix'], $id_parent, $id_product));
		        } else {
		            $rows = $d->rawQuery("select A.id as id, A.id_parent as id_parent, A.id_product as id_product, A.id_member as id_member, A.star as star, A.title as title, A.content as content, A.poster as poster, A.status as status, A.date_posted as date_posted, M.avatar as memberAvatar, M.fullname as memberName, M.phone as memberPhone, M.email as memberEmail, U.fullname as adminName, U.phone as adminPhone, U.email as adminEmail from #_$tableProductComment as A left join #_member as M on A.id_member = M.id and find_in_set('hienthi',M.status) and !find_in_set('virtual',M.status) left join #_user as U on A.id_admin = U.id and find_in_set('hienthi',U.status) where $where A.id_parent = ? and A.id_product = ? order by A.date_posted desc limit $limitFrom,$limitGet", array($id_parent, $id_product));
		        }

		        $responses['total'] = $comment->totalReplies($id_parent, $id_product, $is_admin);

		
		        if (!empty($rows)) {
		            /* Params data */
		            $params = array();
		            $params['is_check'] = $is_check;
		            $params['is_owner'] = $is_owner;
		            $params['replies'] = $rows;

		            /* Get template */
		            // $responses['data'] = $comment->markdown($markdownType . '/replies', $params);
		            $responses['data'] = $rows;
		        }

    		}

    		if ($_GET['type']=='limitLists') {
				if (!empty($tableShop)) {
            		$rows = $d->rawQuery("select A.id as id, A.id_parent as id_parent, A.id_shop as id_shop, A.id_product as id_product, A.id_member as id_member, A.star as star, A.title as title, A.content as content, A.poster as poster, A.status as status, A.date_posted as date_posted, S.id_interface as shopInterface, S.name as shopName, P.photo as shopLogo, M.avatar as memberAvatar, M.fullname as memberName, M.phone as memberPhone, M.email as memberEmail from #_$tableProductComment as A left join #_$tableShop as S on A.id_shop = S.id and S.status = 'xetduyet' and S.status_user = 'hienthi' left join #_photo as P on A.id_shop = P.id_shop and P.sector_prefix = ? and P.type = 'logo' left join #_member as M on A.id_member = M.id and find_in_set('hienthi',M.status) and !find_in_set('virtual',M.status) where $where A.id_parent = 0 and A.id_product = ? order by A.date_posted desc limit $limitFrom,$limitGet", array($table['prefix'], $id_product));
		        } else {
		        	$rows = $d->rawQuery("select A.id as id, A.id_parent as id_parent, A.id_product as id_product, A.id_member as id_member, A.star as star, A.title as title, A.content as content, A.poster as poster, A.status as status, A.date_posted as date_posted, M.avatar as memberAvatar, M.fullname as memberName, M.phone as memberPhone, M.email as memberEmail from #_$tableProductComment as A left join #_member as M on A.id_member = M.id and find_in_set('hienthi',M.status) and !find_in_set('virtual',M.status) where $where A.id_parent = 0 and A.id_product = ? order by A.date_posted desc limit $limitFrom,$limitGet", array($id_product));
		        }

        		$count = $d->rawQueryOne("select count(*) as 'num' from #_$tableProductComment as A where $where id_parent = 0 and id_product = ? order by date_posted desc", array($id_product));
		        $responses['total'] = $count['num'];

		        if (!empty($rows)) {
		            foreach ($rows as $k => $v) {
		                /* Params data */
		                $params = array();
		                $params['id_product'] = $v['id_product'];
		                $params['is_admin'] = $is_admin;
		                $params['is_check'] = $is_check;
		                $params['is_owner'] = $is_owner;
		                $params['variant'] = $variant;
		                $params['limitChildShow'] = 3;
		                $params['limitChildGet'] = 1;
		                $params['lists'] = $v;
		                $params['lists']['photo'] = $comment->photo($v['id']);
		                $params['lists']['video'] = $comment->video($v['id']);
		                $params['lists']['replies'] = $comment->replies($v['id'], $v['id_product'], $is_admin);
  						$params['lists']['total'] = $comment->totalReplies($v['id'], $v['id_product']);

		                /* Get template */
		                // $responses['data'] = $comment->markdown($markdownType . '/lists', $params);
		                $responses['data'][$k] =$params;
		            }
		        }

    		}

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
