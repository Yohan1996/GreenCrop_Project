<?php
    //Connect to Database
	require_once('../../db/connection.php');
    header('Content-Type: application/json');	
    
    $id = $_GET['id'];

    //Execute query and get result
    $result = mysqli_query($conn, "SELECT * FROM news_and_promo WHERE id='".$id."'");

    //Check if records exist
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
    }

    //Close Database Connection
    $conn->close();


?>