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
     if ($result->num_rows <= 0) {
        $data['message'] =  "unauthanticated";
        echo json_encode($data); 
        die();
     }
}

$input = json_decode(file_get_contents('php://input'),true);
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
   
    $id=$_POST['id'];
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'] ? md5($_POST['password']) : "";
    $flag=$_POST['flag'];
    $permission=$_POST['permission'] ? implode(',',$_POST['permission']) : "";

    if(empty($flag)){
        if(empty($_POST['id'])){
            $data['success'] =  0;
            $data['message'] =  "ID is Required";
            echo json_encode($data); 
            die(0);
        }
    }
    if(empty($_POST['fullname'])){
        $data['success'] =  0;
        $data['message'] =  "Fullname is Required";
        echo json_encode($data); die(0);
    }
    if(empty($_POST['email'])){
        $data['success'] =  0;
        $data['message'] =  "Email is Required";
        echo json_encode($data); 
        die(0);
    }
    $profile_image = "";
    $tempname = $_FILES["profile_image"]["tmp_name"];    

    if(isset($_FILES["profile_image"]) && $_FILES["profile_image"]['size'] > 0 ) {
        $filename = str_replace(' ','_',$_FILES["profile_image"]["name"]);
        $profile_image = rand(111,999).basename($filename);
        move_uploaded_file($tempname, 'uploads/'. $profile_image);
        
    }
    if($id){

        $sql = "SELECT * FROM tbl_users WHERE email= '".$email."' AND id != $id AND is_deleted=0";  
        $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
        if ($result->num_rows > 0) {
            $data['success'] =  0;
            $data['message'] =  "Email already exist";
            echo json_encode($data); 
            die(0);
        }
   
        if($flag == 1){
            $query = "update tbl_users set fullname='$fullname', email='$email' where id='$id'";
            mysqli_query($connect, $query);
            if($profile_image) {
                $query = "update tbl_users set profile_image='$profile_image' where id='$id '";
                mysqli_query($connect, $query);
            }
            if($permission){
                $query = "update tbl_users set permission='$permission' where id='$id '";
                mysqli_query($connect, $query);
            }
            
        }else{

            $sql = "SELECT * FROM tbl_users WHERE id=$id";  
            $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
            if ($result->num_rows <= 0) {
                $data['success'] =  0;
                $data['message'] =  "User does not exist";
                echo json_encode($data); 
                die(0);
            }
            
            $query = "update tbl_users set fullname='$fullname', email='$email' where id='$id '";
            if($profile_image) {
                $query = "update tbl_users set profile_image='$profile_image' where id='$id '";
                mysqli_query($connect, $query);
            }
            mysqli_query($connect, $query);
        }
        if($password){
            $query = "update tbl_users set password='$password' where id='$id '";
            mysqli_query($connect, $query);
        }
       
        mysqli_query($connect, $query);
        $data['success'] =  1;
        $data['message'] =  "Data Updated";
    }else{
        $sql = "SELECT * FROM tbl_users WHERE email='$email' AND is_deleted=0";  
        $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
        if ($result->num_rows > 0) {
            $data['success'] =  0;
            $data['message'] =  "Email already exist";
            echo json_encode($data); 
            die(0);
        }

        if($flag == 1){
            $query = "insert into tbl_users(fullname, email, password, profile_image, permission) values ('$fullname', '$email', '$password','$profile_image','$permission')";

            mysqli_query($connect, $query);

            $data['success'] =  1;
            $data['message'] =  "Data Inserted";

        }else{
            $data['success'] =  0;
            $data['message'] =  "method not allowed";
        }
    }
  
}else{
    $data['success'] =  0;
    $data['message'] =  "method not allowed";
}
echo json_encode($data); 
die(0);

?>
