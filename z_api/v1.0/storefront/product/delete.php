<?php
if ($requestMethod == 'POST') {
    try {
        $responses = [
            'status' => 200,
        ];
        $arraycheck = array('id_member', 'id');
        foreach ($_POST as $k => $v) {
            $rawDataJson[$k] = $v;
        }
        $responses_check = $validation->storefrontCheckNull(json_encode($rawDataJson), $arraycheck);
        if (!$responses_check['error']) {
            $rowCheck = $d->rawQueryOne("select id,id_member from #_$tableProductMain where id=? and id_member=?", array($rawDataJson['id'], $rawDataJson['id_member']));
            $tableProductMain = (!empty($sector['tables']['main'])) ? $sector['tables']['main'] : '';
            $row = $d->rawQueryOne("select id, photo from #_" . $tableProductMain . " where id = ? and id_member = ? limit 0,1", array($rowCheck['id'], $rowCheck['id_member']));
            if (!empty($row['id'])) {
                $func->deleteProduct($row, $sector, UPLOAD_PRODUCT);
                $cache->delete();
                $d->runMaintain();
                $responses['data'] = [
                    'messenger' => 'The data has been deleted successfully'
                ];
            } else {
                $responses = [
                    'status' => 409,
                    'data' => [
                        'error' => true,
                        'messenger' => 'Data does not exist'
                    ]
                ];
                returnData($responses);
            }
        } else {
            $responses = [
                'status' => 409,
                'data' => [
                    'error' => true,
                    'messenger' => 'Invalid data'
                ]
            ];
            returnData($responses);
        }
    } catch (Exception $e) {
        $responses = [
            'status' => 409,
            'data' => $e
        ];
        returnData($responses);
    }
} else {
    header('HTTP/1.0 405 Method Not Allowed', true, 405);
}
