<!-- các hàm chung của project --> 
 <?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }

 function layout($layoutName="header", $data=[]){
   if(file_exists(_WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php')){
      require_once (_WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php');
   }
 }