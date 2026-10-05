<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$route['/'] = 'ProductApi::health';
$route['api/login'] = 'ProductApi::login';
$route['api/logout'] = 'ProductApi::logout';
$route['api/products'] = 'ProductApi::products';
$route['api/products/(:num)'] = 'ProductApi::mutate';