<?php  

	include("connection.php");

	$input = json_decode(file_get_contents('php://input'),true);
	$method = $_SERVER['REQUEST_METHOD'];
	if ($method == 'POST') {
		$sql1 = "SELECT * FROM tbl_users WHERE id='".$_POST["id"]."'";  
		$result = mysqli_query($connect, $sql1) or die (mysqli_error($connect));;
		if ($result->num_rows <= 0) {
			$data['success'] =  0;
			$data['message'] =  "User does not exist";
			echo json_encode($data); 
			die(0);
		}
		if(!empty($_POST["id"])){
			$sql = "UPDATE tbl_users set is_deleted=1 WHERE id = '".$_POST["id"]."'";  
			if(mysqli_query($connect, $sql))  
			{  
				$data['message'] =  "Data Deleted";
			}  
		}else{
			$data['message'] =  "Id is Required";
	   	}
		
	}else{
		$data['message'] =  "method not allowed";
   }
   echo json_encode($data); 
 ?>