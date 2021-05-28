<?php
	//Connect to Database
	require_once('../../db/connection.php');
	header('Content-Type: application/json');
	// Initialize the session
	session_start();	

	$product_name =$_POST['product_name'];
	$product_description = $_POST['product_description'];
	$product_currency = $_POST['product_currency'];
	$product_price =$_POST['product_price'];
	$product_category = $_POST['product_category'];
	
	//Check if is_rental checkbox is checked
	if(isset($_POST['product_is_rental']))  {
		$product_is_rental =$_POST['product_is_rental'];
	} else{
		$product_is_rental = 0;
	}

	//Check if rental period exist
	if(isset( $_POST['product_rental_period']))  {
		$product_rental_period = $_POST['product_rental_period'];
	} else{
		$product_rental_period = null;
	}

	//Check if image file uploaded
	if(isset($_FILES['product_image']['name'])) {  		
		$name = $_FILES['product_image']['name'];
		$target_dir = "../../upload/products/";
		$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
		//Convert image to base64 string
		$image_base64 = base64_encode(file_get_contents($_FILES['product_image']['tmp_name']) );
		$image = 'data:image/'.$_FILES["product_image"]["name"].';base64,'.$image_base64;
		// Upload file to directory
		move_uploaded_file($_FILES['product_image']['tmp_name'],$target_dir.$name);
	}

	$created_by = $_SESSION["user_id"];;
	$created_date = date("Y-m-d H:i:s");

	$SELECT = "SELECT name FROM products WHERE name = ? LIMIT 1"; 	
	$INSERT = "INSERT INTO products(name, description, currency, price, 
		image, category, for_rental, rental_period, created_by, created_date_time) VALUES (?,?,?,?,?,?,?,?,?,?)";
	
	//Execute select query
	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("s", $product_name);
	$stmt->execute();
	$error = $stmt->error;
	if($error){
		$response['status'] = "error";
		$response['message'] = "ERROR: ".$error;
		echo json_encode($response);
	}
	$stmt->bind_result($product_name);
	$stmt->store_result();
	$rnum = $stmt->num_rows;
	
	//Check if record exist
	if ($rnum ==0) { 
		$stmt->close();
		//Execute insert query
		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param("sssissisis", $product_name, $product_description, $product_currency, $product_price, 
				$image, $product_category, $product_is_rental, $product_rental_period, $created_by, $created_date);
		$stmt->execute();
		$error = $stmt->error;
		if($error){
			$response['status'] = "error";
			$response['message'] = "ERROR: ".$error;
		} else{
			$response['status'] = "success";
			$response['message'] = "Product saved successfully.";      
		}		
		echo json_encode($response);
	}  else { 
		$response['status'] = "error";
		$response['message'] = "Product name already exists.";
		echo json_encode($response);
	}
	
	//Close Database Connection
	$stmt->close();
	$conn->close();

?>