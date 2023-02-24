<?php 
	if($requestMethod=='GET'){
		try {
		    $arraycheck=array('id_user');
		    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		    $param=array();
		    if(!$responses_check['error'] ){
		    	$responses = [
			        'status' => 200,
			        'total' => 0,
			        'data' => []
			    ];

		    	$id_user=$_GET['id_user'];
			    if(isset($_GET['status']) && $_GET['status']!='') $order_status=$_GET['status'];
			    if(isset($_GET['payment']) && $_GET['status']!='') $order_payment=$_GET['payment'];
			    $curPage = (!empty($_GET['p']))?$_GET['p']:1;
		        $perPage = 40;
		        $startpoint = ($curPage * $perPage) - $perPage;

			    $where =" where id_user=?";
			    array_push($param,$id_user);
			    if(!empty($order_status)){
			    	$where .="order_status=?";
			    	array_push($param,$order_status);
			    }
			    if(!empty($order_payment)){
			    	$where .="order_payment=?";
			    	array_push($param,$order_payment);
			    }
			    $sqlOrder = "select code,order_status,total_price,date_created,order_detail from #_order $where order by date_created desc limit $startpoint,$perPage";
			    $rowData=$d->rawQuery($sqlOrder,$param);

				$sqlNum = "select count(*) as 'num' from #_order $where order by date_created desc";
			    $count = $d->rawQueryOne($sqlNum,$param);
			    $total = (!empty($count)) ? $count['num'] : 0;
			    $responses['total']=$total;
			    foreach ($rowData as $v) {
			    	$id_order_status = $v['order_status'];
                    $order_status = $d->rawQueryOne("select namevi, class_order from #_order_status where id = ?", array($id_order_status));
                    $v['status']=$order_status['namevi'];
                    $v['status_class']=$order_status['class_order'];
                    $detailLists=array_values(json_decode($v['order_detail'],true));
                    $detailCount = (!empty($detailLists)) ? (count($detailLists) - 1) : 0;
					$detailListsText = ($detailCount >= 1) ? '<strong>... và ' . $detailCount . ' sản phẩm khác</strong>' : '';
					$v['detailLists']=$detailLists[0]['name'].htmlspecialchars_decode($detailListsText);
					unset($v['order_detail']);
					unset($v['order_status']);

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