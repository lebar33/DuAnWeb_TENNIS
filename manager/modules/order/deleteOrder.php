<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
$filterAll = filter();
if(!empty($filterAll['id'])){
    $orderId = $filterAll['id'];
    $orderDetail = getRows("SELECT * FROM orderDetail WHERE orderId = $orderId");
    if($orderDetail>0){
        //xoa orderdetail
        $deleteOrderDetail = delete('orderdetail', "orderId = $orderId");
        if($deleteOrderDetail){
            //Xóa orders
            $deleteOrder = delete('orders', "id = $orderId");
            if($deleteOrder){
                setFlashData('smg', 'Xóa đơn hàng thành công');
                setFlashData('smg_type', 'success');
            }
            else{
                setFlashData('smg', 'Lỗi hệ thống!');
                setFlashData('smg_type', 'danger');
            }
        }
    }
    else{
        setFlashData('smg', 'Đơn hàng không tồn tại!');
        setFlashData('smg_type', 'danger');
    }
}
else{
    setFlashData('smg', 'Liên kết không tồn tại!');
    setFlashData('smg_type', 'danger');
}

redirect('?module=admin&action=dashboard&quanli=listOrder');