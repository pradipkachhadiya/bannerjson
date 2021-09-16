<?php  
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include("connection.php");

$input = json_decode(file_get_contents('php://input'),true);
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
   
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $link=$_POST['link'];
    $qr_code=$_POST['qr_code'];
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
    
    $tempname = $_FILES["banner"]["tmp_name"];    

    if(isset($_FILES["banner"])) {
        move_uploaded_file($tempname, 'uploads/'. $_FILES["banner"]['name']);
        $banner = basename($_FILES["banner"]["name"]);
    }

   
    if($id){
        $query = "update tbl_content set title='$title', description='$description', link='$link', banner='$banner', qr_code='$qr_code' where id='$id '";
        mysqli_query($connect, $query);
        $data['success'] =  1;
        $data['message'] =  "Data Updated";
    }else{
        $query = "insert into tbl_content(title, description, link, banner,qr_code) values ('$title', '$description', '$link','$banner', '$qr_code')";
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
