<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }
 //HEADER - CSS
 ?>

 <!DOCTYPE html>
 <html lang="vi">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo !empty($data['pageTitle'])?$data['pageTitle'] : 'Quản lý người dùng'?> </title>
   <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/style.css?ver=<?php echo rand();?>">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"> -->
   <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"  rel="stylesheet"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
   <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/style1.css?ver=<?php echo rand();?>">
   <script>
    document.getElementById('userIcon').addEventListener('click', function() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
            dropdownMenu.style.display = "block";
        } else {
            dropdownMenu.style.display = "none";
        }
    });
   </script>
 </head>
 <body>
    <!-- header -->
    <header id="header" class="p-3 mb-3 border-bottom" >
        <div class="container">
            <div class="row-flex">
                <div class="header-bar-icon">
                    <i class="ri-menu-line"></i>
                </div>
                <div class="header-logo">
                    <img src="asset/images/logo.png" alt="">
                </div>
                <div class="header-logo-mobile">
                    <img src="asset/images/logo.png" alt="">
                </div>

                <div class="header-nav ">
                    <nav>
                        <ul>
                            <li><a href="">RACKETS</a></li>
                            <li><a href="">WOMEN</a></li>
                            <li><a href="">MEN</a></li>
                            <li><a href="">SHOES</a></li>
                            <li><a href="">SALE</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header-search">
                    <input type="text" placeholder="Tìm kiếm" >
                    <i class="ri-search-2-line"></i>
                </div>
                <div class="header-cart">
                    <i class="ri-shopping-cart-2-line" number="O"></i>
                </div> 
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                        <li><a class="dropdown-item" href="#">Thông tin người dùng</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="?module=auth&action=logout">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

 </body>
 </html>
