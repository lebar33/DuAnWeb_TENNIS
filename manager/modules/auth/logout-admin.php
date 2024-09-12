<!-- Đăng xuât --> 
<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }

if(isLoginAdmin()){
   $token = getSession('loginTokenAdmin');
   delete('logintoken', "tokenAdmin = '$token'");
   removeSession('loginTokenAdmin');
   redirect('?module=auth&action=login&admin=1');
}