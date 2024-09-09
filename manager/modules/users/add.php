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
      $dataInsert = [
         'fullName' => $filterAll['fullname'],
         'email' => $filterAll['email'],
         'phone' => $filterAll['phone'],
         'passWord' => password_hash($filterAll['password'], PASSWORD_DEFAULT),
         'status' => $filterAll['status'],
         'createAt' => date('Y-m-d H:i:s')
      ];
      $insertStatus = insert('users', $dataInsert);
      if($insertStatus){
         setFlashData('smg', 'Thêm người dùng mới thành công!');  
         setFlashData('smg_type', 'success');
         redirect('?module=admin&action=dashboard&quanli=listUsers');
      }
      else{
         setFlashData('smg', 'Hệ thống đang gặp lỗi vui lòng thử lại sau!');  
         setFlashData('smg_type', 'danger');
         redirect('?module=users&action=add');
      }

   }
   else {
      setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!'); // Khi lần đầu người dùng nhập sai nó sẽ hiện thông báo này
      setFlashData('smg_type', 'danger');
      setFlashData('error', $error);
      setFlashData('old', $filterAll);
      redirect('?module=users&action=add');// load lại khi thông tin đăng ký không hợp lệ thì sẽ chuyển lại trang đăng ký ko có thông báo nhập lỗi
   }
}
$smg = getFlashData('smg');  //Lấy lại thông báo trước khi load lại trang đăng ký
$smg_type = getFlashData('smg_type'); // Lấy lại loại thông báo trước khi load lại trang đăng ký
$error = getFlashData('error'); // Lấy lại các lỗi trước khi load lại trang đăng ký
$old = getFlashData('old'); // Lấy lại các thông tin đã nhập trước khi load lại trang đăng ký


// Thay đổi title của trang
$tile=[
   'pageTitle' => 'Thêm người dùng'
];
layout('header-login', $tile);
?>

<div class="container">
   <div class="row" style="margin:50px auto">
      <h2 class="text-center text-uppercase">Thêm người dùng</h2>
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
            </div>
            <div class="col">
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
               <div class="form-control">
                  <label for="">Trạng thái</label>
                  <select name="status" id="" class="form-control">
                     <option value="0" <?php echo (old('status', $old) == 0) ? 'selected' : false; ?>>Chưa kích hoạt</option>
                     <option value="1" <?php echo (old('status', $old) == 1) ? 'selected' : false; ?>>Đã kích hoạt</option>
                  </select>
               </div>
            </div>
         </div>

         <button type="submit" class="btn-user mg-btn btn btn-primary btn-block">Thêm người dùng</button>
         <a href="?module=admin&action=dashboard&quanli=listUsers" type="submit" class="btn-user mg-btn btn btn-success btn-block">Quay lại</a><hr>
      </form>
   </div>
</div>

 <?php
layout('footer-login');
 ?>