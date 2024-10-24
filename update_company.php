<?php
require 'config.php';
session_start();

if (!isset($_SESSION['sess_user'])) {
	header("location: login_company.php");
}
$Email = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from company where Email = '$Email'");
$row = mysqli_fetch_array($result);



$Name = $row["Company"];
$pass = $row["Password"];

if (isset($_POST['Submit'])){
    $Name = $_POST["Name"];
    $new_pass1 = $_POST["pass1"];
    $new_pass2 = $_POST["pass2"];

    $number = preg_match('@[0-9]@', $new_pass1);         //password strength
    $uppercase = preg_match('@[A-Z]@', $new_pass1);
    $lowercase = preg_match('@[a-z]@', $new_pass1);
    $specialChars = preg_match('@[^\w]@', $new_pass1);

    if($new_pass1 != $new_pass2){
        echo '<script type="text/javascript">alert("Passwords Dont Match!")</script>';
    }
        else{
            if(strlen($new_pass1) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                echo '<script type="text/javascript">alert("Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.")</script>';
            }
            else{
                $query = "update company set Company = '$Name', Password = '$new_pass1' where Email = $Email";
                $result = mysqli_query($conn, $query);

                if($result){
                    echo '<script type="text/javascript">alert("Updated Successfully! Logging you out.")</script>';
                    echo '<script language="javascript">window.location = "http://localhost/miniproject/logout.php";</script>';
                }
                else{
                    echo '<script type="text/javascript">alert("Error!")</script>';
                }
            }
        }
    }


?>


<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
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
	<?php if (isset($error)): ?>
		<p><?php echo $error; ?></p>
	<?php endif; ?>

    <center>
        <p class = "heading">
            <h1>Update Profile</h1>
    </p>
        <p class = "top">
	<form action="" method="post">
		<label for="Name">Company Name:</label>
		<input type="text" id="Name" name="Name" value = "<?php echo $Name ?>" required><br><br>

        <label for="Password1">Password:</label>
		<input type="text" id="Password1" name="pass1" value = "<?php echo $pass ?>" required><br><br>

        <label for="Password2">Confirm Password:</label>
		<input type="text" id="Password2" name="pass2" value = "<?php echo $pass ?>" required><br><br>

        <p>
        <input type="submit" name="Submit" class="form-button" value="Update Details" /><br><br>
    </p>
    </form>
    </center><br>


    <center>
        <p>
    <a href="welcome_company.php"> Back to Main Menu </a><br />


</body>

</html>