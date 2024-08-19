<!-- Tính năng đăng ký --> 
<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }

// Thay đổi title của trang
$tile=[
   'pageTitle' => 'Đăng ký tài khoản'
];
 layout('header', $tile);


$kq = getRows('SELECT * FROM users');
echo '<pre>';
print_r($kq);
echo '</pre>';
?>
<div class="row">
   <div class="col-4" style="margin:50px auto">
      <h2 class="text-center text-uppercase">Đăng ký tài khoản của bạn</h2>
      <form action="" method="post" >
         <div class="form-group mg-form">
            <label for="">Họ và tên</label>
            <input type="fullName" class="form-control" placeholder="Họ và tên của bạn"/>
         </div>
         <div class="form-group mg-form">
            <label for="">Email</label>
            <input type="email" class="form-control" placeholder="Địa chỉ email"/>
         </div>
         <div class="form-group mg-form">
            <label for="">Số điện thoại</label>
            <input type="number" class="form-control" placeholder="Số điện thoại"/>
         </div>
         <div class="form-group mg-form">
            <label for="">Password</label>
            <input type="password" class="form-control" placeholder="Mật khẩu"/>
         </div>
         <div class="form-group mg-form">
            <label for="">Nhập lại Password</label>
            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu"/>
         </div>
         <button type="submit" class="mg-btn btn btn-primary btn-block">Đăng ký</button><hr>
         <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
      </form>
   </div>
</div>

 <?php
layout('footer');
 ?>