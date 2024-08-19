<!-- Các hằng của project --> 
<?php

const _MODULE = 'home';
const _ACTION = 'dashboard';
const _CODE = true; // Biến này nếu người dùng truy cập từ file index này thì nó là true, nếu mà truy cầp từ thanh địa chỉ trên web thì nó sẽ ko xuất hiện (đây là lúc người dùng truy cập trái phép -> cho dừng chương trình)
// Thiết lập host 
define('_WEB_HOST', 'http://'.$_SERVER['HTTP_HOST'].'/DuAnWeb_TENNIS/manager_users');
define('_WEB_HOST_TEMPLATE',_WEB_HOST.'/template');

//Thiết lập path 
define('_WEB_PATH', __DIR__);
define('_WEB_PATH_TEMPLATE', _WEB_PATH.'/template');

//Thong tin ket noi
const _HOST = 'localhost';
const _DB = 'web_tennis';
const _USER = 'root';
const _PASS = '';
