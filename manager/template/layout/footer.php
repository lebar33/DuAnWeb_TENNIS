<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }
 //FOOTER - JS
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js\bootstrap.min.js"> </script>
<script src="<?php echo _WEB_HOST_TEMPLATE; ?>/js\custom.js"> </script>
 
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