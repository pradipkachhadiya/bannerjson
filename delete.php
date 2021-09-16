<?php  
	include("connection.php");
	$input = json_decode(file_get_contents('php://input'),true);
	$method = $_SERVER['REQUEST_METHOD'];
	if ($method == 'POST') {
		if(!empty($_POST["id"])){
			$sql = "UPDATE tbl_content set is_deleted=1 WHERE id = '".$_POST["id"]."'";  
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