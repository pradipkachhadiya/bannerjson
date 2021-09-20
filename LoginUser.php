<?php  
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include("connection.php");

$input = json_decode(file_get_contents('php://input'),true);
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    $flag=$_POST['flag'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    if(empty($_POST['email'])){
        $data['success'] =  0;
        $data['message'] =  "Email is Required";
        echo json_encode($data); 
        die(0);
    }

    if(empty($_POST['password'])){
        $data['success'] =  0;
        $data['message'] =  "Password is Required";
        echo json_encode($data); die(0);
    }
    if($email == 'admin@gmail.com'){
        $sql = "SELECT * FROM tbl_users WHERE email='".$email."' AND password='".$password."'";  
    }else{
        $sql = "SELECT * FROM tbl_users WHERE email='".$email."' AND password='".md5($password)."'";  
    }
    
    $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));
    if($flag == 1){
        if ($result->num_rows > 0) {
            while($row=mysqli_fetch_assoc($result))
            {
                $status = $row['status'];
                $_SESSION["id"] = $row['id'];
                $_SESSION["role"] = $row['role'];
                $_SESSION["fullname"] = $row['fullname'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["profile_image"] = $row['profile_image'];
                $_SESSION["permission"] = $row['permission'];
                $_SESSION["is_login"] = 1;
            }
            if($status == 1){
                $data['success'] =  1;
                $data['message'] =  "Login Successfully";
            }else{
                $data['success'] =  0;
                $data['message'] =  "Your account is blocked by admin.";
            }
           
        }else{
            $data['success'] =  0;
            $data['message'] =  "Incorrect email or password";
        }
    }else{
        if ($result->num_rows > 0) {
            while($row=mysqli_fetch_assoc($result))
            {
                $status = $row['status'];
            }
            if($status == 1){
                $data['token'] =  md5( $email );
                $data['success'] =  1;
                $data['message'] =  "Login Successfully";
            }else{
                $data['success'] =  0;
                $data['message'] =  "Your account is blocked by admin.";
            }
            
        }else{
            $data['success'] =  0;
            $data['message'] =  "Incorrect email or password";
        }
    }
    
}else{
    $data['success'] =  0;
    $data['message'] =  "method not allowed";
}
echo json_encode($data); 
die(0);

?>
