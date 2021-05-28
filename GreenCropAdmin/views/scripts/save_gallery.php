<?php
	//Connect to Database
	require_once('../../db/connection.php');
	header('Content-Type: application/json');	
	// Initialize the session
	session_start();

	//Check if image file uploaded
	if(isset($_FILES['gallery_file']['name'])) {
		$name = $_FILES['gallery_file']['name'];
		$target_dir = "../../upload/gallery/";
		$target_file = $target_dir . basename($_FILES["gallery_file"]["name"]);
		//Convert image to base64 string
		$image_base64 = base64_encode(file_get_contents($_FILES['gallery_file']['tmp_name']) );
		$image = 'data:image/'.$_FILES["gallery_file"]["name"].';base64,'.$image_base64;
		// Upload file to directory
		move_uploaded_file($_FILES['gallery_file']['tmp_name'],$target_dir.$name);
	}

	$created_by = $_SESSION["user_id"];
	$created_date = date("Y-m-d H:i:s");
	
	$INSERT = "INSERT INTO gallery (image, created_by, created_date_time) VALUES (?,?,?)";

	//Execute insert query
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("sis", $image, $created_by, $created_date);
	$stmt->execute();
	$error = $stmt->error;
	if($error){
		$response['status'] = "error";
    	$response['message'] = "ERROR: ".$error;
	} else{
		$response['status'] = "success";
    	$response['message'] = "Image saved successfully.";
	}   
    echo json_encode($response);
	
	//Close Database Connection
	$stmt->close();
	$conn->close();

?>