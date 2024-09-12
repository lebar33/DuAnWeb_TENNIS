<?php
    if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
    }
    if(!isLogin()) redirect('?module=auth&action=login');

    if(isPost()){
        $filterAll = filter();// Gọi tới hàm filter trong file function lọc các đầu vào 
        //lấy email trong bảng users có id = userId trong bảng orders
        $orderId = $filterAll['id'];
        $userQuery = oneRaw("SELECT * FROM orders WHERE id = $orderId");
        $userId = $userQuery['userId'];
        $mailQuery = oneRaw("SELECT * FROM users WHERE id = $userId");
        $mail = $mailQuery['email'];
        
        $error = []; // Mảng chứa các lỗi 
        //Validate fullname: bắt buột phải nhập, minlen >= 5 
        if(empty($filterAll['deliveryName'])){
        $error['deliveryName']['required'] = 'Họ tên bắt buộc phải nhập!';
        }
        else{
        if(strlen($filterAll['deliveryName']) < 5)
        $error['deliveryName']['min'] = 'Họ tên phải có ít nhất 5 ký tự!';
        }
        
    
        //Validate số điện thoại : bắt buộc nhập, đúng định dạng 
        if(empty($filterAll['deliveryPhone'])){
        $error['deliveryPhone']['required'] = 'Số điện thoại bắt buộc phải nhập!';
        }
        else{
        if(!isphone($filterAll['deliveryPhone'])){
            $error['deliveryPhone']['isPhone'] = 'Số điện thoại không hợp lệ!';
        }
        }

        if(empty($filterAll['deliveryAddress'])){
            $error['deliveryAddress']['required'] = 'Địa chỉ bắt buộc phải nhập!';
        }
        else{
            if(strlen($filterAll['deliveryAddress']) < 5)
            $error['deliveryAddress']['min'] = 'Địa chỉ phải có ít nhất 5 ký tự!';
        }
    
    
        if(empty($error)){
        $confirmToken = sha1(uniqid().time());
        $dataUpdate = [
                'deliveryName' => $filterAll['deliveryName'],
                'deliveryPhone' => $filterAll['deliveryPhone'],
                'deliveryAddress' => $filterAll['deliveryAddress'],
                'status' => 0,
                'note' => $filterAll['note'],
                'confirmToken' => $confirmToken
            ];
            $orderId = $filterAll['id'];
            $updateStatus = update('orders', $dataUpdate, "id = $orderId");
            //token để gửi mail
            if($updateStatus){
                $linkConfirm= _WEB_HOST.'?module=pages&action=success&orderId='.$orderId.'&token='.$confirmToken;
                //Gửi mail cho người dùng 
                $subject = 'Xác nhận đơn hàng';
                $content = 'Chào bạn. <br>';
                $content .= 'Vui lòng nhấp chuột vào đường link sau để xác thực thông tin giao hàng <br>';
                $content .= $linkConfirm.'<br>';
                $content .= 'Trân trọng cảm ơn.';
                $sendEmail = sendMail($mail, $subject, $content);
                if($sendEmail){
                    redirect("?module=pages&action=orderConfirm&orderId=$orderId");
                }
                else{
                    setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sau! (email)');
                    setFlashData('msg_type', 'danger');
                }
            }
        }
        else {
        setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!'); // Khi lần đầu người dùng nhập sai nó sẽ hiện thông báo này
        setFlashData('smg_type', 'danger');
        setFlashData('error', $error);
        setFlashData('old', $filterAll);
        redirect('?module=home&action=index&pages=gioHang');
        }
    }
    
    $tokenLogin = getSession('loginToken');
    $userQuery = oneRaw("SELECT * FROM logintoken WHERE token = '$tokenLogin'");
    $userId = $userQuery['idUser'];
    $orderQuery = oneRaw("SELECT * FROM orders WHERE userId = '$userId'");
    $orderId = $orderQuery['id'];
    $listCart = getRaw("SELECT * FROM orderdetail WHERE orderId = $orderId");

    $error = getFlashData('error');
    $old = getFlashData('old'); 
    $smg = getFlashData('smg');  
    $smg_type = getFlashData('smg_type'); 
    ?>
    <br>
<form action="?module=pages&action=gioHang" method="post">
    <section class="Cart-section p-to-top">
        <div class="container">
            <?php 
            if(!empty($smg)){
                getSmg($smg, $smg_type);
            }
            ?>
            <?php  
            if(empty($listCart)):
            ?>
            <div class="row-flex row-flex-product-detail">
                <p class="heading-text-1">Hãy mua hàng để lắp đầy giỏi hàng nào</p> 
            </div>
            <?php
            else:
            ?>
            <div class="row-flex row-flex-product-detail">
                <p class="heading-text-1">Giỏ hàng</p> 
            </div>
            <div class="row-grid-cart">
                <div class="Cart-Section-Left">
                        <h2 class="Main-h2">Chi Tiết Đơn Hàng</h2>
                        <div class="Cart-Section-Left-Detail">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Sản Phẩm</th>
                                        <th>Thành Tiền</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        foreach($listCart as $item):
                                            $productId = $item['productId'];
                                            $queryProduct = oneRaw("SELECT * FROM products WHERE id=$productId");
                                        ?>
                                        <td><img style="width: 80px;" src="<?php echo $queryProduct['image']; ?>" alt=""></td>
                                        <td>
                                            <div class="Product-Detail-In4-Right">
                                                <h1><?php echo $queryProduct['name']; ?> </h1>
                                                <div class="hot-product-item-price">
                                                    <p><?php echo number_format($queryProduct['price'], 0, ',', '.') . ' đ'; ?> </p>
                                                </div>
                                            </div>
                                            <div class="Product-Detail-Right-Quantity">
                                                <h2>Số lượng: </h2>
                                                <div class="Product-Detail-Right-Quantity-Input">
                                                    <input class="Quantity-Input" name="quantity" type="number" value="<?php echo $item['quantity'] ?>" min="1" >                              
                                                </div>
                                                <h2>Size: </h2>
                                                <div class="Product-Detail-Right-Quantity-Input">
                                                    <input class="Quantity-Input" name="size" type="text" value="<?php echo $item['size'] ?>" min="1" >                              
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p><?php echo number_format($queryProduct['price']*$item['quantity'], 0, ',', '.') . ' đ'; ?> </p>
                                        </td>
                                        <td><a href="?module=pages&action=editGioHang&id=<?php echo $item['productId']; ?>"><p>Sửa</p></a></td>
                                        <td><a href="?module=pages&action=deleteGioHang&id=<?php echo $item['productId']; ?>"><p>Xóa</p></a></td>
                                    </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                </tbody>
                            </table>   
                            <button class="Main-btn-cart"> <a style="color: white;" href="?module=home&action=index">Tiếp Tục Mua Hàng</a></button>
                        </div>
                </div>

                <div class="Cart-Section-Right">
                        <h2 class="Main-h2">Thông Tin Giao Hàng </h2>
                        <div class="Cart-Section-Right-Input-Name-Phone">
                            <input type="text" placeholder="Họ & Tên" name="deliveryName" id="" value="<?php
                            echo old('deliveryName', $old);
                            ?>" >
                            <?php
                            echo form_error('deliveryName','<span class="error">', '</span>', $error);
                            ?>
                            <input type="text" placeholder="Số Điện Thoại" name="deliveryPhone" id="" value="<?php
                            echo old('deliveryPhone', $old);
                            ?>">
                            <?php
                            echo form_error('deliveryPhone','<span class="error">', '</span>', $error);
                            ?>
                        </div>
                        <div class="Cart-Section-Right-Input-Address">
                            <input type="text" placeholder="Địa Chỉ" name="deliveryAddress" id="" value="<?php
                            echo old('deliveryAddress', $old);
                            ?>">
                            <?php
                            echo form_error('deliveryAddress','<span class="error">', '</span>', $error);
                            ?>
                        </div>
                        <div class="Cart-Section-Right-Input-Note">
                            <input type="text" placeholder="Ghi Chú" name="note" id="" >
                        </div>
                        <input type="hidden" name="id" value="<?php echo $orderId; ?>" />
                        <button type="submit" class="Main-btn-cart"> Gửi Đơn Hàng</button>  
                </div>
            </div>
            <?php
            endif;
            ?>
        </div>
    </section>
</form>

    <!-- Popular Product --> 

    </body>
    </html>