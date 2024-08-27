
<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
}
$title=[  
   'pageTitle' => 'Trang Dashboard'
];
layout('header', $title);

//Kiểm tra người dùng đã đăng nhập chưa 
if(!isLogin()) redirect('?module=auth&action=login');

?>
<h1>DASHBOARD</h1>
<?php
layout('footer');
?>