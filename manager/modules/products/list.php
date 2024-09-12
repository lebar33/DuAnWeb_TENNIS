<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
layout('header-list');

//Kiểm tra người dùng đã đăng nhập chưa 
if(!isLoginAdmin()) redirect('?module=auth&action=login');

//truy vấn vào bảng users
$listProducts = getRaw("SELECT * FROM products");

// echo '<pre>';
// print_r($listUser);
// echo '</pre>';
$smg = getFlashData('smg');  //lấy thông báo của các trang như add hay delete để hiển thị ở trang list
$smg_type = getFlashData('smg_type'); // lấy kiểu thông báo của các trang như add hay delete để hiển thị ở trang list
?>

<div class="container">
   <br>
   <h2 style="text-align: center;">Danh sách sản phẩm</h2>
   <?php 
      if(!empty($smg)){
        getSmg($smg, $smg_type);
      }
   ?>
   
   <p>
      <a href="?module=products&action=add" class="btn btn-success btn-sm">Thêm sản phẩm<i class="fa-solid fa-plus"></i></a>
   </p>
   <?php 
   if(empty($listProducts)):
   ?>
   <div class="alert alert-danger text-center">Không có sản phẩm nào</div>
   <?php
   else:
   ?>
   <table class="table table-bordered">
      <thead>
         <th>STT</th>
         <th>Ảnh</th>
         <th>Tên sản phẩm</th>
         <th>Giá sản phẩm</th>
         <th>Số lượng</th>
         <th>Mã danh mục</th>
         <th width="10%">Edit</th>
         <th width="10%">Delete</th>
      </thead>
      <tbody>
      <?php
         $count = 0;
         foreach($listProducts as $item): 
            $count++;
      ?>
      <tr>
         <td><?php echo $count; ?></td>
         <td><img style="width: 50px; height: 40px;" src="<?php echo $item['image']?>" alt=""></td>
         <td><?php echo $item['name']; ?></td>
         <td><?php echo number_format($item['price'], 0, ',', '.') . ' đ'; //Hàm tách số tiền cho dễ nhìn?></td>
         <td><?php echo $item['quantity']; ?></td>
         <td><?php echo $item['categoryId']; ?></td>
         <td><a href="?module=products&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td> <!--sửa-->
         <td><a href="?module=products&action=delete&id=<?php echo $item['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></td><!--xóa-->
      </tr>
      <?php
         endforeach;
      endif;
      ?> 
      </tbody>
   </table>
</div>