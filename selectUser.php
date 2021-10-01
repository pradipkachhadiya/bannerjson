<?php  
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include("connection.php");
$method = $_SERVER['REQUEST_METHOD'];

$headers = apache_request_headers();
if(!empty($headers)){
     $token = $headers['token'];
     if(empty($token)){
          $data['message'] =  "unauthanticated";
          echo json_encode($data); 
          die(); 
     }
     if ($headers['flag'] == 1) {

          $sql = "SELECT * FROM tbl_users WHERE role=2 AND is_deleted=0 ORDER BY id DESC";  
          $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
          $data = [];
          if ($result->num_rows > 0) {
               $i=0;
               while($row=mysqli_fetch_assoc($result))
               {
                    $data[$i]['id'] = $row["id"];
                    $data[$i]['fullname'] = $row["fullname"];
                    $data[$i]['email'] = $row["email"];
                    $data[$i]['profile_image'] = BASE_URL.'uploads/'.$row["profile_image"];
                    $data[$i]['permission'] = $row["permission"];
                    $data[$i]['status'] = $row["status"];
                    $i++;
               }
          }
         
     }else{
          if ($method == 'GET') {
               $sql = "SELECT * FROM tbl_users WHERE md5(email)= '$token' AND is_deleted=0";  
               $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
               $data = [];
               if ($result->num_rows > 0) {
                    while($row=mysqli_fetch_assoc($result))
                    {
                         $data['id'] = $row["id"];
                         $data['fullname'] = $row["fullname"];
                         $data['email'] = $row["email"];
                         $data['profile_image'] = BASE_URL.'uploads/'.$row["profile_image"];
                         $data['permission'] = $row["permission"];
                         $data['status'] = $row["status"];
                    }
               }else{
                    $data['message'] =  "unauthanticated";
                    echo json_encode($data); 
                    die(); 
               }
          }else{
               $data['message'] =  "method not allowed";
          }
     }
     echo json_encode($data); 
     die(); 
}

  
 ?>