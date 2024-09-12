<!-- Tính năng đăng ký --> 
<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}

$filterAll = filter();

if(!empty($filterAll['id'])){
    $productId = $filterAll['id'];
    $productDetail = oneRaw("SELECT * FROM products WHERE id = $productId");

    if(!empty($productDetail)){
        setFlashData('product-detail', $productDetail); // Lấy lại toàn bộ thông tin người dùng đã post
    }
    else{
        redirect('?module=admin&action=dashboard&quanli=listProducts');
    }
}

if(isPost()){
    $filterAll = filter();// Gọi tới hàm filter trong file function lọc các đầu vào 
    $error = []; // Mảng chứa các lỗi 
    $productId = $filterAll['id'];
    //Validate name: bắt buột phải nhập, minlen >= 5, không được trùng
    if(empty($filterAll['name'])){ 
        $error['name']['required'] = 'Tên sản phẩm là bắc buộc!';
    }
    else if(strlen($filterAll['name']) < 5){
        $error['name']['min'] = 'Tên sản phẩm phải có ít nhất 5 ký tự!';
    }
    else{
        $nameProducts = $filterAll['name'];
        $sql = "SELECT id FROM products WHERE name = '$nameProducts' AND id <> $productId";
        if(getRows($sql) > 0){
            $error['name']['unique'] = 'Sản phẩm đã tồn tại!';
        }
    }

    //Validate giá tiền : bắt buộc nhập, đúng định dạng 
    if(empty($filterAll['price'])){
        $error['price']['required'] = 'Giá bán bắt buộc phải nhập!';
    }
    else{
        if(!isNumberInt($filterAll['price'])){
        $error['price']['isNumber'] = 'Giá bán không hợp lệ!';
        }
    }

    //Validate số lượng : bắt buộc nhập, đúng định dạng 
    if(empty($filterAll['quantity'])){
        $error['quantity']['required'] = 'Số lượng buộc phải nhập!';
    }
    else{
        if(!is_numeric($filterAll['quantity'])){
        $error['quantity']['isNumber'] = 'Số lượng không hợp lệ!';
        }
    }
    if(empty($error)){
        // di chuyển hình qua file template
        if(!empty($_FILES['imageProducts']['name'])){
            $r = move_uploaded_file($_FILES['imageProducts']['tmp_name'], 'E:\XAMPP\htdocs\DuAnWeb_TENNIS\manager\template\image\ '.$_FILES['imageProducts']['name']);
            $image = "template/image/".$_FILES['imageProducts']['name'];
        }
        else{
            $image = $productDetail['image'];
        }
        // Xử lý insert
        $dataInsert = [
            'name' => $filterAll['name'],
            'price' => $filterAll['price'],
            'quantity' => $filterAll['quantity'],
            'categoryId' => $filterAll['categoryId'],
            'image' => $image
        ];
        $insertStatus = update('products', $dataInsert,"id = $productId");
        if($insertStatus){
            setFlashData('smg', 'Cập nhật sản phẩm thành công!');  
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
    redirect('?module=products&action=edit&id='.$productId);
}
$smg = getFlashData('smg');  
$smg_type = getFlashData('smg_type'); 
$error = getFlashData('error'); 
$old = getFlashData('old');  
$productDetailll = getFlashData('product-detail');
if(!empty($productDetailll)){
   $old = $productDetailll;
}
// Thay đổi title của trang
$tile=[
   'pageTitle' => 'Cập nhật sản phẩm'
];
layout('header-login', $tile);
?>

<div class="container">
   <div class="row" style="margin:50px auto">
        <h2 class="text-center text-uppercase">Thêm sản phẩm mới</h2>
        <?php 
        if(!empty($smg)){
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Tên sản phẩm</label>
                        <input name="name" type="name" class="form-control" placeholder="Tên sản phẩm mới" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
                        echo old('name', $old);
                        ?>"/>
                        <?php
                            echo form_error('name','<span class="error">', '</span>', $error);
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Giá sản phẩm</label>
                        <input name="price" type="number" class="form-control" placeholder="VND" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
                        echo old('price', $old);
                        ?>"/>
                        <?php
                            echo form_error('price','<span class="error">', '</span>', $error);
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Số lượng</label>
                        <input name="quantity" type="number" class="form-control" placeholder="" style="font-family:Arial, Helvetica, sans-serif;" value="<?php
                        echo old('quantity', $old);
                        ?>"/>
                        <?php
                            echo form_error('quantity','<span class="error">', '</span>', $error);
                        ?>
                    </div>
                    <div class="form-control">
                        <label for="">Mã danh mục</label>
                        <select name="categoryId" id="" class="form-control">
                        <?php 
                            $listCategory = getRaw("SELECT * FROM category");
                            if(!empty($listCategory)):
                                foreach($listCategory as $item):
                        ?>
                            <option value="<?php echo $item['id'];?>" <?php echo (old('categoryId', $old) == $item['id']) ? 'selected' : false; ?> ><?php echo $item['id']." --> ".$item['name']; ?></option>
                        <?php
                                endforeach;
                            endif;
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="imageSp">Ảnh sản phẩm</label>
                        <!-- Hiển thị ảnh cũ -->
                        <?php if (!empty($old['image'])): ?>
                            <img src="<?php echo $old['image']; ?>" style="width: 100px; height: 100px;" alt="Ảnh sản phẩm hiện tại">
                        <?php endif; ?>
                        <input id="imageSp" name="imageProducts" type="file" class="form-control" placeholder="Cập nhật ảnh mới" style="font-family:Arial, Helvetica, sans-serif;" />
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $productId; ?>" />
            <button type="submit" class="btn-user mg-btn btn btn-primary btn-block">Update</button>
            <a href="?module=admin&action=dashboard&quanli=listProducts" type="submit" class="btn-user mg-btn btn btn-success btn-block">Quay lại</a><hr>
        </form>
   </div>
</div>

<?php
layout('footer-login');
?>