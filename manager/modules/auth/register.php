<!-- Tính năng đăng ký --> 
<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}


if(isPost()){
   $filterAll = filter();// Gọi tới hàm filter trong file function lọc các đầu vào 
   $error = []; // Mảng chứa các lỗi 

   //Validate fullname: bắt buột phải nhập, minlen >= 5 
   if(empty($filterAll['fullname'])){ // Nếu người dùng không nhập full name thì $fillterAll['fullname'] sẽ không có trong fullterAll
      $error['fullname']['required'] = 'Họ tên bắt buộc phải nhập!';
   }
   else{
      if(strlen($filterAll['fullname']) < 5)
      $error['fullname']['min'] = 'Họ tên phải có ít nhất 5 ký tự!';
   }


   // validate email: Bắt buộc nhập, đúng định dạng email, đã tồn tại trong cơ sở dữ liệu hay chưa 
   if(empty($filterAll['email'])){ // Nếu người dùng không nhập email thì $fillterAll['email'] sẽ không có trong fullterAll
      $error['email']['required'] = 'Email bắt buộc phải nhập!';
   }
   else{
      $email = $filterAll['email'];
      $sql = "SELECT id FROM users WHERE email = '$email'";
      if(getRows($sql) > 0){
         $error['email']['unique'] = 'Email đã tồn tại!';
      }
   }

   //Validate số điện thoại : bắt buộc nhập, đúng định dạng 
   if(empty($filterAll['phone'])){
      $error['phone']['required'] = 'Số điện thoại bắt buộc phải nhập!';
   }
   else{
      if(!isphone($filterAll['phone'])){
         $error['phone']['isPhone'] = 'Số điện thoại không hợp lệ!';
      }
   }

   //Validate password: Bắt buộc nhập, ít nhất 8 kí tự 
   if(empty($filterAll['password'])){ 
      $error['password']['required'] = 'Mật khẩu bắt buộc phải nhập!';
   }
   else{
      if(strlen($filterAll['password']) < 8){
         $error['password']['min'] = 'Mật khẩu phải có ít nhất 8 ký tự!';
      }
   }

   //Validate password-confirm: Bắt buộc phải nhập, giống password
   if(empty($filterAll['password-confirm'])){ 
      $error['password-confirm']['required'] = 'Bạn phải nhập lại mật khẩu!';
   }
   else{
      if($filterAll['password'] != $filterAll['password-confirm']){
         $error['password-confirm']['match'] = 'Mật khẩu nhập lại không chính xác!';
      }
   }

   if(empty($error)){
      // Xử lý insert
      $activeToken = sha1(uniqid().time()); // Mỗi lần chạy hàm sha1 nó sẽ ra 1 số ngẫu nhiên khác nhau 
      $dataInsert = [
         'fullName' => $filterAll['fullname'],
         'email' => $filterAll['email'],
         'phone' => $filterAll['phone'],
         'passWord' => password_hash($filterAll['password'], PASSWORD_DEFAULT),
         'activeToken' => $activeToken,
         'createAt' => date('Y-m-d H:i:s')
      ];
      $insertStatus = insert('users', $dataInsert);
      if($insertStatus){

         //Tạo link kích hoạt
         $linkActive = _WEB_HOST.'?module=auth&action=active&token='.$activeToken;

         //Thiết lập thành công 
         $subject = $filterAll['fullname'].' vui lòng kích hoạt tài khoản!';
         
         $content = 'Chào '.$filterAll['fullname'].'<br>';
         $content .= 'Vui lòng click vào đường link dưới đây để kích hoạt tài khoản: <br>';
         $content .= $linkActive.'<br>';
         $content .= 'Trân trọng cảm ơn!';

         //Gửi mail
         $senmail =  sendMail($filterAll['email'], $subject, $content);
         if($senmail){
            setFlashData('smg', 'Đăng ký thành công!!, Vui lòng kiểm tra email để kích hoạt tài khoản!');  
            setFlashData('smg_type', 'success');
         }else{
            setFlashData('smg', 'Hệ thống đang gặp sự cố, vui lòng thử lại sau!');  
            setFlashData('smg_type', 'danger');
         }
      }
      else{
         setFlashData('smg', 'Đăng ký không thành công!');  
         setFlashData('smg_type', 'danger');
      }

      redirect('?module=auth&action=register');
   }
   else {
      setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!'); // Khi lần đầu người dùng nhập sai nó sẽ hiện thông báo này
      setFlashData('smg_type', 'danger');
      setFlashData('error', $error);
      setFlashData('old', $filterAll);
      redirect('?module=auth&action=register');// load lại khi thông tin đăng ký không hợp lệ thì sẽ chuyển lại trang đăng ký ko có thông báo nhập lỗi
   }
}
$smg = getFlashData('smg');  //Lấy lại thông báo trước khi load lại trang đăng ký
$smg_type = getFlashData('smg_type'); // Lấy lại loại thông báo trước khi load lại trang đăng ký
$error = getFlashData('error'); // Lấy lại các lỗi trước khi load lại trang đăng ký
$old = getFlashData('old'); // Lấy lại các thông tin đã nhập trước khi load lại trang đăng ký


// Thay đổi title của trang
$tile=[
   'pageTitle' => 'Đăng ký tài khoản'
];
layout('header-login', $tile);
?>

<div class="row">
   <div class="col-4" style="margin:50px auto">
      <h2 class="text-center text-uppercase">Đăng ký tài khoản của bạn</h2>
      <?php 
      if(!empty($smg)){
         getSmg($smg, $smg_type);
      }
      ?>
      <form action="" method="post" >
         <div class="form-group mg-form">
            <label for="">Họ và tên</label>
            <input name="fullname" type="fullname" class="form-control" placeholder="Họ và tên của bạn" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
            echo old('fullname', $old);
            ?>"/>
            <?php
               echo form_error('fullname','<span class="error">', '</span>', $error);
            ?>
         </div>
         <div class="form-group mg-form">
            <label for="">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
            echo old('email', $old);
            ?>"/>
            <?php
               echo form_error('email','<span class="error">', '</span>', $error);
            ?>
         </div>
         <div class="form-group mg-form">
            <label for="">Số điện thoại</label>
            <input name="phone" type="number" class="form-control" placeholder="Số điện thoại" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
            echo old('phone', $old);
            ?>"/>
            <?php
               echo form_error('phone','<span class="error">', '</span>', $error);
            ?>
         </div>
         <div class="form-group mg-form">
            <label for="">Password</label>
            <input name="password" type="password" class="form-control" placeholder="Mật khẩu" style="font-family:Arial, Helvetica, sans-serif;"/>
            <?php
               echo form_error('password','<span class="error">', '</span>', $error);
            ?>
         </div>
         <div class="form-group mg-form">
            <label for="">Nhập lại Password</label>
            <input name="password-confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu" style="font-family:Arial, Helvetica, sans-serif;"/>
            <?php
               echo form_error('password-confirm','<span class="error">', '</span>', $error);
            ?>
         </div>
         <button type="submit" class="mg-btn btn btn-primary btn-block">Đăng ký</button><hr>
         <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
      </form>
   </div>
</div>

 <?php
layout('footer-login');
 ?>