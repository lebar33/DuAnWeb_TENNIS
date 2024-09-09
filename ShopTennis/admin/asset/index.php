<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"  rel="stylesheet"/>
    <link rel="stylesheet" href="css/style.css?ver=<?php echo rand(); ?>">
    <title>3H-Admin</title>
</head>
<body>
    <section class="Admin">
        <div class="row-grid">
            <div class="Admin-Sidebar">
                <div class="Admin-Sidebar-Top">
                    <img src="image/logo.png" alt="">
                </div>
                <div class="Admin-Sidebar-Content">
                    <ul>
                        <li><a href=""><i class="ri-dashboard-line"></i>Dashboard</a>
                            
                        </li>
                        <li><a href=""><i class="ri-file-list-line"></i>Đơn Hàng</a>
                            <ul class="Sub-Menu">
                                <div class="Sub-Menu-Items">
                                    <li><a href="">Danh Sách</a></li>
                                </div>
                                
                            </ul>
                        </li>
                        <li><a href=""><i class="ri-product-hunt-line"></i>Sản Phẩm</a>
                            <ul class="Sub-Menu">
                                <div class="Sub-Menu-Items">
                                    <li><a href="">Danh Sách</a></li>
                                    <li><a href="">Thêm</a></li>
                                </div>
                                
                            </ul>
                        </li>
                        <li><a href=""><i class="ri-user-3-fill"></i>Người dùng</a>
                            <ul class="Sub-Menu">
                                <div class="Sub-Menu-Items">
                                    <li><a href="">Danh Sách</a></li>
                                </div>
                                
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="Admin-Content">
                <div class="Admin-Content-Top">
                    <div class="Admin-Content-Top-Left">
                        <ul class="Flex-Box">
                            <li><i class="ri-search-2-line"></i></li>
                            <li><i class="ri-drag-move-line"></i></li>
                        </ul>
                    </div>
                    <div class="Admin-Content-Top-Right">
                        <ul class="Flex-Box">
                            <li><i class="ri-notification-4-line" number="3"></i></li>
                            <li><i class="ri-message-2-line" number="5"></i></li>
                            <li class="Flex-Box">
                                <img style="width: 50px;" src="image/logo.png" alt="">
                                <p>3H-Admin<i class="ri-arrow-down-s-fill"></i> </p>
                            </li>
                        </ul>  
                    </div>
                </div>
                <div class="Admin-Content-Main">
                    <div class="Admin-Content-Main-Title">
                        <h1>Dashboard</h1>
                    </div>
                </div>            
            </div>
        </div>

    </section>

    <script src="js/script.js" ></script>
</body>
</html>