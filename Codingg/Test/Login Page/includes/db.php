<?php
    $serverName = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dbName = "login_page";

    $conn = new mysqli($serverName, $dBUsername, $dBPassword, $dbName);

    if($conn->connect_error){
        die("Connect failed: " . $conn->connect_error);
    }
?>