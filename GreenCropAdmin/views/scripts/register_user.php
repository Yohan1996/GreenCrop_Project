<?php
	//Connect to Database
	require_once('../../db/connection.php');
	header('Content-Type: application/json');	

	$name =$_POST['name'];
	$email = $_POST['email'];
	$password = hash("sha512", $_POST['password']);
	$created_date = date("Y-m-d H:i:s");

	$SELECT = "SELECT email FROM user WHERE email = ? LIMIT 1"; 	
	$INSERT = "INSERT INTO user(name, email, password, created_date_time) VALUES (?,?,?,?)";

	//Execute select query
	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$error = $stmt->error;
	if($error){
		$response['status'] = "error";
		$response['message'] = "ERROR: ".$error;
		echo json_encode($response);
	}
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum = $stmt->num_rows;
	
	//Check if email exist
	if ($rnum ==0) { 
		$stmt->close();
		//Execute insert query
		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param("ssss", $name, $email, $password, $created_date);
		$stmt->execute();
		$error = $stmt->error;
		if($error){
			$response['status'] = "error";
			$response['message'] = "ERROR: ".$error;
		} else{
			$response['status'] = "success";
			$response['message'] = "User registered successfully.";      
		}		
		echo json_encode($response);
	}  else { 
		$response['status'] = "error";
		$response['message'] = "Email already exists.";
		echo json_encode($response);
	}
	
	//Close Database Connection
	$stmt->close();
	$conn->close();

?>