<!-- Đăng xuât --> 
<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }

if(isLogin()){
   $token = getSession('loginToken');
   delete('logintoken', "token = '$token'");
   removeSession('loginToken');
   redirect('?module=auth&action=login');
}