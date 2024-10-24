<?php 
require 'config.php';
session_start();

$Email = $_GET["Email"];
$sql= "select * from company where Email = '$Email'";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

if(isset($_POST["ACCEPT"])){
    $query1 = "update company set isVerified = 1 where Email = '$Email'";
    $result1 = mysqli_query($conn, $query1);

    if($result1){
        echo '<script type="text/javascript">alert("Registration Accepted!")</script>';
        echo '<script language="javascript">window.location = "http://localhost/miniproject/verify_company_registration.php";</script>';
    }

}

if(isset($_POST["REJECT"])){

    $query2 = "delete from company where Email = '$Email'";
    $result2 = mysqli_query($conn, $query2);

    if($result2){
        echo '<script type="text/javascript">alert("Registration Rejected, Data of User wiped!")</script>';
        echo '<script language="javascript">window.location = "http://localhost/miniproject/verify_company_registration.php";</script>';
    }

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Company Verification</title>
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
