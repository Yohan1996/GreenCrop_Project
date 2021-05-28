<?php
    //Connect to Database
	require_once('../../db/connection.php');
    header('Content-Type: application/json');	
    
    $id = $_POST['id'];

    $SELECT = "SELECT id FROM gallery WHERE id = ? LIMIT 1";
    $DELETE = "DELETE FROM gallery WHERE id='".$id."'";

    //Execute select query
    $stmt = $conn->prepare($SELECT);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->bind_result($id);
	$stmt->store_result();
    $rnum = $stmt->num_rows;
    
    //Check if image exist
	if ($rnum > 0) { 
        $stmt->close();
        $stmt = $conn->prepare($DELETE);
        $stmt->execute();
        $response['status'] = "success";
        $response['message'] = "Image deleted successfully.";
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