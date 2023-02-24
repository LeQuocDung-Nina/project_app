<?php 
	if($requestMethod=='POST'){
		
	    $arraycheck=array('id_member','id_product');
	    $responses_check = $validation->storefrontCheckNull(json_encode($_POST),$arraycheck);
	    if(!$responses_check['error'] ){
	    	$responses = [
		        'status' => 200,
		        'total' => 0,
		        'data' => []
		    ];

            $comment = new Comments($d, $func, ['shop' => $tableShop, 'main' => $tableProductComment, 'photo' => $tableProductCommentPhoto, 'video' => $tableProductCommentVideo], $sectorType);

			$data = (!empty($_POST)) ? $_POST : null;

            if (!empty($data)) {
                foreach ($data as $column => $value) {
                    $data[$column] = htmlspecialchars($func->sanitize($value));
                }

                $data['date_posted'] = time();

                /* is Check */
                if (!empty($data['is_check']) && $data['is_check'] == 1) {
                    $data['status'] = 'hienthi';
                    $is_check = true;
                } else {
                    $is_check = false;
                    $data['status'] = 'new-admin';
                }

                /* Status for owner */
                if (!empty($data['variant'])) {
                    if (empty($is_check)) {
                        $data['status'] .= ($data['variant'] == 'shop') ? ',new-shop' : (($data['variant'] == 'personal') ? ',new-member' : '');
                    }
                }

                /* Unset data temp */
                unset($data['variant']);
                unset($data['is_check']);

                if (empty($data['content']) || (!empty($data['fullname_parent']) && trim($data['content']) == $data['fullname_parent'])) {
                    $responses['status'] = 409;
	                $responses['data'] = 'Chưa nhập nội dung đánh giá';
                } else {
                    unset($data['fullname_parent']);
                }

                if (empty($errors)) {
                    if ($d->insert($tableProductComment, $data)) {
                        $id_insert = $d->getLastInsertId();                        

                        /* Update status */
                        if ($is_check) {
                            $comment->updateStatus($data['id_parent']);
                        }
                        $responses['data'] = 'Thành công 1';
                    }
                }else{
                    $responses['status'] = 409;
                    $responses['data'] = 'Dữ liệu không hợp lệ';
                }
            } else {
                $responses['status'] = 409;
                $responses['data'] = 'Dữ liệu không hợp lệ';
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
