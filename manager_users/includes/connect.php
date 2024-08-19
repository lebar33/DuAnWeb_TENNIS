<!-- kết nối với database --> 
<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }


 try{
   if(class_exists('PDO')){
       $dsn ='mysql:dbname='._DB.';host='._HOST;
       $option =[
           PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',//Set utf 8
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Tạo thông báo ngoại lệ khi gặp lỗi
       ];
       $conn = new PDO($dsn, _USER, _PASS, $option);
       // if($conn){
       //     echo '<div style="color:red; padding: 5px 15px; border: 1px solid blue;"> ';
       //     echo 'Kết nối thành công <br>';
       //     echo "</div>";
       // }
   }
}
catch(Exception $ex){
   echo '<div style="color:red; padding: 5px 15px; border: 1px solid red;"> ';
   echo $ex->getMessage().'<br>';
   echo "</div>";
   die(); // Ket thuc chuong trinh
}