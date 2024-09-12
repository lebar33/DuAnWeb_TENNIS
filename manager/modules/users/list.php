<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
layout('header-list');

//Kiểm tra người dùng đã đăng nhập chưa 
if(!isLoginAdmin()) redirect('?module=auth&action=login');

//truy vấn vào bảng users
$listUser = getRaw("SELECT * FROM users ORDER BY updateAt");

// echo '<pre>';
// print_r($listUser);
// echo '</pre>';
$smg = getFlashData('smg');  //Lấy lại thông báo trước khi load lại trang đăng ký
$smg_type = getFlashData('smg_type'); // Lấy lại loại thông báo trước khi load lại trang đăng ký
?>
<div class="container">
   <h2 style="text-align: center;">Danh sách người dùng</h2>
   <?php 
      if(!empty($smg)){
         getSmg($smg, $smg_type);
      }
   ?>
   <p>
      <a href="?module=users&action=add" class="btn btn-success btn-sm">Thêm người dùng <i class="fa-solid fa-plus"></i></a>
   </p>
   <table class="table table-bordered">
      <thead>
         <th>STT</th>
         <th>Ho Ten</th>
         <th>Email</th>
         <th>SDT</th>
         <th>Trang thai</th>
         <th width="10%">Edit</th>
         <th width="10%">Delete</th>
      </thead>
      <tbody>
      <?php
         $count = 0;
         if(!empty($listUser)):
            foreach($listUser as $item): 
               $count++;
      ?>
      <tr>
         <td><?php echo $count; ?></td>
         <td><?php echo $item['fullName'] ?></td>
         <td><?php echo $item['email'] ?></td>
         <td><?php echo $item['phone'] ?></td>
         <td><?php echo $item['status'] ? '<button class="btn btn-danger btn-sm">Đã kích hoạt</button>'
         : '<button class="btn btn-success btn-sm">Chưa kích hoạt</button>'; ?></td>
         <td><a href="?module=users&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td> <!--sửa-->
         <td><a href="?module=users&action=delete&id=<?php echo $item['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></td><!--xóa-->
      </tr>
      <?php
            endforeach;
         else: 
      ?> 
         <tr>
            <td colspan="7">
               <div class="alert alert-danger text-center">Không có người dùng nào</div>
            </td>
         </tr>
      <?php
         endif;
      ?>
      </tbody>
   </table>
</div>