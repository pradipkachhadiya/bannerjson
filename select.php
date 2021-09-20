<?php  
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include("connection.php");

$headers = apache_request_headers();
if(!empty($headers)){
     $token = $headers['token'];
     if(empty($token)){
          $data['message'] =  "unauthanticated";
          echo json_encode($data); 
          die(); 
     }

     $sql = "SELECT * FROM tbl_users WHERE md5(email)= '$token' AND is_deleted=0";  
     $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
     if ($result->num_rows > 0) {
          while($row=mysqli_fetch_assoc($result))
          {
               $permission = explode(',',$row["permission"]);
               if (!in_array('View', $permission)){
                    $data['message'] =  "You don't have permssion to view content";
                    echo json_encode($data); 
                    die(); 
               }
          }
     }else{
          $data['message'] =  "unauthanticated";
          echo json_encode($data); 
          die(); 
     }
     
}

 $method = $_SERVER['REQUEST_METHOD'];
 if ($method == 'GET') {
     if($headers['flag'] == 1){
          $sql = "SELECT * FROM tbl_content WHERE is_deleted=0 ORDER BY id DESC";  
     }else{
          $sql = "SELECT * FROM tbl_content WHERE status=1 AND is_deleted=0 ORDER BY id DESC"; 
     }
     
     $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
     $data = [];
     if ($result->num_rows > 0) {
          $i=0;
          while($row=mysqli_fetch_assoc($result))
          {
               $data[$i]['id'] = $row["id"];
               $data[$i]['title'] = $row["title"];
               $data[$i]['description'] = $row["description"];
               $data[$i]['banner'] = $row["banner"];
               $data[$i]['link'] = $row["link"];
               $data[$i]['qr_code'] = $row["qr_code"];
               $data[$i]['status'] = $row["status"];
               $i++;
          }
     }
}else{
     $data['message'] =  "method not allowed";
}
echo json_encode($data);  
 ?>