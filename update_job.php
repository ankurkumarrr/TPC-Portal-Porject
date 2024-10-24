<?php
require 'config.php';
session_start();

$jobcode = $_POST["jobcode"];
$position = $_POST['position'];
$city = $_POST['city'];
$ctc = $_POST['ctc'];
$interviewtype = $_POST['interviewtype'];
$interviewmode = $_POST['interviewmode'];
$gender = $_POST['gender'];
$mincpi = $_POST['mincpi'];
$minstd10 = $_POST['minstd10'];
$minstd12 = $_POST['minstd12'];


$sql = "update jobs set CTC = '$ctc' ,InterviewType = '$interviewtype', InterviewMode = '$interviewmode', MinCPI = '$mincpi' , MinStd10 = '$minstd10', MinStd12 = '$minstd12', Gender = '$gender' , Position = '$position' , City = '$city' where jobcode = '$jobcode'";
$result = mysqli_query($conn, $sql);

echo "Your update was successful.<br>
You will be redirected to your dashboard shortly...";
?>

<script>
setTimeout(function() {
    window.location.href = "welcome_company.php";
}, 5000);

</script>