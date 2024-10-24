<?php
require 'config.php';
session_start();

$RollNo = $_POST['rollno'];
$jobcode = $_POST['jobcode'];
$compemail = $_SESSION['sess_user'];

//job details
$sql = "delete from applied where jobcode = '$jobcode' and studentrollno = '$RollNo' ";
$result= mysqli_query($conn, $sql);

?>