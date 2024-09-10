<?php
if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
   die('Acces denied...');
}
layout('header');
$filterAll = filter();
if(!empty($filterAll['id'])){
    $productId = $filterAll['id'];
    $productDetail = oneRaw("SELECT * FROM products WHERE id = $productId");
    if(!empty($productDetail)):
?>
<body>
<!-- Product Detail -->
<section class="Product-Detail p-to-top ">
    <div class="container">
        <div class="row-flex row-flex-product-detail">
            <p class="heading-text-product" >Home/</p><p><?php echo ' '.$productDetail['name']; ?></p>
        </div>
        <div class="row-grid">
            <div class="product-detail-items">
            </div> 
            <div class="Product-Detail-Left">
                <img class="Main-Detail-Image" src="<?php echo $productDetail['image']; ?>" alt="">      
            </div>       
            <div class="Product-Detail-Right">
                <div class="Product-Detail-In4-Right">
                    <h1><?php echo $productDetail['name']; ?></h1>
                    <?php if($productDetail['categoryId'] == 1){ ?><span>Carbon fiber</span> <?php } ?>
                    <div class="hot-product-item-price">
                        <p><?php echo number_format($productDetail['price'], 0, ',', '.') . ' VND'; ?><span><?php echo '   '.number_format($productDetail['price'] + 100000, 0, ',', '.') . ' VND'; ?></span> </p>
                    </div>
                </div>    
                <?php
                    if($productDetail['categoryId'] == 1):
                ?>
                <div class="Product-Detail-Right-Des">
                        <h2>Specification</h2>
                        <ul>
                            <li>Mặt vợt : 100 inch </li>
                            <li>Chiều dài : 27.5in / 69.85cm</li>
                            <li>Trọng lượng (chưa dây) : 300gr </li>
                            <li>Điểm cân bằng : 320 mm/ 7HL</li>
                            <li>Độ vung vợt : 334  </li>
                            <li>Độ cứng khung vợt : 65 </li>
                            <li>Kích cỡ gọng vợt  : 23mm / 26mm / 23mm</li>
                            <li>Mật độ lưới : 16 Mains / 19 Crosses</li>
                            <li>Lực căng dây : 23-27kg</li>                                
                        </ul>
                </div>
                <?php
                    endif;
                ?>
                <div class="Product-Detail-Right-Quantity">
                        <h2>Số lượng: </h2>
                        <div class="Product-Detail-Right-Quantity-Input">
                            <input class="Quantity-Input" type="number" value="1" min="0" >                               
                        </div>
                        <h2>Size: </h2>
                        <div class="Product-Detail-Right-Quantity-Input">
                            <select name="size" id="" class="form-control">
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                            </select>                             
                        </div>

                </div>
                <div class="Product-Detail-Right-Addtocart">
                        <button class="Main-btn" >Add To Cart</button>
                </div>
                                    
            </div>
        </div>
        <br>
        <?php
            if($productDetail['categoryId'] == 1):
        ?>
        <div class="row-grid-content">
            <div class="Product-Detail-Content">
                <h2>Giới Thiệu Sản Phẩm</h2>
                <p>Dòng sản phẩm Pure Aero mới với công nghệ còn tiên tiến và sáng tạo hơn! <br>

                    Với Pure Aero, Babolat mang đến sự kết hợp hoàn hảo giữa lực đánh và độ xoáy, giúp cây vợt này trở thành người chiến thắng trong mọi trận đấu. Thích hợp cho mọi người chơi, mong muốn có được khả năng kiểm soát, hiệu ứng và cảm giác mãnh liệt hơn bao giờ hết. <br>
                    
                    Nhờ những cập nhật ấn tượng, cây vợt có chiều dài mở rộng này mang đến cho những người chơi nghiêm túc khả năng tải bóng với tốc độ và độ xoáy lớn. <br>
                    
                    Pure Aero Plus mới là sự kết hợp hoàn hảo cho những người chơi hiếu chiến muốn kiểm soát cả độ xoáy và quỹ đạo. Một phần mở rộng thực sự của cánh tay truyền sức mạnh tự nhiên của bạn để áp đảo đối thủ, khiến anh ta mất phương hướng và khiến anh ta di chuyển đến mọi góc của sân. <br>
                    
                    Một điểm mới quan trọng là công nghệ NF² - Tech , giúp hấp thụ các rung động và cho phép chơi tốt hơn.</p>
                <img src="template/image/z5715086090139_0beebc8f86ed074c41002f59fe74761c.jpg" alt="">    
            </div>
        </div>
        <?php
            endif;
        ?>
    </div>
</section>
<!-- Hot product -->
<?php
    else:
        redirect('?module=admin&action=dashboard&quanli=listUsers');
    endif;
}
?>

<?php
    layout('footer');
?>
</body>
</html>