<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $database = "cs260_final";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $database);

    if ($conn -> connect_error){
        printf("Connection failed: ",$conn ->connect_error);
        exit();
    }
    //echo "connection estd";
?>
