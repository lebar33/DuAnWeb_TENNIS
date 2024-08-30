<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }
 //HEADER - CSS
 ?>

 <!DOCTYPE html>
 <html lang="vi">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo !empty($data['pageTitle'])?$data['pageTitle'] : 'Quản lý người dùng'?> </title>
   <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/style.css?ver=<?php echo rand();?>">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"  rel="stylesheet"/>
   <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/css/style1.css?ver=<?php echo rand();?>">
 </head>
 <body>
   
 </body>
 </html>