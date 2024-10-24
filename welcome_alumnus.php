<?php
require 'config.php';
session_start();

if(!isset($_SESSION['sess_user'])){
    header('Location: login_alumnus.php');
}

$RollNo = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from alumnus where RollNo = '$RollNo'");
$row = mysqli_fetch_array($result);

$Name = $row["Name"];



if(isset($_POST["DELETE_ACCOUNT"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/delete_alumnus.php";</script>';

}

// if(isset($_POST["VIEW_JOB"])){
//     echo '<script language="javascript">window.location = "http://localhost/miniproject/student_eligible_jobs.php";</script>';

// }



?>



<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>


<body>
<div class="header">
        <a href="index.php" class="logo">
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
            <a href="welcome_alumnus.php">Main Menu</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <center><p class = "heading">
    <h1> <?php echo "Hello ".$Name; ?> </h1></p>
<br/>

<p class = "top">
<a href="profile_alumnus.php"> Profile Details </a><br />
<p class = "top">
<a href="update_alumnus.php"> Update Profile </a><br />
<p class = "top">
<p class = "top">
<form method="post">
        <input type="submit" style="margin-left: 660px;" name="DELETE_ACCOUNT" class="my-button" value="DELETE ACCOUNT" />


    </form>
</p>
</center>
</body>
</html>