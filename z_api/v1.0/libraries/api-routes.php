<?php 
$apiRoutes = [
	'storefront' => [
	    'member' => [
	        'login' => '/storefront/member/login',
	        'register' => '/storefront/member/register',
	        'check' => '/storefront/member/check',
	        'forgot-password' => '/storefront/member/forgot-password',
	        'detail' => '/storefront/member/detail/{id}'
	    ],
	    'product' => [
	        'lists' => '/storefront/product/lists'
	    ]
	]
];