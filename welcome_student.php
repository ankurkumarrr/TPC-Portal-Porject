<?php
require 'config.php';
session_start();

if(!isset($_SESSION['sess_user'])){
    header('Location: login_student.php');
}

$RollNo = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from student where RollNo = '$RollNo'");
$row = mysqli_fetch_array($result);

$Name = $row["Name"];



if(isset($_POST["DELETE_ACCOUNT"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/delete_student.php";</script>';

}

if(isset($_POST["VIEW_JOB"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/student_eligible_jobs.php";</script>';

}



?>



<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>


<body>
<div class="header">
        <a  class="logo">
            <div class="header-left">
                <img src="IITP_Logo.png" alt="IIT Patna Logo" width="70px" height="70px">
            </div>
            <div class="header-text">
                Training and Placement Cell
            </div>
            <div class="header-text1">
                IIT Patna
            </div>
        </a>
        <div class="header-right">
            <a href="welcome_student.php">Main Menu</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <center><p class = "heading">
    <h1> <?php echo "Hello ".$Name; ?> </h1></p>
<br/>

<p class = "top">
<a href="profile_student.php"> Profile Details </a><br />
<p class = "top">
<a href="update_student.php"> Update Profile </a><br />

<form method="post">
        <input type="submit" style="margin-left: 550px;" name="DELETE_ACCOUNT" class="my-button" value="DELETE ACCOUNT" />

        <input type="submit" name= "VIEW_JOB" class="my-button" value="VIEW JOBS" />

    </form>
</p>
</center>
</body>
</html>