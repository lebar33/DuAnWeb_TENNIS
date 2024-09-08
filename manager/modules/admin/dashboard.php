<?php
$title = [
    'pageTitle'=>'Trang ADMIN'
];
layout('header-admin',$title);
if(!isLogin()) redirect('?module=auth&action=login');
?>
<body>
    <section class="Admin">
        <div class="row-grid">
            <?php require_once('./modules/sidebar\sidebar-admin.php');?>
            
            
            <div class="Admin-Content">
                <div class="Admin-Content-Top">
                    <div class="Admin-Content-Top-Left">
                        <ul class="Flex-Box">
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="Admin-Content-Top-Right">
                        <ul class="Flex-Box">
                            <li><i class="ri-notification-4-line" number="3"></i></li>
                            <li><i class="ri-message-2-line" number="5"></i></li>
                            <li class="Flex-Box">
                                <a href="?module=home"><img style="width: 50px;" src="./template/image/logo.png" alt=""></a>
                                <p>3H-Admin<i class="ri-arrow-down-s-fill"></i> </p>
                            </li>
                        </ul>  
                    </div>
                </div>
                <?php include('main-dashboard.php'); ?>
            </div>
        </div>

    </section>

    <script src="template\js\script-admin.js" ></script>
</body>
</html>