<?php
	require_once('../../db/connection.php');
    header('Content-Type: application/json');	
    //Initialize the session   
    session_start();

    //Check if the user is already logged in, if yes then redirect him to home page
    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true){
        $response['status'] = "success";
        $response['message'] = "Login successful";                 		
        echo json_encode($response);
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = trim($_POST['email']);
        $password = hash("sha512", trim($_POST['password']));
       
        $SELECT = "SELECT id, name, email, password FROM user WHERE email = ?";

        //Execute select query
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $error = $stmt->error;
        if($error){
            $response['status'] = "error";
            $response['message'] = "ERROR: ".$error;
            echo json_encode($response);
        }
        $stmt->bind_result($id, $user_name, $user_email, $user_password);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        
        //Check if user exist
        if ($rnum > 0) { 
            if($stmt->fetch()){  
                //Check if password matching             
                if($password === $user_password){
                    // Store data in session variables
                    $_SESSION["logged_in"] = true;
                    $_SESSION["user_id"] = $id;
                    $_SESSION["user_name"] = $user_name; 
                    $_SESSION["user_email"] = $user_email; 
                   
                    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true){
                        $response['status'] = "success";
                        $response['message'] = "Login successful";                 		
                        echo json_encode($response);
                        exit;
                    }else{
                        $response['status'] = "error";
                        $response['message'] = "Login unsuccessful";                 		
                        echo json_encode($response);
                    }
                }else{
                    $response['status'] = "error";
                    $response['message'] = "Password is incorrect";                 		
                    echo json_encode($response);
                }
            } else{
                $response['status'] = "error";
                $response['message'] = "Login unsuccessful";                 		
                echo json_encode($response);
            }
        } else{
            $response['status'] = "error";
            $response['message'] = "User not found for given credentials";                 		
            echo json_encode($response);
        }

        $stmt->close();
	    $conn->close();
    }

?>