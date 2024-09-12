<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
$filterAll = filter();
$productId = $filterAll['id'];

if(isPost()){
    
    $dataUpdate = [
        'quantity' => $filterAll['quantity'],
        'size' => $filterAll['size']
    ];
    $updateStatus = update('orderdetail',$dataUpdate, "productId = $productId");
    if($updateStatus){
        setFlashData('smg','Cập nhật đơn hàng thành công!');  
        setFlashData('smg_type', 'success'); 
        redirect("?module=home&action=index&pages=gioHang");
    }
    else{
        setFlashData('smg','Cập nhật đơn hàng không thành công! Vui lòng thử lại sau!');  
        setFlashData('smg_type', 'danger'); 
        redirect("?module=home&action=index&pages=gioHang");
    }
    
    
}
$productDetail = oneRaw("SELECT * FROM products WHERE id = $productId");
$productOrder = oneRaw("SELECT * FROM orderdetail WHERE productId = $productId");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="template/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"  rel="stylesheet"/>   
    <title>Chỉnh sửa đơn hàng</title>
</head>
<body>
    <!-- Cart -->
    <section class="Cart-section p-to-top">
        <div class="container">
            <div class="row-flex row-flex-product-detail">
                <p>Giỏ Hàng</p>
            </div>
            <div class="row-grid-cart">
                <div class="Cart-Section-Left">
                    <form action="" method="post">
                        <h2 class="Main-h2">Chỉnh sửa đơn hàng</h2>
                        <div class="Cart-Section-Left-Detail">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>  
                                        <th>Sản Phẩm</th>
                                        <th>Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img style="width: 80px;" src="<?php echo $productDetail['image']; ?>" alt=""></td>
                                        <td>
                                            <div class="Product-Detail-In4-Right">
                                                <h1><?php echo $productDetail['name']; ?> </h1>
                                                <div class="hot-product-item-price">
                                                    <p><?php echo number_format($productDetail['price'], 0, ',', '.') . ' đ'; ?> </p>
                                                </div>
                                            </div>  
                                            <div class="Product-Detail-Right-Quantity">
                                                <h2>Số lượng: </h2>
                                                <div class="Product-Detail-Right-Quantity-Input">
                                                    <input class="Quantity-Input" name="quantity" type="number" value="<?php echo $productOrder['quantity']; ?>" min="1" >                               
                                                </div>    
                                                <h2>Size: </h2>
                                                <div class="Product-Detail-Right-Quantity-Input">
                                                    <input class="Quantity-Input" name="size" type="text" value="<?php echo $productOrder['size'] ?>">                              
                                                </div> 
                                        </div> 
                                        </td>
                                        <td>
                                            <p><?php echo number_format($productDetail['price'], 0, ',', '.') . ' đ'; ?> </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>   
                            <input type="hidden" name="id" value="<?php echo $productDetail['id']; ?>" />
                            <button class="Main-btn-cart"> Cập Nhật Giỏ Hàng </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

   <!-- Popular Product --> 
    <script src="teamplate/js/script.js"></script>
</body>
</html>