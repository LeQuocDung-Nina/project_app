<?php
if ($requestMethod == 'POST') {
    /* Responses */
    $responses = [
        'status' => 409,
        'errors' => []
    ];

    $id_interface = 2;

    $payloadPost = [
        'id_member' => 'id_member',
        'id_shop' => 'id_shop',
        'id_parent' => 'id_parent',
        'message' => 'message'
    ];

    foreach ($payloadPost as $fieldKey => $fieldName) {
        $data[$fieldName] = htmlspecialchars($_POST[$fieldKey]);
    }

    /* Validate data */
    $responses['errors'] = $validation->storefrontChatSend($data);
    $responses['sector'] = $sector['id'];
    /* Progress data */
    if (empty($responses['errors'])) {
        $tableShop = (!empty($sector['tables']['main'])) ? $sector['tables']['shop'] : '';
        $tableShopChat = (!empty($sector['tables']['main'])) ? $sector['tables']['shop-chat'] : '';

        $idUser = $data['id_member'];
        $IDShop = $data['id_shop'];
        $IDChat = $data['id_parent'];

        if (!empty($idUser) && !empty($IDShop) && !empty($IDChat)) {
	
            $chatDetail = $d->rawQueryOne("select A.*, B.avatar as avatar, B.fullname as fullname, B.address as address, B.phone as phone, B.email as email, S.name as shopName, P.photo as logo from #_$tableShopChat as A inner join #_member as B inner join #_$tableShop as S left join #_photo as P on A.id_shop = P.id_shop and P.sector_prefix = ? and P.type = 'logo' where A.id_shop = ? and A.id_member = ? and A.id_parent = 0 and A.id = ? and A.id_shop = S.id limit 0,1", array($sector['prefix'], $IDShop, $idUser, $IDChat));

            /* Check data detail */
            if (!empty($chatDetail)) {

                /* Check data main */
                if ($data) {
                    $data['poster'] = 'member';
                    $data['status'] = "new-shop";
                    $data['date_posted'] = time();
                }

                /* Save or insert data by sectors */
                if ($d->insert($tableShopChat, $data)) {
                    $responses['status'] = 200;
                } else {
                    $responses['status'] = 501;
                    $responses['errors'][] = 'Gửi tin nhắn bị lỗi. Vui lòng thử lại sau';
                }
            } else {
                $responses['status'] = 404;
                $responses['errors'][] = 'Dữ liệu không có thực';
            }
        } else {
            $responses['status'] = 400;
            $responses['errors'][] = 'Dữ liệu không hợp lệ';
        }
    }
    returnData($responses);
} else {
    header('HTTP/1.0 405 Method Not Allowed', true, 405);
}
