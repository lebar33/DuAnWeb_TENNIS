<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
}
$title=[  
   'pageTitle' => 'Trang chủ'
];
if(!isLogin()) redirect('?module=auth&action=login');
layout('header', $title);


?>
   <?php
   include ("main-index.php");
   layout('footer');
   ?>
<!-- Popular Product --> 
   
</body>
</html>
