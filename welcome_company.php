<?php
require 'config.php';
session_start();

if(!isset($_SESSION['sess_user'])){
    header('Location: login_company.php');
}

$Email = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from company where email = '$Email'");
$row = mysqli_fetch_array($result);

$name = $row["Company"];



if(isset($_POST["DELETE_ACCOUNT"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/delete_company.php";</script>';

}

if(isset($_POST["ADD_JOB"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/add_job.php";</script>';

}

if(isset($_POST["VIEW_JOB"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/view_job.php";</script>';

}

if(isset($_POST["UPDATE_DELETE_JOB"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/update_delete_jobs.php";</script>';

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
            <a href="welcome_company.php">Main Menu</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <center><p class = "heading">
    <h1> <?php echo "Hello ".$name; ?> </h1></p>
<br/>

<p class = "top">
<a href="profile_company.php"> Profile Details </a><br />
<p class = "top">
<a href="update_company.php"> Update Profile </a><br />
<p class = "top">
<p class = "top">
<form method="post">
        <input type="submit"style="margin-left: 500px;" name="DELETE_ACCOUNT" class="my-button" value="DELETE ACCOUNT" />

        <input type="submit" name= "ADD_JOB" class="my-button" value="ADD A JOB" />

        <input type="submit" name= "VIEW_JOB" class="my-button" value="VIEW ALL JOBS" />
    </form>
</p>
</center>
</body>
</html>