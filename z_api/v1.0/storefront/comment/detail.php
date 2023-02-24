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

            /* Comment */
            $comment = new Comments($d, $func, ['shop' => $tableShop, 'main' => $tableProductComment, 'photo' => $tableProductCommentPhoto, 'video' => $tableProductCommentVideo], $sectorType, $id_pro);
       		
       		foreach ($comment->lists as $key => $v_lists) {


                /* Params data */
                $comment_list[$key] = array();
                $comment_list[$key]['id_product'] = $id_pro;
                $comment_list[$key]['is_check'] = true;
                $comment_list[$key]['variant'] = 'personal';
                $comment_list[$key]['link_url'] = $sector['url'];
                $comment_list[$key]['link_thumb'] = $sector['url'].'thumbs/70x70x1/'.UPLOAD_PHOTO_L;
                $comment_list[$key]['link_video'] = $sector['url'].UPLOAD_VIDEO_L;
                $comment_list[$key]['lists'] = $v_lists;
                $comment_list[$key]['lists']['photo'] = $comment->photo($v_lists['id']);
                $comment_list[$key]['lists']['video'] = $comment->video($v_lists['id']);
                $comment_list[$key]['lists']['replies'] = $comment->replies($v_lists['id'], $id_pro);
                $comment_list[$key]['lists']['total'] = $comment->totalReplies($v_lists['id'], $id_pro);

            }            
        }
        $responses['data'] = $comment;
        $responses['comment-list'] = $comment_list;
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