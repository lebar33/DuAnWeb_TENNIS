<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
layout('header-list');

//Kiểm tra người dùng đã đăng nhập chưa 
if(!isLoginAdmin()) redirect('?module=auth&action=login');

//truy vấn vào bảng users
$listOrder = getRaw("SELECT * FROM orders WHERE deliveryName <> ' '");


$smg = getFlashData('smg');  //lấy thông báo của các trang như add hay delete để hiển thị ở trang list
$smg_type = getFlashData('smg_type'); // lấy kiểu thông báo của các trang như add hay delete để hiển thị ở trang list
?>

<div class="container">
    <br>
    <h2 style="text-align: center;">Danh sách đơn hàng</h2>
    <?php
        if(!empty($smg)){
            getSmg($smg, $smg_type);
        }
    ?>
    <?php 
    if(empty($listOrder)):
    ?>
    <div class="alert alert-danger text-center">Không có đơn hàng nào</div>
    <?php
    else:
    ?>
    <table class="table table-bordered">
        <thead>
            <th>STT</th>
            <th>Tên</th>
            <th>SDT</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Ghi chú</th>
            <th width="10%">Chi tiết</th>
            <th>Ngày</th>
            <th>Trạng thái</th>
            <th width="10%">Delete</th>
        </thead>
        <tbody>
        <?php
            $count = 0;
            foreach($listOrder as $item): 
                //lấy userId để truy cập vào user có id = userId trong listOrder để lấy email
                $id = $item['userId'];
                $queryUser = oneRaw("SELECT * FROM users WHERE id = $id");
                $email = $queryUser['email'];
                $count++;
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $item['deliveryName']; ?></td>
            <td><?php echo $item['deliveryPhone']; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $item['deliveryAddress']; ?></td>
            <td><?php echo $item['note']; ?></td>
            <td><a href="?module=order&action=orderDetail&id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-circle-info"></i></a></td> <!--sửa-->
            <td><?php echo $item['orderDate']; ?></td>
            <td><?php echo $item['status'] ? '<button class="btn btn-danger btn-sm">Đã xác nhận</button>'
            : '<button class="btn btn-success btn-sm">Chưa xác nhận</button>'; ?></td>
            <td><a href="?module=order&action=deleteOrder&id=<?php echo $item['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></td><!--xóa-->
        </tr>
        <?php
            endforeach;
        endif;
        ?> 
        </tbody>
    </table>
    
</div>