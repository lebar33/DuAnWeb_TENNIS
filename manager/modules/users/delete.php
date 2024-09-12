<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
$defaultAdmin = 37;
$filterAll = filter();
if(!empty($filterAll['id'])){
   $userId = $filterAll['id'];
   $userDetail = getRows("SELECT * FROM users WHERE id = $userId");
   if($userId == $defaultAdmin){
      setFlashData('smg', 'Tài khoản này là mặc định và không thể xóa');
      setFlashData('smg_type', 'danger');
   }
   else if($userDetail>0){
      //xoa
      $deletToken = delete('loginToken', "idUser = $userId");
      if($deletToken){
         $deleteUser = delete('users', "id = $userId");
         if($deleteUser){
            setFlashData('smg', 'Xoá người dùng thành công.');
            setFlashData('smg_type', 'success');
         }
         else{
            setFlashData('smg', 'Lỗi hệ thống!');
            setFlashData('smg_type', 'danger');
         }
      }
   }
   else{
      setFlashData('smg', 'Người dùng không tồn tại!');
      setFlashData('smg_type', 'danger');
   }
}
else{
   setFlashData('smg', 'Liên kết không tồn tại!');
   setFlashData('smg_type', 'danger');
}

redirect('?module=admin&action=dashboard&quanli=listUsers');