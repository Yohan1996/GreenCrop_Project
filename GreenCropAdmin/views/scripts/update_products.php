<?php
	//Connect to Database
	require_once('../../db/connection.php');
	header('Content-Type: application/json');
	// Initialize the session
	session_start();	

    $product_id = $_POST['product_id'];
	$product_name = $_POST['uproduct_name'];
	$product_description = $_POST['uproduct_description'];
	$product_currency = $_POST['uproduct_currency'];
	$product_price = $_POST['uproduct_price'];
	$product_category = $_POST['uproduct_category'];
	
	//Check if is_rental checkbox is checked
	if(isset($_POST['uproduct_is_rental']))  {
		$product_is_rental = $_POST['uproduct_is_rental'];
	} else{
		$product_is_rental = 0;
	}

	//Check if rental period exist
	if(isset( $_POST['uproduct_rental_period']))  {
		$product_rental_period = $_POST['uproduct_rental_period'];
	} else{
		$product_rental_period = null;
	}

	//Check if new image file uploaded
	if(isset($_FILES['uproduct_image']['name'])) {  		
		$name = $_FILES['uproduct_image']['name'];
		$target_dir = "../../upload/products/";
		$target_file = $target_dir . basename($_FILES["uproduct_image"]["name"]);
		//Convert image to base64 string
		$image_base64 = base64_encode(file_get_contents($_FILES['uproduct_image']['tmp_name']) );
		$image = 'data:image/'.$_FILES["uproduct_image"]["name"].';base64,'.$image_base64;
		// Upload file to directory
		move_uploaded_file($_FILES['uproduct_image']['tmp_name'],$target_dir.$name);
    } 

	$updated_by = $_SESSION["user_id"];
	$updated_date = date("Y-m-d H:i:s");

    $SELECT = "SELECT id FROM products WHERE id = ? LIMIT 1";    
    $SELECT_NAME = "SELECT name FROM products WHERE name = ? AND id != '".$product_id."' LIMIT 1"; 
	
	//Check if new image file uploaded, and set updating params and values accordingly
    if(isset($_FILES['uproduct_image']['name'])){
        $UPDATE = "UPDATE products SET name='$product_name', description='$product_description', currency='$product_currency', price='$product_price', 
            image='$image', category='$product_category', for_rental='$product_is_rental', rental_period='$product_rental_period', updated_by='$updated_by', updated_date_time='$updated_date' WHERE id='".$product_id."'";
    } else{
        $UPDATE = "UPDATE products SET name='$product_name', description='$product_description', currency='$product_currency', price='$product_price', 
        category='$product_category', for_rental='$product_is_rental', rental_period='$product_rental_period', updated_by='$updated_by', updated_date_time='$updated_date' WHERE id='".$product_id."'";
	}
	
	//Execute select query
	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("i", $product_id);
	$stmt->execute();
	$error = $stmt->error;
	if($error){
		$response['status'] = "error";
		$response['message'] = "ERROR: ".$error;
		echo json_encode($response);
	}
	$stmt->bind_result($product_id);
	$stmt->store_result();
    $rnum = $stmt->num_rows;
	
	//Check if record exist
	if ($rnum > 0) {        
        $stmt = $conn->prepare($SELECT_NAME);
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
        
        if ($rnum > 0) { 
            $response['status'] = "error";
            $response['message'] = "Product name already exists.";
            echo json_encode($response);
        } else {
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
            	$response['message'] = "Product updated successfully.";    
			}           
            echo json_encode($response);
        }
	}  else { 
		$response['status'] = "error";
		$response['message'] = "Product not found.";
		echo json_encode($response);
	}
	
	//Close Database Connection
	$stmt->close();
	$conn->close();

?>