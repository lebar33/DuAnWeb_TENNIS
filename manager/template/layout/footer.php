<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }
 //FOOTER - JS
$product1 = oneRaw("SELECT * FROM products WHERE id = 1");
$product2 = oneRaw("SELECT * FROM products WHERE id = 6");
$product3 = oneRaw("SELECT * FROM products WHERE id = 11");
$product4 = oneRaw("SELECT * FROM products WHERE id = 12");
$product5 = oneRaw("SELECT * FROM products WHERE id = 17");
?>

<section class="Hot-products">
    <div class="container">
        <div class="row-grid">
            <p class="heading-text" >NEW ARRIVALS</p>
        </div>
        <div class="row-grid row-grid-products">
            <div class="hot-product-item">
                <a href="?module=pages&action=product&id=<?php echo $product1['id'];?>"><img src="<?php echo $product1['image']; ?>" alt=""></a>
                <p><a href=""> <?php echo $product1['name']; ?> </a></p>
                <div class="hot-product-item-price">
                    <p><?php echo number_format($product1['price'], 0, ',', '.') . ' VND'; ?><span></span></p>
                </div>
            </div>
            <div class="hot-product-item">
                <a href="?module=pages&action=product&id=<?php echo $product2['id'];?>"><img src="<?php echo $product2['image']; ?>" alt=""></a>
                <p><a href=""> <?php echo $product2['name']; ?> </a></p>
                <div class="hot-product-item-price">
                    <p><?php echo number_format($product2['price'], 0, ',', '.') . ' VND'; ?><span></span></p>
                </div>
            </div>
            <div class="hot-product-item">
                <a href="?module=pages&action=product&id=<?php echo $product3['id'];?>"><img src="<?php echo $product3['image']; ?>" alt=""></a>
                <p><a href=""> <?php echo $product3['name']; ?> </a></p>
                <div class="hot-product-item-price">
                    <p><?php echo number_format($product3['price'], 0, ',', '.') . ' VND'; ?><span></span></p>
                </div>
            </div>
            <div class="hot-product-item">
                <a href="?module=pages&action=product&id=<?php echo $product4['id'];?>"><img src="<?php echo $product4['image']; ?>" alt=""></a>
                <p><a href=""> <?php echo $product4['name']; ?> </a></p>
                <div class="hot-product-item-price">
                    <p><?php echo number_format($product4['price'], 0, ',', '.') . ' VND'; ?><span></span></p>
                </div>
            </div>
            <div class="hot-product-item">
                <a href="?module=pages&action=product&id=<?php echo $product5['id'];?>"><img src="<?php echo $product5['image']; ?>" alt=""></a>
                <p><a href=""> <?php echo $product5['name']; ?> </a></p>
                <div class="hot-product-item-price">
                    <p><?php echo number_format($product5['price'], 0, ',', '.') . ' VND'; ?><span></span></p>
                </div>
            </div>
        </div>
    </div>
</section>


    <footer>
        <div class="container">
            <div class="row-grid">
                <div class="footer-item">
                    <p>3HCLUB</p>
                    <p>Đăng kí thành viên</p>
                    <p>Ưu đãi & Đặc quyền</p>
                </div>
                <div class="footer-item">
                    <P>CHÍNH SÁCH</P>
                    <p>Chính sách đổi trả 15 ngày</p>
                    <p>Chính sách khuyến mãi</p>
                    <p>Chính sách bảo mật</p>
                    <p>Chính sách giao hàng</p>
                </div>
                <div class="footer-item">
                    <p>CHĂM SÓC KHÁCH HÀNG</p>
                    <P>Trải nghiệm mưa sắm</P>
                    <p>Hỏi đáp</p>
                </div>
                <div class="footer-item">
                    <p>ĐỊA CHỈ LIÊN HỆ</p>
                    <p>Văn Phòng TP.HCM: 60/16 Quốc Lộ 13, Phường 26, Quận Bình Thạnh. </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="template/js/script.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js\bootstrap.min.js"> </script>
    