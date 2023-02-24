<?php
if ($requestMethod == 'GET') {
    /* Responses */
    $responses = [
        'status' => 409,
        'errors' => [],
    ];

    $id_interface = 2;

    /* SQL paging */
    $idUser = (!empty($_GET['id_member'])) ? (int)$_GET['id_member'] : 0;
    $IDShop = (!empty($_GET['id_shop'])) ? (int)$_GET['id_shop'] : 0;
    $IDChat = (!empty($_GET['id_chat'])) ? (int)$_GET['id_chat'] : 0;
    $limitFrom = (!empty($_GET['limitFrom'])) ? (int)$_GET['limitFrom'] : 0;
    $limitGet = (!empty($_GET['limitGet'])) ? (int)$_GET['limitGet'] : 0;

    if (!empty($idUser) && !empty($IDShop) && !empty($IDChat)) {
        $tableShop = (!empty($sector['tables']['main'])) ? $sector['tables']['shop'] : '';
        $tableShopChat = (!empty($sector['tables']['main'])) ? $sector['tables']['shop-chat'] : '';

        $sampleData = $cache->get("select id_interface, logo from #_sample where id_interface = ?", array($id_interface), 'fetch', 7200);

        /* Get data detail */
        $chatDetail = $d->rawQueryOne("select B.avatar as avatar, B.fullname as fullname, B.email as email, S.name as shopName, S.slug_url as shopUrl, P.photo as logo from #_$tableShopChat as A inner join #_member as B inner join #_$tableShop as S left join #_photo as P on A.id_shop = P.id_shop and P.sector_prefix = ? and P.type = 'logo' where A.id_shop = ? and A.id_member = ? and A.id_parent = 0 and A.id = ? and A.id_member = B.id and A.id_shop = S.id limit 0,1", array($sector['prefix'], $IDShop, $idUser, $IDChat));

        /* Logo for shop */
        $chatDetail['logo'] = (!empty($sampleData) && empty($chatDetail['logo'])) ? $configBaseSectors . "thumbs/40x40x1/" . UPLOAD_PHOTO_L . $sampleData['logo'] : $configBaseSectors . "thumbs/40x40x1/" . UPLOAD_PHOTO_L . $chatDetail['logo'];

        /* Update status */
        $d->rawQuery("update #_$tableShopChat set status = replace(status, 'new-member', '') where id_shop = ? and id_member = ? and status = ?", array($IDShop, $idUser, 'new-member'));

        /* SQL messages */
        $sqlMessages = "select * from #_$tableShopChat where id_shop = ? and id_member = ? order by date_posted desc";

        /* SQL num */
        $sqlMessagesNum = "select count(*) as 'num' from #_$tableShopChat where id_shop = ? and id_member = ? order by date_posted desc";

        $messages = $d->rawQuery($sqlMessages . " limit " . $limitFrom . ',' . $limitGet, array($IDShop, $idUser));
        $count = $d->rawQueryOne($sqlMessagesNum, array($IDShop, $idUser));
        $total = (!empty($count)) ? $count['num'] : 0;

        /* Order data */

        $responses['status'] = 200;
        $responses['sector'] = $sector['id'];
        $responses['data'] = [];
        $responses['total'] = $total;

        if (!empty($messages)) {
	        $data = sortingChatMember($messages);
            foreach ($data as $v) {
                array_push($responses['data'], [
                    'config_base_shop' => $configBaseSectors. 'shop/' . $chatDetail['shopUrl'] . '/',
                    'detail' => $chatDetail,
                    'message' => $v,
                ]);
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

function sortingChatMember($messages)
{
    function compareChat($data1, $data2)
    {
        return $data1['date_posted'] <=> $data2['date_posted'];
    }

    usort($messages, "compareChat");

    return $messages;
}
