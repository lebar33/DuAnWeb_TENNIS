<!-- các hàm chung của project --> 

 <?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
 function layout($layoutName="header", $data=[]){
   if(file_exists(_WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php')){
      require_once (_WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php');
   }
 }

//Hàm gửi mail 
function sendMail($to, $subject, $content){

   //Create an instance; passing `true` enables exceptions
   $mail = new PHPMailer(true);

   try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'lebar69218@gmail.com';                     //SMTP username
      $mail->Password   = 'aokh ieuf htnx udfz';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('letruong8017@gmail.com', 'LeBar');
      $mail->addAddress($to);                               //Add a recipient

      //Content
      $mail->CharSet = "UTF-8";
      $mail->isHTML(true);                                  //Set email format to HTML

      $mail->Subject = $subject;                            //Tiêu đề của mail
      $mail->Body    = $content;                            //Nội dung của mail 

      
      $senMail = $mail->send();
      if($senMail){
         return $senMail;
      }
   } catch (Exception $e) {
      echo "Gửi mail thất bại. Mailer Error: {$mail->ErrorInfo}";
   }
}


//Kiểm tra phương thức get 
function isGet(){
   if($_SERVER['REQUEST_METHOD'] == 'GET'){
      return true;
   }
   return false;
}

//Kiểm tra phương thức post
function isPost(){
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      return true;
   }
   return false;
}

//Hàm lọc dữ liệu
function filter(){
   $filterArr = []; // Mảng lưu các giá trị của của $_GET hoặc $_POST vào và xử lí để nó không chạy trong chương trình, giả sử giá trị của 2 phương thức kia là các dòng code thì nó sẽ được xử lí 
   if(isGet()){
      // Xử lí dữ liệu trước khi hiển thị
      // return $_GET;
      if(!empty($_GET)){
         foreach($_GET as $key => $val){
            $key = strip_tags($key); // Loại bỏ các thể html và php ra khỏi chuỗi 
            if(is_array($val)){
               $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY); // Có thể value trong GET HOẶC POST LÀ MẢNG NÊN MÌNH CẦN LỌC NÓ VÀ ĐƯA VÀO $fillArr
            }
            else{
               $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            //filter_input hàm lọc dữ liệu đầu vào có sẵn trong php nó mã hóa dữ liệu đầu vào
         }
      }
   }

   if(isPost()){
      // Xử lí dữ liệu trước khi hiển thị
      if(!empty($_POST)){
         foreach($_POST as $key => $val){
            $key = strip_tags($key);
            if(is_array($val)){
               $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);//Locj dữ liệu 
            }
            else{
               $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
         }
      }
   }
   return $filterArr;
}


function isEmail($email){
   $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
   return $checkEmail;
}

// Kiem tra so nguye
function isNumberInt($num){
   $checkNum = filter_var($num, FILTER_VALIDATE_INT);
   return $checkNum;
}

//Kiem tra so thuc
function isNumberFloat($num){
   $checkNum = filter_var($num, FILTER_VALIDATE_FLOAT);
   return $checkNum;
}

//Hàm kiểm tra số điện thoại 
function isphone($phone){
   // 0123456789
   if($phone[0] != '0') return false;
   $phone = substr($phone, 1);
   if(!isNumberInt($phone)) return false;
   if(strlen($phone) != 9) return false;
   return true;
}

// Thông báo lỗi
function getSmg($smg, $type='success'){ // type: loại thông báo thành công hay thông báo lỗi 
   if(!empty($smg)){
      echo "<div class='alert alert-".$type."'>";
      echo $smg;
      echo "</div>";
   }
}

//Hàm chuyển hướng khi người dùng đăng ký thông tin 
function redirect($path='index.php'){
   header("Location: $path"); //Hàm chuyển hướng trang
   exit();
}

//Thông báo khi người dùng nhập sai dữ liệu nào đó
function form_error($fileName, $beforHtml='', $afterHtml='', $error=[]){ // $beforHtml: thẻ html gì đó tương tự với afterHtml
   return (!empty($error[$fileName])) ? $beforHtml.reset($error[$fileName]).$afterHtml:null;
}

//Hiển thị dữ liệu cũ của người dùng khi nhập thông tin trước đó
function old($fileName, $oldData, $default = null){
   return (!empty($oldData[$fileName])) ? $oldData[$fileName] : $default;
}

//Hàm kiểm tra trạng thái đăng nhập 
function isLogin(){
   //Kiểm tra trạng thái đăng nhập => nếu đăng nhập không hợp lệ sẽ ko có session có nghĩa ko qua bước đăng nhập nên điều hướng về trang login 
   $check = false;
   if(getSession('loginToken')){
      $tokenLogin = getSession('loginToken');

      // Kiểm tra xem token đó đã tồn tại trong bảng loginToken hay chưa hoặc id trùng với admin
      $query = oneRaw("SELECT idUser FROM logintoken WHERE token = '$tokenLogin'");
      if(!empty($query) || $query['idUser'] != 37){
         $check = true;
      }
      else{
         removeSession('loginToken');
      }
   }
   return $check;
}

function isLoginAdmin(){
   //Kiểm tra trạng thái đăng nhập => nếu đăng nhập không hợp lệ sẽ ko có session có nghĩa ko qua bước đăng nhập nên điều hướng về trang login 
   $check = false;
   if(getSession('loginTokenAdmin')){
      $tokenLogin = getSession('loginTokenAdmin');

      // Kiểm tra xem token đó đã tồn tại trong bảng loginToken hay chưa hoặc id trùng với admin
      $query = oneRaw("SELECT idUser FROM logintoken WHERE tokenAdmin = '$tokenLogin'");
      if(!empty($query) && $query['idUser'] == 37){
         $check = true;
      }
      else{
         removeSession('loginToken');
      }
   }
   return $check;
}