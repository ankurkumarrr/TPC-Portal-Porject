<?php
require 'config.php';
session_start();

if(!isset($_SESSION['sess_user'])){
    header('Location: login_company.php');
}

$Email = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from company where Email = '$Email'");
$row = mysqli_fetch_array($result);

$name = $row["Company"];
$email = $row["Email"];
// $CPI = $row["MinCPI"];
// $Std10 = $row["MinStd10"];
// $Std12 = $row["MinStd12"];
// $InterviewMode = $row["InterviewMode"];
// $InterviewType = $row["InterviewType"];


?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>

<center>
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
    <h1> <?php echo "Welcome ".$name; ?> </h1>
    <h2> Profile Details </h2>

    <table>
        <tr>
            <td>Name:       </td>
            <td><?php echo $name; ?></td>
</tr>
        <tr>
            <td>Email:      </td>
            <td><?php echo $email; ?></td>
</tr>
        <!-- <tr>
            <td>Minimum CPI:     </td>
            <td><?php echo $CPI; ?></td>
</tr>
        <tr>
            <td>Minimum 10th Marks:     </td>
            <td><?php echo $Std10 ?></td>
</tr>
        <tr>
            <td>Minimum 12th Marks:     </td>
            <td><?php echo $Std12; ?></td>
</tr>
        <tr>
            <td>Interview Mode:     </td>
            <td><?php echo $InterviewMode; ?></td>
</tr>
        <tr>
            <td>Interview Type:     </td>
            <td><?php echo $InterviewType; ?></td> -->

</tr>
</table>
<br/>

<p class = "top">
    <a href="welcome_company.php"> Back to Main Menu </a><br />

</center>
</body>
</html>