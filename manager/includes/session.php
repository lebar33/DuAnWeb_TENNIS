<!-- Hàm liên quan tới session hay cookie --> 
<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}


//Hàm gán session
function setSession($key, $value){
   return $_SESSION[$key] = $value; 
}

// Hàm đọc session 
function getSession($key=''){
   if(empty($key)){
      return $_SESSION;
   }
   else {
      if(isset($_SESSION[$key])){
         return $_SESSION[$key];
      }
   }
}

// Hàm xóa session 
function removeSession($key=''){
   if(empty($key)){
      session_destroy();
      return true;
   }
   else {
      if(isset($_SESSION[$key])){
         unset($_SESSION[$key]);
         return true; 
      }
   }
}

//hàm get flash data => lặp đi lặp lại việc gán và xóa session
function setFlashData($key, $value){
   $key = 'flash_'.$key;
   return setSession($key, $value);
}

//Hàm đọc flashData
function getFlashData($key){
   $key = 'flash_'.$key;
   $data = getSession($key);
   removeSession($key);
   return $data;
}