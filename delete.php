<?php  
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
		if ($result->num_rows > 0) {
			while($row=mysqli_fetch_assoc($result))
			{
				$permission = explode(',',$row["permission"]);
				if (!in_array('Delete', $permission)){
						$data['message'] =  "You don't have permssion to view content";
						echo json_encode($data); 
						die(); 
				}
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
		$sql = "SELECT * FROM tbl_content WHERE id='".$_POST["id"]."'";  
		$result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
		if ($result->num_rows <= 0) {
			$data['success'] =  0;
			$data['message'] =  "User does not exist";
			echo json_encode($data); 
			die(0);
		}
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