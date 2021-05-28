<?php
	//Connect to Database
	require_once('../../db/connection.php');
	header('Content-Type: application/json');	
	// Initialize the session
	session_start();

	$news_title =$_POST['news_title'];
	$news_description = $_POST['news_description'];
	$news_category = $_POST['news_category'];

	//Check if image file uploaded
	if(isset($_FILES['news_image']['name']))  
	{  		
		$name = $_FILES['news_image']['name'];
		$target_dir = "../../upload/news/";
		$target_file = $target_dir . basename($_FILES["news_image"]["name"]);
		//Convert image to base64 string
		$image_base64 = base64_encode(file_get_contents($_FILES['news_image']['tmp_name']) );
		$image = 'data:image/'.$_FILES["news_image"]["name"].';base64,'.$image_base64;
		// Upload file to directory
		move_uploaded_file($_FILES['news_image']['tmp_name'],$target_dir.$name);
	}

	$created_by = $_SESSION["user_id"];
	$created_date = date("Y-m-d H:i:s");
	
	$INSERT = "INSERT INTO news_and_promo (title, description,
                image, category, created_by, created_date_time) VALUES (?,?,?,?,?,?)";

	//Execute insert query
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("ssssis", $news_title, $news_description,
            $image, $news_category, $created_by, $created_date);
	$stmt->execute();
	$error = $stmt->error;
	if($error){
		$response['status'] = "error";
		$response['message'] = "ERROR: ".$error;
	} else{
		$response['status'] = "success";
    	$response['message'] = "News/Promotion saved successfully.";        
	}
	echo json_encode($response);
	
	//Close Database Connection
	$stmt->close();
	$conn->close();

?>