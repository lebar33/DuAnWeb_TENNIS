<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
$filterAll = filter();
if(!empty($filterAll['id'])){
    $productId = $filterAll['id'];
    $productDetail = getRows("SELECT * FROM products WHERE id = $productId");
    if($productDetail>0){
        //xoa
        $deleteProduct = delete('products', "id = $productId");
        if($deleteProduct){
            setFlashData('smg', 'Xoá sản phẩm thành công.');
            setFlashData('smg_type', 'success');
        }
        else{
            setFlashData('smg', 'Lỗi hệ thống!');
            setFlashData('smg_type', 'danger');
        }
    }
    else{
        setFlashData('smg', 'Sản phẩm không tồn tại!');
        setFlashData('smg_type', 'danger');
    }
}
else{
    setFlashData('smg', 'Liên kết không tồn tại!');
    setFlashData('smg_type', 'danger');
}

redirect('?module=admin&action=dashboard&quanli=listProducts');