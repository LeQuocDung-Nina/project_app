<?php 
	if($requestMethod=='GET'){
		try {
		    $arraycheck=array('id_member');
		    $responses_check = $validation->storefrontCheckNull(json_encode($_GET),$arraycheck);
		    $param=array();
		    if(!$responses_check['error'] ){
		    	$responses = [
			        'status' => 200,
			        'total' => 0,
			        'data' => []
			    ];

		    	$id_member=$_GET['id_member'];
			    $curPage = (!empty($_GET['p']))?$_GET['p']:1;
		        $perPage = 40;
		        $startpoint = ($curPage * $perPage) - $perPage;

			    $where =" where id_member=?";
			    array_push($param,$id_member);

			    $order_status = (!empty($_REQUEST['order_status'])) ? htmlspecialchars($_REQUEST['order_status']) : 0;
			    $order_payment = (!empty($_REQUEST['order_payment'])) ? htmlspecialchars($_REQUEST['order_payment']) : 0;
			    $order_date = (!empty($_REQUEST['order_date'])) ? htmlspecialchars($_REQUEST['order_date']) : 0;
			    $order_range_price = (!empty($_REQUEST['order_range_price'])) ? htmlspecialchars($_REQUEST['order_range_price']) : 0;
			    $order_city = (!empty($_REQUEST['order_city'])) ? htmlspecialchars($_REQUEST['order_city']) : 0;
			    $order_district = (!empty($_REQUEST['order_district'])) ? htmlspecialchars($_REQUEST['order_district']) : 0;
			    $order_wards = (!empty($_REQUEST['order_wards'])) ? htmlspecialchars($_REQUEST['order_wards']) : 0;


			    if(!empty($order_status)){
			    	$where .=" and order_status=?";
			    	array_push($param,$order_status);
			    }
			    if(!empty($order_payment)){
			    	$where .=" and order_payment=?";
			    	array_push($param,$order_payment);
			    }
			    if ($order_date) {
			        $order_date = explode("-", $order_date);
			        $date_from = trim($order_date[0] . ' 12:00:00 AM');
			        $date_to = trim($order_date[1] . ' 11:59:59 PM');
			        $date_from = strtotime(str_replace("/", "-", $date_from));
			        $date_to = strtotime(str_replace("/", "-", $date_to));
			        $where .= " and date_created<=$date_to and date_created>=$date_from";
			    }
			    if ($order_range_price) {
			        $order_range_price = explode(":", $order_range_price);
			        $price_from = trim($order_range_price[0]);
			        $price_to = trim($order_range_price[1]);
			        $where .= " and total_price<=$price_to and total_price>=$price_from";
			    }
			    if ($order_city) $where .= " and JSON_UNQUOTE(JSON_EXTRACT(order_group_info, '$.city')) = $order_city";
			    if ($order_district) $where .= " and JSON_UNQUOTE(JSON_EXTRACT(order_group_info, '$.district')) = $order_district";
			    if ($order_wards) $where .= " and JSON_UNQUOTE(JSON_EXTRACT(order_group_info, '$.wards')) = $order_wards";

			    $sqlOrder = "select code,order_status,total_price,date_created,order_group_detail,order_payment from #_order_group $where order by date_created desc limit $startpoint,$perPage";
			    $rowData=$d->rawQuery($sqlOrder,$param);

				$sqlNum = "select count(*) as 'num' from #_order_group $where order by date_created desc";
			    $count = $d->rawQueryOne($sqlNum,$param);
			    $total = (!empty($count)) ? $count['num'] : 0;
			    $responses['total']=$total;

			    foreach ($rowData as $v) {
			    	$id_order_status = $v['order_status'];
                    $order_status = $d->rawQueryOne("select namevi, class_order from #_order_status where id = ?", array($id_order_status));
                    $v['status']=$order_status['namevi'];
                    $v['status_class']=$order_status['class_order'];
			    	$id_order_payments = $v['order_payment'];
                    $order_payments = $d->rawQueryOne("select namevi from #_news where id = ?", array($id_order_payments));
                    $v['payments']=$order_payments['namevi'];
                    $detailLists=array_values(json_decode($v['order_group_detail'],true));
                    $detailCount = (!empty($detailLists)) ? (count($detailLists) - 1) : 0;
					$detailListsText = ($detailCount >= 1) ? '<strong>... và ' . $detailCount . ' sản phẩm khác</strong>' : '';
					$v['detailLists']=$detailLists[0]['name'].htmlspecialchars_decode($detailListsText);
					unset($v['order_group_detail']);
					unset($v['order_status']);
                    $responses['data'][]=$v;
			    }

			    $minTotal = $d->rawQueryOne("select min(total_price) from #_order_group where id_member = $id_member");
			    if ($minTotal['min(total_price)']) $minTotal = $minTotal['min(total_price)'];
			    else $minTotal = 0;

			    $maxTotal = $d->rawQueryOne("select max(total_price) from #_order_group where id_member = $id_member");
			    if ($maxTotal['max(total_price)']) $maxTotal = $maxTotal['max(total_price)'];
			    else $maxTotal = 0;

			    $responses['minTotal']=$minTotal;
			    $responses['maxTotal']=$maxTotal;

			    /* Lấy đơn hàng - mới đặt */
		        $order_count = $d->rawQueryOne("select count(id), sum(total_price) from #_order_group where id_member = $id_member and order_status = 1");
		        $responses['statistical']['NewOrder']['allNewOrder']=$order_count['count(id)'];
		        $responses['statistical']['NewOrder']['totalNewOrder']=$order_count['sum(total_price)'];

		        /* Lấy đơn hàng - đã xác nhận */
		        $order_count = $d->rawQueryOne("select count(id), sum(total_price) from #_order_group where id_member = $id_member and order_status = 2");
		        $responses['statistical']['ConfirmOrder']['allConfirmOrder']=$order_count['count(id)'];
		        $responses['statistical']['ConfirmOrder']['totalConfirmOrder']=$order_count['sum(total_price)'];

		        /* Lấy đơn hàng - đã giao */
		        $order_count = $d->rawQueryOne("select count(id), sum(total_price) from #_order_group where id_member = $id_member and order_status = 4");
		        $responses['statistical']['DeliveriedOrder']['allDeliveriedOrder']=$order_count['count(id)'];
		        $responses['statistical']['DeliveriedOrder']['totalDeliveriedOrder']=$order_count['sum(total_price)'];

		        /* Lấy đơn hàng - đã hủy */
		        $order_count = $d->rawQueryOne("select count(id), sum(total_price) from #_order_group where id_member = $id_member and order_status = 5");
		        $responses['statistical']['CanceledOrder']['allCanceledOrder']=$order_count['count(id)'];
		        $responses['statistical']['CanceledOrder']['totalCanceledOrder']=$order_count['sum(total_price)'];

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