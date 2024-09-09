<!-- Tính năng đăng ký --> 
<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}

$filterAll = filter();
if(!empty($filterAll['id'])){
    $categoryId = $filterAll['id'];
    $categoryDetail = oneRaw("SELECT * FROM category WHERE id = $categoryId");
    if(!empty($categoryDetail)){
        setFlashData('category-detail', $categoryDetail);
    }
    else{
        redirect('?module=admin&action=dashboard&quanli=listCategory');
    }
}

if(isPost()){
    $filterAll = filter();// Gọi tới hàm filter trong file function lọc các đầu vào 
    $error = []; // Mảng chứa các lỗi 
    $categoryrId = $filterAll['id'];
    //Validate fullname: bắt buột phải nhập, Tên danh mục không được trùng
    if(empty($filterAll['name'])){
        $error['name']['required'] = 'Tên danh mục bắt buộc phải nhập!';
    }
    else{
        $name = $filterAll['name'];
        $sql = "SELECT id FROM category WHERE name = '$name' AND id <> $categoryId";
        if(getRows($sql) > 0){
            $error['name']['unique'] = 'Tên danh mục đã tồn tại!';
        }
    }

    //Validate descrip: Không được để trống
    if(empty($filterAll['describ'])){
        $error['describ']['required'] = 'Mô tả danh mục bắt buộc phải nhập!';
    }
   
    if(empty($error)){
        // Xử lý insert
        $dataUpdate = [
            'name' => $filterAll['name'],
            'describ' => $filterAll['describ']
        ];
        $insertStatus = update('category', $dataUpdate, "id = $categoryId");
        if($insertStatus){
            setFlashData('smg', 'Sửa thông tin danh mục thành công!');  
            setFlashData('smg_type', 'success');
        }
        else{
            setFlashData('smg', 'Hệ thống đang gặp lỗi vui lòng thử lại sau!');  
            setFlashData('smg_type', 'danger');
        }
    }
    else {
        setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!'); // Khi lần đầu người dùng nhập sai nó sẽ hiện thông báo này
        setFlashData('smg_type', 'danger');
        setFlashData('error', $error);
        setFlashData('old', $filterAll);
    }
    redirect('?module=category&action=edit&id='.$categoryId);
}
$smg = getFlashData('smg');  //Lấy lại thông báo trước khi load lại trang đăng ký
$smg_type = getFlashData('smg_type'); // Lấy lại loại thông báo trước khi load lại trang đăng ký
$error = getFlashData('error'); // Lấy lại các lỗi trước khi load lại trang đăng ký
$categoryDetailll = getFlashData('category-detail');
$old = getFlashData('old');
if(!empty($categoryDetailll)){
   $old = $categoryDetailll;
}
// Thay đổi title của trang
layout('header-login');
?>

<div class="container">
   <div class="row" style="margin:50px auto">
        <h2 class="text-center text-uppercase">SỬA DANH MỤC</h2>
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
                        <input name="name" type="name" class="form-control" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
                        echo old('name', $old);
                        ?>"/>
                        <?php
                            echo form_error('name','<span class="error">', '</span>', $error);
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Mô tả danh mục</label>
                        <input name="describ" type="describ" class="form-control" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
                        echo old('describ', $old);
                        ?>"/>
                        <?php
                            echo form_error('describ','<span class="error">', '</span>', $error);
                        ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $categoryId; ?>" />
            <button type="submit" class="btn-user mg-btn btn btn-primary btn-block">Update</button>
            <a href="?module=admin&action=dashboard&quanli=listCategory" type="submit" class="btn-user mg-btn btn btn-success btn-block">Quay lại</a><hr>
        </form>
    </div>
</div>

 <?php
layout('footer-login');
 ?>