<?php
	//Connect to Database
	require_once('../../db/connection.php');
	header('Content-Type: application/json');
	// Initialize the session
	session_start();	

    $image_id = $_POST['image_id'];

	//Check if new image file uploaded
	if(isset($_FILES['ugallery_file']['name'])) {  		
		$name = $_FILES['ugallery_file']['name'];
		$target_dir = "../../upload/gallery/";
		$target_file = $target_dir . basename($_FILES["ugallery_file"]["name"]);
		//Convert image to base64 string
		$image_base64 = base64_encode(file_get_contents($_FILES['ugallery_file']['tmp_name']) );
		$image = 'data:image/'.$_FILES["ugallery_file"]["name"].';base64,'.$image_base64;
		// Upload file to directory
		move_uploaded_file($_FILES['ugallery_file']['tmp_name'],$target_dir.$name);
    } 

	$updated_by = $_SESSION["user_id"];
	$updated_date = date("Y-m-d H:i:s");

    $SELECT = "SELECT id FROM gallery WHERE id = ? LIMIT 1";
	
	//Check if new image file uploaded
    if(isset($_FILES['ugallery_file']['name'])){
        $UPDATE = "UPDATE gallery SET image='$image', updated_by='$updated_by', updated_date_time='$updated_date' WHERE id='".$image_id."'";
	} 

	//Execute select query
	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("i", $image_id);
	$stmt->execute();
	$error = $stmt->error;
	if($error){
		$response['status'] = "error";
		$response['message'] = "ERROR: ".$error;
		echo json_encode($response);
	}
	$stmt->bind_result($image_id);
	$stmt->store_result();
    $rnum = $stmt->num_rows;
	
	//Check if record exist
	if ($rnum > 0) {              
		$stmt->close();
		//Execute update query
        $stmt = $conn->prepare($UPDATE);
		$stmt->execute();
		$error = $stmt->error;
		if($error){
			$response['status'] = "error";
			$response['message'] = "ERROR: ".$error;
		} else{
			$response['status'] = "success";
			$response['message'] = "Image updated successfully.";    
		}      
        echo json_encode($response);
	}  else { 
		$response['status'] = "error";
		$response['message'] = "Image not found.";
		echo json_encode($response);
	}
	
	//Close Database Connection
	$stmt->close();
	$conn->close();

?>