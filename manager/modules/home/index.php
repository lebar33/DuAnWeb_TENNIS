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
<h1>DASHBOARD</h1>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> 3&H Sporting Goods </title>
</head>
<body>
    <!-- Slider -->
    <section class="slider">  
        <div class="slider-items">
            <div class="slider-item">
                <img src="template/image/nen.png" alt="">
            </div>
            <div class="slider-item">
                <img src="template/image/nen2.png" alt="">
            </div>
            <div class="slider-item">
                <img src="template/image/nen3.png" alt="">
            </div>
        </div>
        <div class="slider-arrow">
            <i class="ri-arrow-right-s-line"></i>
            <i class="ri-arrow-left-s-line"></i>
        </div>
    </section>
    <?php
    include ("main-index.php");
    layout('footer');
    ?>
   <!-- Popular Product --> 



    <script src="template/js/script.js"></script>
</body>
</html>
