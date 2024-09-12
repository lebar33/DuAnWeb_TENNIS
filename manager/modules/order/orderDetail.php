<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
layout('header-list');

//Kiểm tra người dùng đã đăng nhập chưa 
if(!isLogin()) redirect('?module=auth&action=login');

$id = filter()['id'];
//truy vấn vào bảng orderDetail
$listProduct = getRaw("SELECT * FROM orderDetail WHERE orderId = $id");

$smg = getFlashData('smg');  //lấy thông báo của các trang như add hay delete để hiển thị ở trang list
$smg_type = getFlashData('smg_type'); // lấy kiểu thông báo của các trang như add hay delete để hiển thị ở trang list
?>

<div class="container">
    <br>
    <h2 style="text-align: center;">Chi tiết đơn hàng</h2>
    <?php
        if(!empty($smg)){
            getSmg($smg, $smg_type);
        }
    ?>
    <?php 
    if(empty($listProduct)):
    ?>
    <div class="alert alert-danger text-center">Không có sản phẩm nào</div>
    <?php
    else:
    ?>
    <table class="table table-bordered">
        <thead>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Size</th>
            <th>Thành tiền</th>
        </thead>
        <tbody>
        <?php
            $tongTien = 0;
            $count = 0;
            foreach($listProduct as $item): 
                //lấy userId để truy cập vào product để lấy name và price, image
                $id = $item['productId'];
                $queryProduct = oneRaw("SELECT * FROM products WHERE id = $id");
                $name = $queryProduct['name'];
                $price = $queryProduct['price'];
                $tongTien += $price*$item['quantity'];
                $image = $queryProduct['image'];
                $count++;
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><img style="width: 50px; height: 40px;" src="<?php echo $image;?>" alt=""></td>
            <td><?php echo $name; ?></td>
            <td><?php echo number_format($price, 0, ',', '.') . 'đ'; ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo $item['size']; ?></td>
            <td><?php echo number_format($item['quantity']*$price, 0, ',', '.') . 'đ'; //Hàm tách số tiền cho dễ nhìn?></td>
        </tr>
        
        <?php
            endforeach;
        ?>
            <tr>
                <td style="font-weight: 700; border-right: 1px solid white;" colspan="5">Tổng Cộng</td>
                <td></td>
                <td style="font-weight: 700;"><?php echo number_format($tongTien, 0, ',', '.') . 'đ';?></td>
                <td style="border: 1px solid white;" ></td>
            </tr>
        <?php
        endif;
        ?> 
        
        </tbody>
    </table>
    <a href="?module=admin&action=dashboard&quanli=listOrder" type="submit" class="btn-user mg-btn btn btn-success btn-block">Quay lại</a><hr>
</div>