<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
$filterAll = filter();
$orderId = $filterAll['orderId'];
$userQuery = oneRaw("SELECT * FROM orders WHERE id = $orderId");
$userId = $userQuery['userId'];
$mailQuery = oneRaw("SELECT * FROM users WHERE id = $userId");
$mail = $mailQuery['email'];
$orderQuery = oneRaw("SELECT * FROM orders WHERE id = $orderId");
layout('header');
?>
    <!-- Order Confirm -->
     <section class="Order_Confirm p-to-top">
        <div class="container">
            <div class="row-flex row-flex-product-detail">
                <p>Xác Nhận Đơn Hàng: <span style="font-weight: bold;" ><?php echo $orderQuery['deliveryName']; ?></span>  </p>
            </div>
            <div class="row-flex-order">
                <div class="Order-Confirm-Content">
                    <p>Đơn hàng của bạn đã được xác nhận <span style="font-weight: bold;" >Thành Công</span> ! <br>
                      <span style="font-size: small ;"> Bạn vui lòng check <span style="font-style: italic;">Email: <?php echo $mail; ?></span> để xác nhận và xác nhận Đơn Hàng</span></p>
                </div>
                <button class="Main-btn-cart"> <a style="color: white;" href="?module=home&action=index">Tiếp Tục Mua Hàng</a></button>
            </div>
        </div>
     </section>
   
    <?php   
    layout('footer');
    ?>
</body>
</html>