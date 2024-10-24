<?php
require 'config.php';
session_start();

session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
    <link rel="stylesheet" href="styles.css">
</head>


<body>
    <p class = "heading">
    <center><p class = "top"> You have been logged out</p>
    <a href="index.php"><p>Link to  Homepage.</a>
</center>
</body>
</html>