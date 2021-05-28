<?php
    //Connect to Database
	require_once('../../db/connection.php');
    header('Content-Type: application/json');	
    // Initialize the session
    session_start();
    
    $id = $_POST['id'];
	$deleted_by = $_SESSION["user_id"];
	$deleted_date = date("Y-m-d H:i:s");

    $SELECT = "SELECT id FROM products WHERE id = ? LIMIT 1";
    $DELETE = "UPDATE products SET is_deleted=1, deleted_by='$deleted_by', deleted_date_time='$deleted_date' WHERE id='".$id."'";

    //Execute select query
    $stmt = $conn->prepare($SELECT);
	$stmt->bind_param("i", $id);
    $stmt->execute();
    $error = $stmt->error;
    if($error){
        $response['status'] = "error";
        $response['message'] = "ERROR: ".$error;
        echo json_encode($response);
    }
	$stmt->bind_result($id);
	$stmt->store_result();
    $rnum = $stmt->num_rows;
    
    //Check if record exist
	if ($rnum > 0) { 
        $stmt->close();
        //Execute delete query
        $stmt = $conn->prepare($DELETE);
        $stmt->execute();
        $error = $stmt->error;
        if($error){
            $response['status'] = "error";
            $response['message'] = "ERROR: ".$error;
            echo json_encode($response);
        } else {
            $response['status'] = "success";
            $response['message'] = "Product deleted successfully.";
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