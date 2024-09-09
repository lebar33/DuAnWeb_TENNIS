<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
$defaultCategories = [1, 2, 3, 4, 5];
$filterAll = filter();
if(!empty($filterAll['id'])){

   $categoryId = $filterAll['id'];

    if(in_array($categoryId, $defaultCategories)):
        // Thiết lập thông báo rằng đây là danh mục mặc định
        setFlashData('smg', 'Danh mục này là mặc định và không thể xóa');
        setFlashData('smg_type', 'danger');
    else:
        $categoryDetail = getRows("SELECT * FROM category WHERE id = $categoryId");
        if($categoryDetail>0){
            //xoa
            $deleteCategory = delete('category', "id = $categoryId");
            if($deleteCategory){
                setFlashData('smg', 'Xoá danh mục thành công.');
                setFlashData('smg_type', 'success');
            }
            else{
                setFlashData('smg', 'Lỗi hệ thống!');
                setFlashData('smg_type', 'danger');
            }
        }
        else{
            setFlashData('smg', 'Danh mục không tồn tại!');
            setFlashData('smg_type', 'danger');
        }
    endif;
}
else{
   setFlashData('smg', 'Liên kết không tồn tại!');
   setFlashData('smg_type', 'danger');
}

redirect('?module=admin&action=dashboard&quanli=listCategory');