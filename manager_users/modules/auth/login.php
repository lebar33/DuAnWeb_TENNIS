<!-- Tính năng đăng nhập --> 
<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }

$data=[
   'pageTitle' => 'Đăng nhập tài khoản'
];

 layout('header', $data);
 ?>

<div class="row">
   <div class="col-4" style="margin:50px auto">
      <h2 class="text-center text-uppercase">Đăng nhập</h2>
      <form action="" method="post" >
         <div class="form-group mg-form">
            <label for="">Email</label>
            <input type="email" class="form-control" placeholder="Địa chỉ email"/>
         </div>
         <div class="form-group mg-form">
            <label for="">Password</label>
            <input type="password" class="form-control" placeholder="Mật khẩu"/>
         </div>
         <button type="submit" class="mg-btn btn btn-primary btn-block">Đăng nhập</button><hr>
         <p class="text-center"><a href="?module=auth&action=fogot">Quên mật khẩu</a></p>
         <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản của bạn</a></p>
      </form>
   </div>
</div>

 <?php
layout('footer');
 ?>