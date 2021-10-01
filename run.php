<?php  
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include("connection.php");

$sql = "SELECT * FROM tbl_content WHERE status=1 AND is_deleted=0 ORDER BY id DESC"; 
$result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
$data = [];
if ($result->num_rows > 0) {
     $i=0;
     while($row=mysqli_fetch_assoc($result))
     {
          $data[$i]['id'] = $row["id"];
          $data[$i]['title'] = $row["title"];
          $data[$i]['description'] = $row["description"];
          $data[$i]['banner'] = BASE_URL.'uploads/'.$row["banner"];
          $data[$i]['link'] = $row["link"];
          $data[$i]['qr_code'] = $row["qr_code"];
          $data[$i]['status'] = $row["status"];
          $i++;
     }
}
$jsonData = json_encode($data,JSON_PRETTY_PRINT);

// $fp = fopen('content.json', 'w');
// fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));   // here it will print the array pretty
// fclose($fp);

if(file_put_contents("content.json", $jsonData ))  
{  
     echo 'File created';  
}  
else  
{  
     echo 'There is some error';  
} 
 ?>
