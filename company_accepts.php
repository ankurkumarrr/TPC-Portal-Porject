<?php
require 'config.php';
session_start();

$RollNo = $_POST['rollno'];
$jobcode = $_POST['jobcode'];
$compemail = $_SESSION['sess_user'];

// //job details
$sql = "select * from jobs where jobcode = '$jobcode'";
$result= mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$position = $row["Position"] ;
$city = $row["City"]; 
$ctc =  $row["CTC"] ;

// //company name
$sqltemp = "select * from company where Email = '$compemail'";
$restemp = mysqli_query($conn, $sqltemp);
$rowtemp = mysqli_fetch_assoc($restemp);
$company = $rowtemp["Email"];

$current_year = date('Y');


$sql5 = "update placement set Company = '$compemail', Position = '$position' , City = '$city' , CTC = '$ctc' , YOJ = '$current_year' , YOL = 0, offerct = offerct + 1 where RollNo = '$RollNo'  ";
$result5 = mysqli_query($conn, $sql5);

$sql6 = "update jobs set offerct = offerct + 1 where jobcode = '$jobcode'";
$result6 = mysqli_query($conn, $sql6);

$sql7 = "update student set Placed = \"yes\" where RollNo = '$RollNo'";
$result7 = mysqli_query($conn, $sql7);

$sql = "delete from applied where jobcode = '$jobcode' and studentrollno = '$RollNo' ";
$result= mysqli_query($conn, $sql);

?>