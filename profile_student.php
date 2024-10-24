<?php
require 'config.php';
session_start();

if(!isset($_SESSION['sess_user'])){
    header('Location: login_student.php');
}

$RollNo = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from student where RollNo = '$RollNo'");
$row = mysqli_fetch_array($result);

$result2 = mysqli_query($conn, "select * from marks where RollNo = '$RollNo'");
$row2 = mysqli_fetch_array($result2);

$result3 = mysqli_query($conn, "select * from placement where RollNo = '$RollNo'");
$row3 = mysqli_fetch_array($result3);

$Name = $row["Name"];
$Email = $row["Email"];
$RollNo = $row["RollNo"];
$Gender = $row["Gender"];
$YoE = $row["YoE"];
$Semester = $row["Semester"];
$Specialization = $row["Specialization"];
$AoI = $row["AoI"];
$Placed = $row["Placed"];


$CPI = $row2["CPI"];
$Std10 = $row2["Std10"];
$Std12 = $row2["Std12"];
$Transcript = $row["Transcript"];

$Company = $row3["Company"];
$Position = $row3["Position"];
$City = $row3["City"];
$CTC = $row3["CTC"];
$YoJ = $row3["YoJ"];
$YoL = $row3["YoL"];


?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Profile</title>
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
            <a href="welcome_student.php">Main Menu</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <h1> <?php echo "Welcome ".$Name; ?> </h1>
    <h2> Profile Details </h2>

    <table>
        <tr>
            <td>Name:       </td>
            <td><?php echo $Name; ?></td>
</tr>
        <tr>
            <td>Email:      </td>
            <td><?php echo $Email; ?></td>

</tr>
        <tr>
            <td>Roll Number:      </td>
            <td><?php echo $RollNo; ?></td>
</tr>
        <tr>
            <td>Gender:      </td>
            <td><?php echo $Gender; ?></td>
</tr>

</table>

<h2> Academic Details </h2>

<table>
        <tr>
            <td>Year of Enrollment:      </td>
            <td><?php echo $YoE; ?></td>
</tr>
        <tr>
            <td>Semester:      </td>
            <td><?php echo $Semester; ?></td>
</tr>
        <tr>
            <td>Specialization:      </td>
            <td><?php echo $Specialization; ?></td>
</tr>
        <tr>
            <td>Current CPI:     </td>
            <td><?php echo $CPI; ?></td>
</tr>
        <tr>
            <td>10th Marks:     </td>
            <td><?php echo $Std10 ?></td>
</tr>
        <tr>
            <td>12th Marks:     </td>
            <td><?php echo $Std12; ?></td>
</tr>
        <tr>
            <td>Transcript:     </td>
            <td><a href="<?php echo $Transcript; ?>"> Link </a></td>
</tr>
</table>

<?php
    if ($Placed == "yes"){
        include 'profile_student_placed.php';

    }
?>


<br/>

</center>
</body>
</html>