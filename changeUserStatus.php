<?php  
	include("connection.php");
	$input = json_decode(file_get_contents('php://input'),true);
	$method = $_SERVER['REQUEST_METHOD'];
	if ($method == 'POST') {
		if(!empty($_POST["id"])){
			$sql = "UPDATE tbl_users set `status`='".$_POST["status"]."' WHERE id = '".$_POST["id"]."'";  
			if(mysqli_query($connect, $sql))  
			{  
				$data['message'] =  "Status Change Successfully";
			}  
		}else{
			$data['message'] =  "Id is Required";
	   	}
		
	}else{
		$data['message'] =  "method not allowed";
   }
   echo json_encode($data); 
 ?>