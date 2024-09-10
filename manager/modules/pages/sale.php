<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
//truy vấn vào bảng men
$listProductSale = getRaw("SELECT * FROM products WHERE categoryId = 5");
if(empty($listProductSale)):
?>
<section class="Hot-product-list p-to-top">
    <div class="container" >
        <div class="row-flex row-flex-product">
            <p class="heading-text-1">Danh mục tạm thời rỗng</p> 
        </div>
    </div>
</section>
<?php
else: 
?>
<section class="Hot-product-list p-to-top">
    <div class="container" >
        <div class="row-flex row-flex-product">
            <p class="heading-text-1">GIẢM GIÁ</p> 
        </div>
        <div class="row-grid row-grid-products">
<?php
    foreach($listProductSale as $item):
?>


            <div class="hot-product-item">
                <a href="?module=pages&action=product&id=<?php echo $item['id'];?>"><img src="<?php echo $item['image']; ?>" alt=""></a>
                <p><a href=""> <?php echo $item['name']; ?> </a></p>
                <div class="hot-product-item-price">
                    <p><?php echo number_format($item['price'], 0, ',', '.') . ' VND'; ?><span></span></p>
                </div>
            </div>
<?php
    endforeach;
endif;
?>
        </div>
    </div>
</section>

