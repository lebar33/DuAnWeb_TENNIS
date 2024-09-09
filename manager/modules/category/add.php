<!-- Tính năng đăng ký --> 
<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}


if(isPost()){
   $filterAll = filter();// Gọi tới hàm filter trong file function lọc các đầu vào 
   $error = []; // Mảng chứa các lỗi 

   //Validate name: bắt buột phải nhập, minlen >= 2, không được trùng
   if(empty($filterAll['name'])){ 
      $error['name']['required'] = 'Tên danh mục là bắc buộc!';
   }
   else if(strlen($filterAll['name']) < 2){
      $error['name']['min'] = 'Tên danh mục phải có ít nhất 2 ký tự!';
   }
   else{
      $nameCategory = $filterAll['name'];
      $sql = "SELECT id FROM category WHERE name = '$nameCategory'";
      if(getRows($sql) > 0){
         $error['name']['unique'] = 'Tên danh mục đã tồn tại!';
      }
   }

   if(empty($error)){
      // Xử lý insert
      $dataInsert = [
         'name' => $filterAll['name'],
         'describ' => $filterAll['describ']
      ];
      $insertStatus = insert('category', $dataInsert);
      if($insertStatus){
         setFlashData('smg', 'Thêm danh mục mới thành công!');  
         setFlashData('smg_type', 'success');
         redirect('?module=admin&action=dashboard&quanli=listCategory');
      }
      else{
         setFlashData('smg', 'Hệ thống đang gặp lỗi vui lòng thử lại sau!');  
         setFlashData('smg_type', 'danger');
         redirect('?module=category&action=add');
      }

   }
   else {
      setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!'); // Khi lần đầu người dùng nhập sai nó sẽ hiện thông báo này
      setFlashData('smg_type', 'danger');
      setFlashData('error', $error);
      setFlashData('old', $filterAll);
      redirect('?module=category&action=add');// load lại khi thông tin đăng ký không hợp lệ thì sẽ chuyển lại trang đăng ký ko có thông báo nhập lỗi
   }
}
$smg = getFlashData('smg');  //Lấy lại thông báo trước khi load lại trang đăng ký
$smg_type = getFlashData('smg_type'); // Lấy lại loại thông báo trước khi load lại trang đăng ký
$error = getFlashData('error'); // Lấy lại các lỗi trước khi load lại trang đăng ký
$old = getFlashData('old'); // Lấy lại các thông tin đã nhập trước khi load lại trang đăng ký


// Thay đổi title của trang
$tile=[
   'pageTitle' => 'Thêm danh mục'
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
                  <label for="">Tên danh mục</label>
                  <input name="name" type="name" class="form-control" placeholder="Tên danh mục mới" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
                  echo old('name', $old);
                  ?>"/>
                  <?php
                     echo form_error('name','<span class="error">', '</span>', $error);
                  ?>
               </div>
               <div class="form-group mg-form">
                  <label for="">Mô tả danh mục</label>
                  <input name="describ" type="describ" class="form-control" placeholder="Mô tả" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
                  echo old('describ', $old);
                  ?>"/>
                  <?php
                     echo form_error('describ','<span class="error">', '</span>', $error);
                  ?>
               </div>
            </div>
         </div>

         <button type="submit" class="btn-user mg-btn btn btn-primary btn-block">Thêm danh mục</button>
         <a href="?module=admin&action=dashboard&quanli=listCategory" type="submit" class="btn-user mg-btn btn btn-success btn-block">Quay lại</a><hr>
      </form>
   </div>
</div>

 <?php
layout('footer-login');
 ?>