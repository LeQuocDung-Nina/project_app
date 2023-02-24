<?php
if (!defined('LIBRARIES')) die("Error");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$config = array(
    'arrayDomainSSL' => array('api.chonhanh.vn'),
    'database' => array(
        'server-name' => $_SERVER["SERVER_NAME"],
        'url' => '/',
        'type' => 'mysql',
        'host' => 'localhost',
        'username' => 'chonhanhvn',
        'password' => 'HaVNVst0qrwn',
        'dbname' => '',
        'port' => 3306,
        'prefix' => 'table_',
        'charset' => 'utf8mb4'
    )
);

/* Error reporting */
error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);

/* Cấu hình base */
$http = 'http://';
$configUrl = $config['database']['server-name'] . $config['database']['url'];
$configBase = $http . $configUrl;
$configBaseShop = $http . $configUrl . 'shop/';

define('BASE_URL_API', $http . 'chonhanh.vn');

/* Token */
define('TOKEN', md5(NN_MSHD . $config['database']['url']));

/* Path On Host */
define('ROOT', str_replace(basename(__DIR__), '', __DIR__));
// define('ASSET', $http . 'cdn.chonhanh.vn/');
define('ASSET', $configBase . '');
define('ADMIN', 'admin');
include LIBRARIES . "upload.php";
/* Cấu hình login */
$loginAdmin = $config['login']['admin'];
$loginMember = $config['login']['member'];
/* ID shop for Main Page */
$idShop = 0;

$httpSectors = 'http://';
$defineSectors = array(
    21 => array(
        'database' => 'chonhanhvn_main',
        'id' => 21,
        'type' => 'quang-cao',
        'name' => 'Quảng cáo',
        'prefix' => 'advertise',
        'sub' => 'advertise',
        'url' => $httpSectors . 'chonhanh.vn/',
        'attributes' => array('price'),
        'tables' => array(
            'main' => 'product_advertise',
            'photo' => 'product_advertise_photo',
            'tag' => 'product_advertise_tag',
            'sale' => 'product_advertise_sale',
            'content' => 'product_advertise_content',
            'variation' => 'product_advertise_variation',
            'video' => 'product_advertise_video',
            'seo' => 'product_advertise_seo',
            'contact' => 'product_advertise_contact',
            'comment' => 'product_advertise_comment',
            'comment-photo' => 'product_advertise_comment_photo',
            'comment-video' => 'product_advertise_comment_video',
            'report-product' => 'report_product_advertise',
            'report-product-info' => 'report_product_advertise_info',
            'shop' => 'shop_advertise',
            'shop-counter' => 'shop_advertise_counter',
            'shop-user-online' => 'shop_advertise_user_online',
            'shop-rating' => 'shop_advertise_rating',
            'shop-subscribe' => 'shop_advertise_subscribe',
            'shop-chat' => 'shop_advertise_chat',
            'shop-chat-photo' => 'shop_advertise_chat_photo',
            'shop-limit' => 'shop_advertise_limit',
            'shop-log' => 'shop_advertise_log',
            'report-shop' => 'report_shop_advertise',
            'report-shop-info' => 'report_shop_advertise_info'
        )
    ),
    20 => array(
        'database' => 'chonhanhvn_fashion',
        'id' => 20,
        'type' => 'thoi-trang',
        'name' => 'Thời trang',
        'prefix' => 'fashion',
        'sub' => 'thoitrang',
        'url' => $httpSectors . 'thoitrang.chonhanh.vn/',
        'attributes' => array('price'), //, 'coordinates'
        'tables' => array(
            'main' => 'product_fashion',
            'photo' => 'product_fashion_photo',
            'tag' => 'product_fashion_tag',
            'sale' => 'product_fashion_sale',
            'content' => 'product_fashion_content',
            'variation' => 'product_fashion_variation',
            'video' => 'product_fashion_video',
            'seo' => 'product_fashion_seo',
            'contact' => 'product_fashion_contact',
            'comment' => 'product_fashion_comment',
            'comment-photo' => 'product_fashion_comment_photo',
            'comment-video' => 'product_fashion_comment_video',
            'report-product' => 'report_product_fashion',
            'report-product-info' => 'report_product_fashion_info',
            'shop' => 'shop_fashion',
            'shop-counter' => 'shop_fashion_counter',
            'shop-user-online' => 'shop_fashion_user_online',
            'shop-rating' => 'shop_fashion_rating',
            'shop-subscribe' => 'shop_fashion_subscribe',
            'shop-chat' => 'shop_fashion_chat',
            'shop-chat-photo' => 'shop_fashion_chat_photo',
            'shop-limit' => 'shop_fashion_limit',
            'shop-log' => 'shop_fashion_log',
            'report-shop' => 'report_shop_fashion',
            'report-shop-info' => 'report_shop_fashion_info'
        )
    ),
    9 => array(
        'id' => 9,
        'type' => 'dien-tu',
        'database' => 'chonhanhvn_dientu',
        'url' => $httpSectors . 'dientu.chonhanh.vn/',
        'name' => 'Điện tử',
        'prefix' => 'electron',
        'sub' => 'dientu',
        'attributes' => array('price'), //, 'coordinates'
        'tables' => array(
            'main' => 'product_electron',
            'photo' => 'product_electron_photo',
            'tag' => 'product_electron_tag',
            'sale' => 'product_electron_sale',
            'content' => 'product_electron_content',
            'variation' => 'product_electron_variation',
            'video' => 'product_electron_video',
            'seo' => 'product_electron_seo',
            'contact' => 'product_electron_contact',
            'comment' => 'product_electron_comment',
            'comment-photo' => 'product_electron_comment_photo',
            'comment-video' => 'product_electron_comment_video',
            'report-product' => 'report_product_electron',
            'report-product-info' => 'report_product_electron_info',
            'shop' => 'shop_electron',
            'shop-counter' => 'shop_electron_counter',
            'shop-user-online' => 'shop_electron_user_online',
            'shop-rating' => 'shop_electron_rating',
            'shop-subscribe' => 'shop_electron_subscribe',
            'shop-chat' => 'shop_electron_chat',
            'shop-chat-photo' => 'shop_electron_chat_photo',
            'shop-limit' => 'shop_electron_limit',
            'shop-log' => 'shop_electron_log',
            'report-shop' => 'report_shop_electron',
            'report-shop-info' => 'report_shop_electron_info'
        )
    ),
    7 => array(
        'id' => 7,
        'type' => 'xe-co',
        'name' => 'Xe cộ',
        'sub' => 'xeco',
        'url' => $httpSectors . 'xeco.chonhanh.vn/',
        'database' => 'chonhanhvn_vehicle',
        'prefix' => 'vehicle',
        'attributes' => array('price', 'coordinates', 'properties'),
        'tables' => array(
            'main' => 'product_vehicle',
            'photo' => 'product_vehicle_photo',
            'tag' => 'product_vehicle_tag',
            'sale' => 'product_vehicle_sale',
            'content' => 'product_vehicle_content',
            'variation' => 'product_vehicle_variation',
            'video' => 'product_vehicle_video',
            'seo' => 'product_vehicle_seo',
            'contact' => 'product_vehicle_contact',
            'comment' => 'product_vehicle_comment',
            'comment-photo' => 'product_vehicle_comment_photo',
            'comment-video' => 'product_vehicle_comment_video',
            'report-product' => 'report_product_vehicle',
            'report-product-info' => 'report_product_vehicle_info',
            'shop' => 'shop_vehicle',
            'shop-counter' => 'shop_vehicle_counter',
            'shop-user-online' => 'shop_vehicle_user_online',
            'shop-rating' => 'shop_vehicle_rating',
            'shop-subscribe' => 'shop_vehicle_subscribe',
            'shop-chat' => 'shop_vehicle_chat',
            'shop-chat-photo' => 'shop_vehicle_chat_photo',
            'shop-limit' => 'shop_vehicle_limit',
            'shop-log' => 'shop_vehicle_log',
            'report-shop' => 'report_shop_vehicle',
            'report-shop-info' => 'report_shop_vehicle_info'
        )
    ),
    4 => array(
        'id' => 4,
        'type' => 'xay-dung',
        'name' => 'Xây dựng',
        'sub' => 'xaydung',
        'url' => $httpSectors . 'xaydung.chonhanh.vn/',
        'database' => 'chonhanhvn_construct',
        'prefix' => 'construct',
        'attributes' => array('price', 'coordinates', 'properties'),
        'tables' => array(
            'main' => 'product_construct',
            'photo' => 'product_construct_photo',
            'tag' => 'product_construct_tag',
            'sale' => 'product_construct_sale',
            'content' => 'product_construct_content',
            'variation' => 'product_construct_variation',
            'video' => 'product_construct_video',
            'seo' => 'product_construct_seo',
            'contact' => 'product_construct_contact',
            'comment' => 'product_construct_comment',
            'comment-photo' => 'product_construct_comment_photo',
            'comment-video' => 'product_construct_comment_video',
            'report-product' => 'report_product_construct',
            'report-product-info' => 'report_product_construct_info',
            'shop' => 'shop_construct',
            'shop-counter' => 'shop_construct_counter',
            'shop-user-online' => 'shop_construct_user_online',
            'shop-rating' => 'shop_construct_rating',
            'shop-subscribe' => 'shop_construct_subscribe',
            'shop-chat' => 'shop_construct_chat',
            'shop-chat-photo' => 'shop_construct_chat_photo',
            'shop-limit' => 'shop_construct_limit',
            'shop-log' => 'shop_construct_log',
            'report-shop' => 'report_shop_construct',
            'report-shop-info' => 'report_shop_construct_info'
        )
    ),
    3 => array(
        'id' => 3,
        'type' => 'bat-dong-san',
        'name' => 'Bất động sản',
        'sub' => 'batdongsan',
        'url' => $httpSectors . 'batdongsan.chonhanh.vn/',
        'prefix' => 'realestate',
        'database' => 'chonhanhvn_realestate',
        'attributes' => array('price', 'coordinates', 'properties'),
        'tables' => array(
            'main' => 'product_realestate',
            'photo' => 'product_realestate_photo',
            'tag' => 'product_realestate_tag',
            'sale' => 'product_realestate_sale',
            'content' => 'product_realestate_content',
            'variation' => 'product_realestate_variation',
            'video' => 'product_realestate_video',
            'seo' => 'product_realestate_seo',
            'contact' => 'product_realestate_contact',
            'comment' => 'product_realestate_comment',
            'comment-photo' => 'product_realestate_comment_photo',
            'comment-video' => 'product_realestate_comment_video',
            'report-product' => 'report_product_realestate',
            'report-product-info' => 'report_product_realestate_info',
            'shop' => 'shop_realestate',
            'shop-counter' => 'shop_realestate_counter',
            'shop-user-online' => 'shop_realestate_user_online',
            'shop-rating' => 'shop_realestate_rating',
            'shop-subscribe' => 'shop_realestate_subscribe',
            'shop-chat' => 'shop_realestate_chat',
            'shop-chat-photo' => 'shop_realestate_chat_photo',
            'shop-limit' => 'shop_realestate_limit',
            'shop-log' => 'shop_realestate_log',
            'report-shop' => 'report_shop_realestate',
            'report-shop-info' => 'report_shop_realestate_info'
        )
    ),
    5 => array(
        'id' => 5,
        'type' => 'ung-vien',
        'name' => 'Ứng viên',
        'prefix' => 'candidate',
        'sub' => 'vieclam',
        'url' => $httpSectors . 'vieclam.chonhanh.vn/',
        'database' => 'chonhanhvn_job',
        'attributes' => array('images', 'price', 'info-candidate', 'salary', 'form-level', 'location', 'experience'),
        'tables' => array(
            'main' => 'product_candidate',
            'info' => 'product_candidate_info',
            'photo' => 'product_candidate_photo',
            'tag' => 'product_candidate_tag',
            'content' => 'product_candidate_content',
            'variation' => 'product_candidate_variation',
            'video' => 'product_candidate_video',
            'seo' => 'product_candidate_seo',
            'contact' => 'product_candidate_contact',
            'comment' => 'product_candidate_comment',
            'comment-photo' => 'product_candidate_comment_photo',
            'comment-video' => 'product_candidate_comment_video',
            'report-product' => 'report_product_candidate',
            'report-product-info' => 'report_product_candidate_info'
        )
    ),
    6 => array(
        'id' => 6,
        'type' => 'nha-tuyen-dung',
        'name' => 'Nhà tuyển dụng',
        'prefix' => 'employer',
        'sub' => 'vieclam',
        'url' => $httpSectors . 'vieclam.chonhanh.vn/',
        'database' => 'chonhanhvn_job',
        'attributes' => array('images', 'video', 'price', 'info-employer', 'form-level', 'location', 'experience'),
        'tables' => array(
            'main' => 'product_employer',
            'photo' => 'product_employer_photo',
            'tag' => 'product_employer_tag',
            'content' => 'product_employer_content',
            'variation' => 'product_employer_variation',
            'video' => 'product_employer_video',
            'seo' => 'product_employer_seo',
            'contact' => 'product_employer_contact',
            'comment' => 'product_employer_comment',
            'comment-photo' => 'product_employer_comment_photo',
            'comment-video' => 'product_employer_comment_video',
            'report-product' => 'report_product_employer',
            'report-product-info' => 'report_product_employer_info',
            'shop' => 'shop_employer',
            'shop-counter' => 'shop_employer_counter',
            'shop-user-online' => 'shop_employer_user_online',
            'shop-rating' => 'shop_employer_rating',
            'shop-subscribe' => 'shop_employer_subscribe',
            'shop-chat' => 'shop_employer_chat',
            'shop-chat-photo' => 'shop_employer_chat_photo',
            'shop-limit' => 'shop_employer_limit',
            'shop-log' => 'shop_employer_log',
            'report-shop' => 'report_shop_employer',
            'report-shop-info' => 'report_shop_employer_info'
        )
    )
);
