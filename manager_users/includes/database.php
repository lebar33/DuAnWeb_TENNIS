<?php
 if(!defined('_CODE')){ // Nếu hằng _CODE không tồn tại nghĩa là người dùng ko truy cập từ file index chính
    die('Acces denied...');
 }

 function query($sql, $data=[], $check = false){  // $check : nếu check chỉ viết vào dữ liệu thì là false, còn đọc dữ liệu ra thì true
   global $conn;
   $ketqua = false;
   try{
      $statement = $conn -> prepare($sql); // prepare là một phương thức bên trên class PDO hàm này tăng bảo mật trong lúc truyền dữ liệu 
      if(!empty($data)){
         $ketqua = $statement -> execute($data);
      }
      else{
         $ketqua = $statement -> execute();
      }
   }
   catch(Exception $exc){
      echo $exc->getMessage().'<br>';
      echo 'File: '.$exc->getFile().'<br>';
      echo 'Line: '.$exc->getLine().'<br>';
      die();
   }
   if($check){
      return $statement;
   }

   return $ketqua;
 }

 function insert($table, $data){
   $key = array_keys($data);
   $truong = implode(',', $key);// Biến này là câu lệnh INSERT INTO TABLLE (các Trường insert);
   $valuetb = ':'.implode(',:', $key); // Vì biến key trong câu insert into giống với các biến trong câu lệnh values nên sử dụng luôn mản key
   $sql = 'INSERT INTO '.$table.'('.$truong.') VALUES ('.$valuetb.')';

   $kq = query($sql, $data);
   return $kq;
 }
 function update($table, $data, $condition=""){ // condition LÀ UPDATE WHERE 
   $sql = 'UPDATE '.$table.' SET ';
   foreach($data as $key => $value){
      $sql .= $key.' = :'.$key.',';
   }
   $sql = trim($sql, ','); // xóa kí tự ',' ở cuối $sql 
   if(!empty($condition)){
      $sql .= ' WHERE '.$condition;
   }
   $kq = query($sql, $data);
   return $kq;
}
function delete($table, $condition = ""){
   $sql = 'DELETE FROM ';
   if(!empty($condition)){
      $sql.=$table." WHERE ".$condition;
   }
   else $sql.=$table;
   $kq = query($sql);
   return $kq;
}

// lấy nhiều dòng dl

function getRaw($sql){
   $kq = query($sql,'',true);
   if(is_object($kq)){
      $dataFetch = $kq->fetchAll(PDO::FETCH_ASSOC);
   }
   return $dataFetch;
}

// lấy 1 dòng dl
function oneRaw($sql){
   $kq = query($sql,'',true);
   if(is_object($kq)){
      $dataFetch = $kq->fetch(PDO::FETCH_ASSOC);
   }
   return $dataFetch;
}

// đếm số dòng
function getRows($sql){
   $kq = query($sql,'',true);
   if(!empty($kq)){
      return $kq->rowCount();
   }
   
}