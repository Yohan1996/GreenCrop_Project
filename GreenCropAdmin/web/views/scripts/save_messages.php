<?php
	//Connect to database
	require_once('../../../db/connection.php');

	$name =$_POST['name'];	
	$email = $_POST['email'];
	$message = $_POST['message'];
	$created_date = date("Y-m-d H:i:s");
	
	$INSERT = "INSERT Into site_user_messages(name, email, message, created_date_time) values (?,?,?,?)";

	//Execute insert query
	$stmt = $conn->prepare($INSERT);
	$stmt->bind_param("ssss", $name, $email, $message, $created_date);
	$stmt->execute();
	$error = $stmt->error;
	if($error){
		echo "Failed to insert record. ERROR: ".$error;
	} else{
		echo "New record inserted susccessfully....";
		header('Location: ../contact.php');
		exit;
	}		
	
	//Close database connection
	$stmt->close();
	$conn->close(); 

?>