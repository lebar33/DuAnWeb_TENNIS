<!-- Tính năng đăng ký --> 
<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}

$filterAll = filter();
if(!empty($filterAll['id'])){
   $userId = $filterAll['id'];
   $userDetail = oneRaw("SELECT * FROM users WHERE id = $userId");
   if(!empty($userDetail)){
      setFlashData('user-detail', $userDetail); // Lấy lại toàn bộ thông tin người dùng đã post
   }
   else{
      redirect('?module=admin&action=dashboard&quanli=listUsers');
   }
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
      $sql = "SELECT id FROM users WHERE email = '$email' AND id <> $userId";
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

   if(!empty($filterAll['password'])){
      //Validate password-confirm: Bắt buộc phải nhập, giống password
      if(empty($filterAll['password-confirm'])){ 
         $error['password-confirm']['required'] = 'Bạn phải nhập lại mật khẩu!';
      }
      else{
         if($filterAll['password'] != $filterAll['password-confirm']){
            $error['password-confirm']['match'] = 'Mật khẩu nhập lại không chính xác!';
         }
      }
   }

   if(empty($error)){
      // Xử lý insert
      $dataUpdate = [
         'fullName' => $filterAll['fullname'],
         'email' => $filterAll['email'],
         'phone' => $filterAll['phone'],
         'status' => $filterAll['status'],
         'createAt' => date('Y-m-d H:i:s')
      ];
      if(!empty($filterAll['password'])){
         $dataUpdate['passWord'] = password_hash($filterAll['password'], PASSWORD_DEFAULT);
      }
      $insertStatus = update('users', $dataUpdate, "id = $userId");
      if($insertStatus){
         setFlashData('smg', 'Sửa thông tin người dùng thành công!');  
         setFlashData('smg_type', 'success');
      }
      else{
         setFlashData('smg', 'Hệ thống đang gặp lỗi vui lòng thử lại sau!');  
         setFlashData('smg_type', 'danger');
      }

   }
   else {
      setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!'); // Khi lần đầu người dùng nhập sai nó sẽ hiện thông báo này
      setFlashData('smg_type', 'danger');
      setFlashData('error', $error);
      setFlashData('old', $filterAll);
   }
   redirect('?module=users&action=edit&id='.$userId);
}
$smg = getFlashData('smg');  //Lấy lại thông báo trước khi load lại trang đăng ký
$smg_type = getFlashData('smg_type'); // Lấy lại loại thông báo trước khi load lại trang đăng ký
$error = getFlashData('error'); // Lấy lại các lỗi trước khi load lại trang đăng ký
$old = getFlashData('old'); // Lấy lại các thông tin đã nhập trước khi load lại trang đăng ký
$userDetailll = getFlashData('user-detail');
if(!empty($userDetailll)){
   $old = $userDetailll;
}
// Thay đổi title của trang
layout('header-login');
?>

<div class="container">
   <div class="row" style="margin:50px auto">
      <h2 class="text-center text-uppercase">SỬA NGƯỜI DÙNG</h2>
      <?php 
      if(!empty($smg)){
         getSmg($smg, $smg_type);
      }
      ?>
      <form action="" method="post" >
         <div class="row">
            <div class="col">
               <div class="form-group mg-form">
                  <label for="">Họ và tên</label>
                  <input name="fullname" type="fullname" class="form-control" placeholder="Họ và tên của bạn" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
                  echo old('fullName', $old);
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
            </div>
            <div class="col">
               <div class="form-group mg-form">
                  <label for="">Password</label>
                  <input name="password" type="password" class="form-control" placeholder="Mật khẩu (Không nhập nếu không thay đổi)" style="font-family:Arial, Helvetica, sans-serif;"/>
                  <?php
                     echo form_error('password','<span class="error">', '</span>', $error);
                  ?>
               </div>
               <div class="form-group mg-form">
                  <label for="">Nhập lại Password</label>
                  <input name="password-confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu (Không nhập nếu không thay đổi)" style="font-family:Arial, Helvetica, sans-serif;"/>
                  <?php
                     echo form_error('password-confirm','<span class="error">', '</span>', $error);
                  ?>
               </div>
               <div class="form-control">
                  <label for="">Trạng thái</label>
                  <select name="status" id="" class="form-control">
                     <option value="0" <?php echo (old('status', $old) == 0) ? 'selected' : false; ?>>Chưa kích hoạt</option>
                     <option value="1" <?php echo (old('status', $old) == 1) ? 'selected' : false; ?>>Đã kích hoạt</option>
                  </select>
               </div>
            </div>
         </div>
         <input type="hidden" name="id" value="<?php echo $userId; ?>" />
         <button type="submit" class="btn-user mg-btn btn btn-primary btn-block">Update</button>
         <a href="?module=admin&action=dashboard&quanli=listUsers" type="submit" class="btn-user mg-btn btn btn-success btn-block">Quay lại</a><hr>
      </form>
   </div>
</div>

 <?php
layout('footer-login');
 ?>