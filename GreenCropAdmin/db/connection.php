<?php
    date_default_timezone_set('Asia/Colombo');

    $host = "localhost";
    $dbusername = "root";
    $dbpassword ="";
    $dbname = "greencrop";
    
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if (mysqli_connect_error()) { 
        die(['Connect Error ('.mysqli_connect_errno ().')'. mysqli_connect_error()]);
    }
    
?>