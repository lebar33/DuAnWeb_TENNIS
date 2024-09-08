<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
}
$title=[  
   'pageTitle' => 'Trang chủ'
];
layout('header', $title);

//Kiểm tra người dùng đã đăng nhập chưa 
if(!isLogin()) redirect('?module=auth&action=login');

?>

    <?php
    include ("main-index.php");
    layout('footer');
    ?>
   <!-- Popular Product --> 
   
</body>
</html>
