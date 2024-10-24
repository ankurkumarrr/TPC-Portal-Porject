<?php
require 'config.php';
session_start();

$RollNo = $_SESSION['sess_user'];
$jobcode = $_POST['jobcode'];

$sql5 = "delete from applied where studentrollno = '$RollNo' and jobcode = '$jobcode'";
$result5 = mysqli_query($conn, $sql5);

?>