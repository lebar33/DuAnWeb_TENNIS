<!-- kích hoạt tài khoản --> 
<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}

layout('header');

$token = filter()['token'];// Lấy token trên thanh địa chỉ 
if(!empty($token)){
   //truy vấn kiểm tra token với database
   $tokenQuery = oneRaw("SELECT id FROM users WHERE activeToken = '$token'");
   if(!empty($tokenQuery)){
      $userId = $tokenQuery['id'];
      $dataUpdate = [
         'status' => 1,
         'activeToken' => null
      ];
      $updateStatus = update('users', $dataUpdate, "id = $userId");
      if($updateStatus){
         setFlashData('msg', 'Kích hoạt tài khoản thành công, bạn có thể đăng nhập ngay bây giờ!');
         setFlashData('msg_type', 'success');
      }
      else{
         setFlashData('msg', 'Kích hoạt tài khoản không thành công, vui lòng liên hệ admin!');
         setFlashData('msg_type', 'danger');
      }
      redirect('?module=auth&action=login');
   }
   else{
      getSmg('Liên kết không tồn tại hoặc đã hết hạn!', 'danger'); //Khi kích hoạt thành công thì đã xóa token rồi nên khi kiểm tra lại sẽ ko còn token nữa và liên kết hết hạn rồi 
   }
}
else{
   getSmg('Liên kết không tồn tại hoặc đã hết hạn!', 'danger');
}


layout('footer');
?>
<h1>ACTIVE</h1>