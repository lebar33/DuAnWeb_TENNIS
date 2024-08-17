
<h1>DASHBOARD</h1>

<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }
 require_once _WEB_PATH_TEMPLATE."/layout/header.php";

 ?>
 <?php
 require_once _WEB_PATH_TEMPLATE."/layout/footer.php";
 ?>