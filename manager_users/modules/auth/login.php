<!-- Tính năng đăng nhập --> 
<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }

 //Thayy đổi title của trang 
$title=[  
   'pageTitle' => 'Đăng nhập tài khoản'
];

layout('header-login', $title);

//Kiểm tra trạng thái đăng nhập 
$check = false;

if(isLogin()){
   redirect('?module=home&action=dashboard');
}

if(isPost()){
   $filterAll = filter();
   if(!empty(trim($filterAll['email'])) && !empty(trim($filterAll['passWord']))){
      //Kiem tra dang nhap
      $email = $filterAll['email'];
      $pass = $filterAll['passWord'];

      //Truy vấn users theo email 
      $userQuery = oneRaw("SELECT passWord, id FROM users WHERE email = '$email'");
      if(!empty($userQuery)){
         $passWordHash = $userQuery['passWord'];
         $userId = $userQuery['id'];
         if(password_verify($pass, $passWordHash)){ // Kiem tra mật khẩu người dùng nhập đúng với mật khẩu trên database ko 
            //Điều hướng dến trang chính
            //Tạo tokenLogin 
            $tokenLogin = sha1(uniqid().time());

            //Insert vào bảng loginToken đển xem tài khoản nào đang sử dụng 
            $dataInsert = [
               'idUser' => $userId,
               'token' => $tokenLogin,
               'createAt' => date('Y-m-d H:i:s')
            ];
            $insertStatus = insert('logintoken', $dataInsert);
            if($insertStatus){
               //insert Thành công

               //Lưu cái loginToken vào session -> tiện cho việc kiểm tra xem người dùng có đang đăng nhập hay không
               setSession('loginToken', $tokenLogin);
               redirect('?module=home&action=dashboard');
            }
            else{
               setFlashData('msg','Không thể đăng nhập thành công! Vui lòng thử lại sau.');
               setFlashData('msg_type', 'danger');
            }
         }
         else{
            setFlashData('msg','Mật khẩu không chính xác!');
            setFlashData('msg_type', 'danger');
            
         }
      } 
      else{
         setFlashData('msg','Email không tồn tại');
         setFlashData('msg_type', 'danger');
         
      }
   }
   else{
      setFlashData('msg','Vui lòng nhập email và mật khẩu!');
      setFlashData('msg_type', 'danger');
      
   }
   redirect('?module=auth&action=login');
}

//Lấy thông báo từ khác trang khác 
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

// $passWord = '123456';
// $passwordHash = password_hash($passWord, PASSWORD_DEFAULT); // mã hóa mật khẩu thành những dãy khác nhau 
// echo $passwordHash.'<br>';

// $checkPass = password_verify($passWord, $passwordHash);  // Hàm kiểm tra xem chuỗi $passWord có phải là mã băm $passwordHash không 
// var_dump($checkPass);
?>


<div class="row">
   <div class="col-4" style="margin:50px auto">
      <h2 class="text-center text-uppercase">Đăng nhập</h2>
      <?php 
      if(!empty($msg)){
         getSmg($msg, $msgType);
      }
      ?>
      <form action="" method="post" >
         <div class="form-group mg-form">
            <label for="">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Địa chỉ email" style="font-family:Arial, Helvetica, sans-serif;" />
         </div>
         <div class="form-group mg-form">
            <label for="">Password</label>
            <input name="passWord" type="text" class="form-control" placeholder="Mật khẩu" style="font-family:Arial, Helvetica, sans-serif;"/>
         </div>
         <button type="submit" class="mg-btn btn btn-primary btn-block">Đăng nhập</button><hr>
         <p class="text-center"><a href="?module=auth&action=fogot">Quên mật khẩu</a></p>
         <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản của bạn</a></p>
      </form>
   </div>
</div>

 <?php
layout('footer-login');
 ?>