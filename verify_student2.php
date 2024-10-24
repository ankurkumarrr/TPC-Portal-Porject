<?php 
require 'config.php';
session_start();

$RollNo = $_GET["RollNo"];
$sql= "select * from student where RollNo = '$RollNo'";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

if(isset($_POST["ACCEPT"])){
    $query1 = "update student set isVerified = 1 where RollNo = '$RollNo'";
    $result1 = mysqli_query($conn, $query1);

    if($result1){
        echo '<script type="text/javascript">alert("Registration Accepted!")</script>';
        echo '<script language="javascript">window.location = "http://localhost/miniproject/verify_student_registration.php";</script>';
    }

}

if(isset($_POST["REJECT"])){

    $query2 = "delete from student where RollNo = '$RollNo'";
    $result2 = mysqli_query($conn, $query2);

    if($result2){
        echo '<script type="text/javascript">alert("Registration Rejected, Data of User wiped!")</script>';
        echo '<script language="javascript">window.location = "http://localhost/miniproject/verify_student_registration.php";</script>';
    }

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Verification</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<form method="post">
        <input type="submit" name="ACCEPT" class="my-button" value="ACCEPT" />

        <input type="submit" name= "REJECT" class="my-button" value="REJECT" />

    </form>
</p>



</body>
</html>
