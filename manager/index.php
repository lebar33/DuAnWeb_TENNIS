<?php
session_start(); // Khoi chay session
require_once "config.php";
require_once './includes/connect.php';

//Thư viện phpmailer
require_once ('./includes/phpmailer/Exception.php');
require_once ('./includes/phpmailer/PHPMailer.php');
require_once ('./includes/phpmailer/SMTP.php');

require_once ('./includes/database.php');
require_once ('./includes/function.php');
require_once ('./includes/session.php');

// // setFlashData('avc', 'Cai dat thanh cong');
// echo getFlashData('avc');

// $subject = 'Chu de';
// $content = 'Noi dung';
// sendMail('22H1120088@ut.edu.vn', $subject, $content);


//module là cái mình điền sau dấu ? như là file modules trong phần manager_users & action có nghĩa là chạy cái file nào trong cái module đó
$module = _MODULE; // Mặc định truy cập vào home 
$action = _ACTION; // Nếu trên $_GET ko có action thì nó sẽ mặc định vào dashboard

if(!empty($_GET['module'])){
    if(is_string($_GET['module'])){
        $module = trim($_GET['module']);
    }
}

if(!empty($_GET['action'])){
    if(is_string($_GET['action'])){
        $action = trim($_GET['action']);
    }
}

$path = 'modules/'.$module.'/'.$action.'.php'; // Đường dẫn tới file muốn chạy
if(file_exists($path)){
    require_once ($path);
}
else{
    require_once "modules/error/404.php";
}