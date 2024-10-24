<?php
require 'config.php';
session_start();

if(!isset($_SESSION['sess_user'])){
    header('Location: login_admin.php');
}

$Email = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from company where Email = '$Email'");
$row = mysqli_fetch_array($result);

$Name = $row["Company"];



if(isset($_POST["DELETE_ACCOUNT"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/delete_admin.php";</script>';

}

if(isset($_POST["VIEW_ALL_JOBS"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/admin_all_jobs.php";</script>';

}

if(isset($_POST["TERMINAL"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/terminal.php";</script>';

}

if(isset($_POST["VERIFY_STUD_REGISTRATIONS"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/verify_student_registration.php";</script>';

}

if(isset($_POST["VERIFY_ALUM_REGISTRATIONS"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/verify_alumnus_registration.php";</script>';

}

if(isset($_POST["VERIFY_COMPANY_REGISTRATIONS"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/verify_company_registration.php";</script>';

}



?>



<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
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
            <a href="welcome_admin.php">Main Menu</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <center><p class = "heading">
    <h1> <?php echo "Hello ".$Name; ?> </h1></p>
<br/>

<form method="post">
        <input type="submit" name="DELETE_ACCOUNT" class="my-button" id="delete" value="DELETE ACCOUNT" />

        <input type="submit" name= "VIEW_ALL_JOBS" class="my-button" id="delete" value="ALL JOBS" />

        <input type="submit" name= "TERMINAL" class="my-button" id="delete" value="TERMINAL" />

        <input type="submit" name= "VERIFY_STUD_REGISTRATIONS" class="my-button" id="delete" value="VERIFY STUDENT REGISTRATIONS" />

        <input type="submit" name= "VERIFY_ALUM_REGISTRATIONS" class="my-button" id="alumnus" value="VERIFY ALUMNUS REGISTRATIONS" />

        <input type="submit" name= "VERIFY_COMPANY_REGISTRATIONS" class="my-button" id="delete" value="VERIFY COMPANY REGISTRATIONS" />

    </form>
</p>
</center>
</body>
</html>