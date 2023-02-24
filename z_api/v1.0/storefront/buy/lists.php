<?php 
	if($requestMethod=='GET'){
		
		try{
			$responses = [
		        'status' => 200,
		        'total' => 0,
		        'limit' => 40,
		        'data' => []
		    ];
			$rawData = json_encode($_GET);
			$rawDataJson=json_decode($rawData,true);
			$arraycheck=array('id_member');
			$responses_check = $validation->storefrontCheckNull($rawData,$arraycheck);
			
		    if(!$responses_check['error']){
				
				$param=array();
			    $id_user=$_GET['id_member'];
			    $where =" where N.id_member=?";
				array_push($param,$id_user);

				$curPage = (!empty($rawDataJson['p']))?$rawDataJson['p']:1;
		        $perPage = 40;
		        $startpoint = ($curPage * $perPage) - $perPage;


				$sqlNewsletterNum = "select count(*) as 'num' from #_newsletter where id_member=?";
				// $sqlNewsletter=" select id, id_member, id_product, fullname, phone, address date_created from #_newsletter $where limit $startpoint,
				$sqlNewsletter=" select N.id as id, N.id_member as id_member, N.id_product as id_product, N.fullname as fullname, N.phone as phone, N.address as address, N.date_created as date_created, N.is_readed as is_readed, P.slugvi as slugvi, P.namevi as namevi from #_newsletter as N left join #_product_construct as P on P.id = N.id_product $where limit $startpoint,
				
				$perPage";
				$newsletters=array();
				$newsletters = $d->rawQuery($sqlNewsletter, $param);
		        $count = $d->rawQueryOne($sqlNewsletterNum, $param);
		        $total = (!empty($count)) ? $count['num'] : 0;
		        $responses['total']=$total;

		        
		        foreach ($newsletters as $v) {
		        	
		        	$v['slugvi']=$configBaseSectors.$sector['type'].'/'.$v['slugvi'].'/'.$v['id'];
		        	
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

