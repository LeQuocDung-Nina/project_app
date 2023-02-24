<?php
if ($requestMethod == 'GET') {
    /* Responses */
    $responses = [
        'status' => 409,
        'errors' => []
    ];
    $id_interface = 2;

    /* SQL paging */
    $idUser = (!empty($_GET['id_member'])) ? (int)$_GET['id_member'] : 0;
    $curPage = (!empty($_GET['curpage'])) ? (int)$_GET['curpage'] : 0;
    $perPage = (!empty($_GET['perpage'])) ? (int)$_GET['perpage'] : 0;
    $startpoint = ($curPage * $perPage) - $perPage;

    if (!empty($idUser)) {
        $tableProductMain = (!empty($sector['tables']['main'])) ? $sector['tables']['main'] : '';
        $tableShop = (!empty($sector['tables']['main'])) ? $sector['tables']['shop'] : '';
        $tableShopChat = (!empty($sector['tables']['main'])) ? $sector['tables']['shop-chat'] : '';


        $sampleData = $cache->get("select id_interface, logo from #_sample where id_interface = ?", array($id_interface), 'fetch', 7200);

        /* Shops */
        $whereShop = "A.status = ? and A.status_user = ?";
        $paramsShop = array($idUser, $sector['type'], 'xetduyet', 'hienthi');

        /* SQL shop */
        $sqlShop = "select A.id as id, A.id_interface as interface, A.date_created as date_created, A.name as name, A.photo as photo, A.slug_url as slug_url, CH.id as id_chat, B.name as nameCity, C.name as nameDistrict, D.name as nameWard, P.photo as logo from #_$tableShop as A inner join #_$tableShopChat as CH on CH.id = (select id from #_$tableShopChat as LJ_CH where A.id = LJ_CH.id_shop and LJ_CH.id_parent = 0 and LJ_CH.id_member = ? limit 0,1) inner join #_city as B inner join #_district as C inner join #_wards as D left join #_photo as P on A.id = P.id_shop and P.sector_prefix = ? and P.type = 'logo' where $whereShop and A.id_city = B.id and A.id_district = C.id and A.id_wards = D.id order by A.numb,A.id desc limit $startpoint,$perPage";

        /* SQL num */
        $sqlShopNum = "select count(*) as 'num' from #_$tableShop as A inner join #_$tableShopChat as CH on CH.id = (select id from #_$tableShopChat as LJ_CH where A.id = LJ_CH.id_shop and LJ_CH.id_parent = 0 and LJ_CH.id_member = ? limit 0,1) inner join #_city as B inner join #_district as C inner join #_wards as D left join #_photo as P on A.id = P.id_shop and P.sector_prefix = ? and P.type = 'logo' where $whereShop and A.id_city = B.id and A.id_district = C.id and A.id_wards = D.id order by A.numb,A.id desc";

        /* Get data */
        if (!empty($sqlShop)) {
            $data = $cache->get($sqlShop, $paramsShop, 'result', 7200);
            $count = $cache->get($sqlShopNum, $paramsShop, 'fetch', 7200);
            $total = (!empty($count)) ? $count['num'] : 0;

	        $responses['status'] = 200;
            $responses['sector'] = $sector['id'];
	        $responses['data'] = [];
	        $responses['total'] = $total;
	        if (!empty($data)) {
	            foreach ($data as $v) {
	                $totalChat = totalChatMember($sector, $v['id'], $idUser);
	                $newChat = newChatMember($sector, $v['id'], $idUser);
	                array_push($responses['data'], [
	                    'id' => $v['id'],
	                    'name' => $v['name'],
	                    'photo' => $configBaseSectors . "thumbs/380x260x1/" . UPLOAD_SHOP_L . $v['photo'],
	                    'href' => 'account/chi-tiet-tro-chuyen?sector=' . $sector['id'] . '&id_shop=' . $v['id'] . '&id_chat=' . $v['id_chat'],
	                    'address' => $func->joinPlace($v),
	                    'logo' => (!empty($sampleData) && empty($v['logo'])) ? $configBaseSectors . "thumbs/65x65x2/" . UPLOAD_PHOTO_L . $sampleData['logo'] : $configBaseSectors . "thumbs/65x65x2/" . UPLOAD_PHOTO_L . $v['logo'],
	                    'date_created' => $v['date_created'],
	                    'totalChat' => $totalChat,
	                    'newChat' => $newChat
	                ]);
	            }
	        }
        }
        
    } else {
        $responses['status'] = 400;
        $responses['errors'][] = 'Dữ liệu không hợp lệ';
    }
    returnData($responses);
} else {
    header('HTTP/1.0 405 Method Not Allowed', true, 405);
}

function totalChatMember($sector = array(), $idShop = 0, $id_member = 0)
{
    global $d;

    /* Tables */
    $tableShopChat = (!empty($sector['tables']['shop-chat'])) ? $sector['tables']['shop-chat'] : '';

    $row = $d->rawQueryOne("select count(*) as num from #_$tableShopChat where id_shop = $idShop and id_member = ?", array($id_member));
    return (!empty($row)) ? $row['num'] : 0;
}

/* New */
function newChatMember($sector = array(), $idShop = 0, $id_member = 0)
{
    global $d;

    /* Tables */
    $tableShopChat = (!empty($sector['tables']['shop-chat'])) ? $sector['tables']['shop-chat'] : '';

    $row = $d->rawQueryOne("select count(*) as num from #_$tableShopChat where id_shop = $idShop and id_member = ? and find_in_set('new-member',status)", array($id_member));
    return (!empty($row)) ? $row['num'] : 0;
}
