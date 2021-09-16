<?php  
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include("connection.php");

 $method = $_SERVER['REQUEST_METHOD'];
 if ($method == 'GET') {
     $sql = "SELECT * FROM tbl_content WHERE is_deleted=0 ORDER BY id DESC";  
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
               $i++;
          }
     }
}else{
     $data['message'] =  "method not allowed";
}
echo json_encode($data);  
 ?>