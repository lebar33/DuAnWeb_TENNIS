<!-- reset password--> 
<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }
 $title=[  
   'pageTitle' => 'Đặt lại mật khẩu'
];
layout('header', $title);

$token = filter()['token'];

if(!empty($token)){
   $tokenQuery = oneRaw("SELECT id, fullName, email FROM users WHERE forgotToken = '$token'");
   if(!empty($tokenQuery)){
      if(isPost()){
         $filterAll = filter();// Gọi tới hàm filter trong file function lọc các đầu vào 
         $error = []; // Mảng chứa các lỗi 
      
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
            // Xử lý update password
            $passWordHash = password_hash($filterAll['password'], PASSWORD_DEFAULT);
            $dataUpdate = [
               'passWord' => $passWordHash,
               'forgotToken' => null,
               'updateAt' => date('Y:m:d H:i:s')
            ];
            $idUser = $tokenQuery['id'];
            $updateStatus = update('users', $dataUpdate, "id = $idUser");
            if($updateStatus){
               setFlashData('msg', 'Thay đổi mật khẩu thành công!');
               setFlashData('msg_type', 'success');
               redirect('?module=auth&action=login');
            }
            else{
               setFlashData('msg', 'Thay đổi mật khẩu thành công!');
               setFlashData('msg_type', 'success');
            }
         }
         else {
            setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!'); // Khi lần đầu người dùng nhập sai nó sẽ hiện thông báo này
            setFlashData('smg_type', 'danger');
            setFlashData('error', $error);
            redirect('?module=auth&action=reset&token='.$token);// load lại khi thông tin đăng ký không hợp lệ thì sẽ chuyển lại trang đăng ký ko có thông báo nhập lỗi
         }
      }
      $smg = getFlashData('smg');  //Lấy lại thông báo trước khi load lại trang đăng ký
      $smg_type = getFlashData('smg_type'); // Lấy lại loại thông báo trước khi load lại trang đăng ký
      $error = getFlashData('error'); // Lấy lại các lỗi trước khi load lại trang đăng ký
      ?>
      <div class="row">
         <div class="col-4" style="margin:50px auto">
            <h2 class="text-center text-uppercase">ĐẶT LẠI MẬT KHẨU</h2>
            <?php 
            if(!empty($smg)){
               getSmg($smg, $smg_type);
            }
            ?>
            <form action="" method="post" >
               <div class="form-group mg-form">
                  <label for="">Password</label>
                  <input name="password" type="password" class="form-control" placeholder="Mật khẩu"/>
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
               <input type="hidden" name="token" value="<?php echo $token; ?>">
               <button type="submit" class="mg-btn btn btn-primary btn-block">Gửi</button><hr>
               <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
            </form>
         </div>
      </div>
      <?php
   }
   else{
      getSmg('Liên kết không tồn tại hoặc đã hết hạn', 'danger');
   }
}
else{
   getSmg('Liên kết không tồn tại hoặc đã hết hạn', 'danger');
}

layout('footer-login');
?>