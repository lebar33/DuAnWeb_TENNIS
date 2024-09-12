<!-- quên mật khẩu --> 
<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}

 //Thayy đổi title của trang 
$title=[  
   'pageTitle' => 'Quên mật khẩu'
];

layout('header-login', $title);

//Kiểm tra trạng thái đăng nhập 
$check = false;

if(isPost()){
   $filterAll = filter();
   if(!empty($filterAll['email'])){
      $email = $filterAll['email'];
      $queryUser = oneRaw("SELECT id FROM users WHERE email = '$email'");
      if(!empty($queryUser)){
         $userId = $queryUser['id'];
         //tạo forgotToken
         $forgotToken = sha1(uniqid().time());
         $dataUpdate = [
            'forgotToken' => $forgotToken
         ];
         $updateStatus = update('users', $dataUpdate, "id = $userId");
         if($updateStatus){
            // tạo link khôi phục mật khẩu 
            $linkReset = _WEB_HOST.'?module=auth&action=reset&token='.$forgotToken;
            //Gửi mail cho người dùng 
            $subject = 'Yêu cầu khôi phục mật khẩu.';
            $content = 'Chào bạn. <br>';
            $content .= 'Vui lòng nhấp chuột vào đường link sau để khôi phục mật khẩu: <br>';
            $content .= $linkReset.'<br>';
            $content .= 'Trân trọng cảm ơn.';
            $sendEmail = sendMail($email, $subject, $content);
            if($sendEmail){
               setFlashData('msg', 'Vui lòng kiểm tra email để đổi mật khẩu!');
               setFlashData('msg_type', 'success');
            }
            else{
               setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sau! (email)');
               setFlashData('msg_type', 'danger');
            }
         }
         else{
            setFlashData('msg', 'Lỗi hệ thông! Vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
         }
      }
      else{
         setFlashData('msg', 'Địa chỉ email không tồn tại!');
         setFlashData('msg_type', 'danger');
      }
   }
   else{
      setFlashData('msg', 'Vui lòng nhập địa chỉ email!');
      setFlashData('msg_type', 'danger');
   }
   redirect('?module=auth&action=fogot');
}

//Lấy thông báo từ khác trang khác 
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>


<div class="row">
   <div class="col-4" style="margin:50px auto">
      <h2 class="text-center text-uppercase">Quên mật khẩu</h2>
      <?php 
      if(!empty($msg)){
         getSmg($msg, $msgType);
      }
      ?>
      <form action="" method="post" >
         <div class="form-group mg-form">
            <label for="">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" style="font-family:Arial, Helvetica, sans-serif;"/>
         </div>
         <button type="submit" class="mg-btn btn btn-primary btn-block">Gửi</button><hr>
         <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
         <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản của bạn</a></p>
      </form>
   </div>
</div>

 <?php
layout('footer-login');
 ?>