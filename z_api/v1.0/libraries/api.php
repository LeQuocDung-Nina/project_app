<?php
/* Router init */
$router->setBasePath($config['database']['url']);

/* Thuộc tính tin đăng */
$router->map('GET', API_STOREFRONT . 'properties/tags', 'storefront', 'properties@tags');
$router->map('GET', API_STOREFRONT . 'properties/sizes', 'storefront', 'properties@sizes');
$router->map('GET', API_STOREFRONT . 'properties/colors', 'storefront', 'properties@colors');
$router->map('GET', API_STOREFRONT . 'properties/properties', 'storefront', 'properties@properties');

/* Danh nục */
$router->map('GET', API_STOREFRONT . 'category/cats', 'storefront', 'category@cats');
$router->map('GET', API_STOREFRONT . 'category/items', 'storefront', 'category@items');
$router->map('GET', API_STOREFRONT . 'category/subs', 'storefront', 'category@subs');

/* Tin đăng */
$router->map('GET', API_STOREFRONT . 'product/check', 'storefront', 'product@check');
$router->map('GET', API_STOREFRONT . 'product/list', 'storefront', 'product@fetch');
$router->map('GET', API_STOREFRONT . 'product/detail/[i:id]', 'storefront', 'product@detail');
$router->map('POST', API_STOREFRONT . 'product/update', 'storefront', 'product@update');
$router->map('POST', API_STOREFRONT . 'product/delete', 'storefront', 'product@delete');

$router->map('GET', API_STOREFRONT . 'product/checknew', 'storefront', 'product@checknew');
$router->map('GET', API_STOREFRONT . 'product/new', 'storefront', 'product@new');

/* Đơn hàng đã mua */
$router->map('GET', API_STOREFRONT . 'order/check', 'storefront', 'order@check');
$router->map('GET', API_STOREFRONT . 'order/list', 'storefront', 'order@list');
$router->map('GET', API_STOREFRONT . 'order/detail/[a:code]', 'storefront', 'order@detail');
$router->map('POST', API_STOREFRONT . 'order/update', 'storefront', 'order@update');

/* Shop */
$router->map('GET', API_STOREFRONT . 'shop/check', 'storefront', 'shop@check');
$router->map('GET', API_STOREFRONT . 'shop/list', 'storefront', 'shop@list');
$router->map('GET', API_STOREFRONT . 'shop/detail/[i:id]', 'storefront', 'shop@detail');
$router->map('POST', API_STOREFRONT . 'shop/update', 'storefront', 'shop@update');
$router->map('POST', API_STOREFRONT . 'shop/delete', 'storefront', 'shop@delete');

/* Đơn đặt hàng của bạn */
$router->map('GET', API_STOREFRONT . 'salerorder/status', 'storefront', 'salerorder@status');
$router->map('GET', API_STOREFRONT . 'salerorder/check', 'storefront', 'salerorder@check');
$router->map('GET', API_STOREFRONT . 'salerorder/list', 'storefront', 'salerorder@list');
$router->map('GET', API_STOREFRONT . 'salerorder/detail', 'storefront', 'salerorder@detail');
$router->map('POST', API_STOREFRONT . 'salerorder/update', 'storefront', 'salerorder@update');
$router->map('POST', API_STOREFRONT . 'salerorder/delete', 'storefront', 'salerorder@delete');

/* Store */
$router->map('GET', API_STOREFRONT . 'store/detail/[i:id]', 'storefront', 'store@detail');

/* Chat */
$router->map('GET', API_STOREFRONT . 'chat/check', 'storefront', 'chat@check');
$router->map('GET', API_STOREFRONT . 'chat/lists', 'storefront', 'chat@lists');
$router->map('GET', API_STOREFRONT . 'chat/detail', 'storefront', 'chat@detail');
$router->map('POST', API_STOREFRONT . 'chat/send', 'storefront', 'chat@send');


$router->map('GET', API_STOREFRONT . 'favourite/check', 'storefront', 'favourite@check');
$router->map('GET', API_STOREFRONT . 'favourite/lists', 'storefront', 'favourite@lists');
$router->map('POST', API_STOREFRONT . 'favourite/delete', 'storefront', 'favourite@delete');

$router->map('GET', API_STOREFRONT . 'comment/check', 'storefront', 'comment@check');
$router->map('GET', API_STOREFRONT . 'comment/lists', 'storefront', 'comment@lists');
$router->map('GET', API_STOREFRONT . 'comment/product', 'storefront', 'comment@product');
$router->map('GET', API_STOREFRONT . 'comment/detail', 'storefront', 'comment@detail');
$router->map('GET', API_STOREFRONT . 'comment/more', 'storefront', 'comment@more');
$router->map('POST', API_STOREFRONT . 'comment/add', 'storefront', 'comment@add');

$router->map('GET', API_STOREFRONT . 'buy/check', 'storefront', 'buy@check');
$router->map('GET', API_STOREFRONT . 'buy/lists', 'storefront', 'buy@lists');
$router->map('POST', API_STOREFRONT . 'buy/update', 'storefront', 'buy@update');
$router->map('POST', API_STOREFRONT . 'buy/delete', 'storefront', 'buy@delete');



/* Router match */
$match = $router->match();
function returnData($data)
{
    global $sector;
    $data['IDsectors'] = $sector['id'];
    ob_end_clean();
    header("Connection: close");
    header("Content-Type: application/json");
    ignore_user_abort(true);
    ob_start();
    echo json_encode($data, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $size = ob_get_length();
    header("Content-Length: $size");
    header("HTTP/1.1 200 OK");
    ob_end_flush();
    flush();
    sleep(0);
}

if ($sectors = $Idsectors) {
    $sectorType = (!empty($defineSectors[$Idsectors]['type'])) ? $defineSectors[$Idsectors]['type'] : '';
    $tableProductMain = (!empty($sector['tables']['main'])) ? $sector['tables']['main'] : '';
    $tableProductContent = (!empty($sector['tables']['content'])) ? $sector['tables']['content'] : '';
    $tableProductInfo = (!empty($sector['tables']['info'])) ? $sector['tables']['info'] : '';
    $tableProductPhoto = (!empty($sector['tables']['photo'])) ? $sector['tables']['photo'] : '';
    $tableProductTag = (!empty($sector['tables']['tag'])) ? $sector['tables']['tag'] : '';
    $tableProductSale = (!empty($sector['tables']['sale'])) ? $sector['tables']['sale'] : '';
    $tableProductVideo = (!empty($sector['tables']['video'])) ? $sector['tables']['video'] : '';
    $tableProductContact = (!empty($sector['tables']['contact'])) ? $sector['tables']['contact'] : '';
    $tableProductComment = (!empty($sector['tables']['comment'])) ? $sector['tables']['comment'] : '';
    $tableProductCommentPhoto = (!empty($sector['tables']['comment-photo'])) ? $sector['tables']['comment-photo'] : '';
    $tableProductCommentVideo = (!empty($sector['tables']['comment-video'])) ? $sector['tables']['comment-video'] : '';
    $tableProductVariation = (!empty($sector['tables']['variation'])) ? $sector['tables']['variation'] : '';
    $tableProductSeo = (!empty($sector['tables']['seo'])) ? $sector['tables']['seo'] : '';
    $tableProductReport = (!empty($sector['tables']['report-product'])) ? $sector['tables']['report-product'] : '';
    $tableProductReportInfo = (!empty($sector['tables']['report-product-info'])) ? $sector['tables']['report-product-info'] : '';
    $tableShop = (!empty($sector['tables']['shop'])) ? $sector['tables']['shop'] : '';
    $tableShopSubscribe = (!empty($sector['tables']['shop-subscribe'])) ? $sector['tables']['shop-subscribe'] : '';
    $tableShopRating = (!empty($sector['tables']['shop-rating'])) ? $sector['tables']['shop-rating'] : '';
};



/* Router check */
if (is_array($match)) {
    $routeTarget = $match['target'];
    $routeName = explode('@', $match['name']);
    $apiType = $routeName[0];
    $apiName = $routeName[1];
    $requestMethod = $_SERVER['REQUEST_METHOD'];


    /* Handle api */
    if (file_exists($routeTarget . '/' . $apiType . '/' . $apiName . '.php')) {
        $lang = 'vi';
        include_once $routeTarget . '/' . $apiType . '/' . $apiName . '.php';
        exit();
    }
} else {
    header('HTTP/1.0 404 Not Found', true, 404);
    exit;
}
