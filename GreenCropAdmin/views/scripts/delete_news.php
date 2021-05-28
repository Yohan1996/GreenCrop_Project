<?php
    //Connect to Database
	require_once('../../db/connection.php');
    header('Content-Type: application/json');	
    
    $id = $_POST['id'];

    $SELECT = "SELECT id FROM news_and_promo WHERE id = ? LIMIT 1";
    $DELETE = "DELETE FROM news_and_promo WHERE id='".$id."'";

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
        } else{
            $response['status'] = "success";
            $response['message'] = "News/Promotion deleted successfully.";          
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