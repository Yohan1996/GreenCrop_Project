<?php
	//Connect to Database
	require_once('../../db/connection.php');
	header('Content-Type: application/json');
	// Initialize the session
	session_start();	

    $news_id = $_POST['news_id'];
    $news_title =$_POST['unews_title'];
	$news_description = $_POST['unews_description'];
	$news_category = $_POST['unews_category'];

	//Check if new image file uploaded
	if(isset($_FILES['unews_image']['name'])) {  		
		$name = $_FILES['unews_image']['name'];
		$target_dir = "../../upload/news/";
		$target_file = $target_dir . basename($_FILES["unews_image"]["name"]);

		$image_base64 = base64_encode(file_get_contents($_FILES['unews_image']['tmp_name']) );
		$image = 'data:image/'.$_FILES["unews_image"]["name"].';base64,'.$image_base64;
		// Upload file
		move_uploaded_file($_FILES['unews_image']['tmp_name'],$target_dir.$name);
    } 

	$updated_by = $_SESSION["user_id"];
	$updated_date = date("Y-m-d H:i:s");

    $SELECT = "SELECT id FROM news_and_promo WHERE id = ? LIMIT 1";
	
	//Check if new image file uploaded, and set updating params and values accordingly
    if(isset($_FILES['unews_image']['name'])){
        $UPDATE = "UPDATE news_and_promo SET title='$news_title', description='$news_description',
            image='$image', category='$news_category', updated_by='$updated_by', updated_date_time='$updated_date' WHERE id='".$news_id."'";
    } else{
        $UPDATE = "UPDATE news_and_promo SET title='$news_title', description='$news_description',
        category='$news_category', updated_by='$updated_by', updated_date_time='$updated_date' WHERE id='".$news_id."'";
	}
	
	//Execute select query
	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("i", $news_id);
	$stmt->execute();
	$error = $stmt->error;
	if($error){
		$response['status'] = "error";
		$response['message'] = "ERROR: ".$error;
		echo json_encode($response);
	}
	$stmt->bind_result($news_id);
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
        	$response['message'] = "News/Promotion updated successfully.";     
		}      
        echo json_encode($response);
	}  else { 
		$response['status'] = "error";
		$response['message'] = "News/Promotion not found.";
		echo json_encode($response);
	}
	
	//Close Database Connection
	$stmt->close();
	$conn->close();

?>