<?php  
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include("connection.php");
$permission = '';
$headers = apache_request_headers();

if(!empty($headers) ){
     $token = $headers['token'];
     if(empty($token)){
          $data['message'] =  "unauthanticated";
          echo json_encode($data); 
          die(); 
     }
     $user_id = 1;
     $sql = "SELECT * FROM tbl_users WHERE md5(email)= '$token' AND is_deleted=0";  
     $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
     if ($result->num_rows > 0) {
          while($row=mysqli_fetch_assoc($result))
          {
               $permission = explode(',',$row["permission"]);
               $user_id = $row["id"];
          }
     }else{
          $data['message'] =  "unauthanticated";
          echo json_encode($data); 
          die(); 
     }
}

$input = json_decode(file_get_contents('php://input'),true);
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
   
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $link=$_POST['link'];
    $qr_code=$_POST['qr_code'];
    $status=$_POST['status'];
    if(empty($_POST['title'])){
        $data['success'] =  0;
        $data['message'] =  "Title is Required";
        echo json_encode($data); 
    }
    if(empty($_POST['description'])){
        $data['success'] =  0;
        $data['message'] =  "Description is Required";
        echo json_encode($data); 
    }
    if(empty($_POST['status'])){
        $data['success'] =  0;
        $data['message'] =  "Status is Required";
        echo json_encode($data); 
    }
    $tempname = $_FILES["banner"]["tmp_name"];    

    if(isset($_FILES["banner"]) && $_FILES["banner"]['size'] > 0 ) {
        $filename = str_replace(' ','_',$_FILES["banner"]["name"]);
        $banner = rand(111,999).basename($filename);
        move_uploaded_file($tempname, 'uploads/'. $banner );
    }

    if($id){

        $sql = "SELECT * FROM tbl_content WHERE id=$id";  
        $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
        if ($result->num_rows <= 0) {
            $data['success'] =  0;
            $data['message'] =  "User does not exist";
            echo json_encode($data); 
            die(0);
        }
        if($permission){
            if (!in_array('Update', $permission)){
                $data['message'] =  "You don't have permssion to Update content";
                echo json_encode($data); 
                die(); 
            }
        }
        
        $query = "update tbl_content set title='$title', description='$description', link='$link', qr_code='$qr_code', status='$status' where id='$id '";
        mysqli_query($connect, $query);
        if($profile_image){
            $query = "update tbl_users set banner='$banner' where id='$id '";
            mysqli_query($connect, $query);
        }
        $data['success'] =  1;
        $data['message'] =  "Data Updated";
    }else{
        if($permission){
            if (!in_array('Add', $permission)){
                $data['message'] =  "You don't have permssion to Add content";
                echo json_encode($data); 
                die(); 
            }
        }
        
        $query = "insert into tbl_content(user_id, title, description, link, banner,qr_code,status) values ('$user_id', '$title', '$description', '$link','$banner', '$qr_code', '$status')";
        mysqli_query($connect, $query);
        $data['success'] =  1;
        $data['message'] =  "Data Inserted";
    }
  
}else{
    $data['success'] =  0;
    $data['message'] =  "method not allowed";
}
echo json_encode($data); 

?>
