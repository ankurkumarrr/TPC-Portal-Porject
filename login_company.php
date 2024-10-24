<?php
require 'config.php';

if(isset($_POST["Submit"])){
    $Email = $_POST["Email"];
    $pass = $_POST["pass"];

    $query1 = "select * from company where Email = '$Email' and Password = '$pass' and isVerified = 1";
    $result1 = mysqli_query($conn, $query1);

    $query2 = "select * from company where Email = '$Email' and Password = '$pass' and isVerified = 0";
    $result2 = mysqli_query($conn, $query2);

    if (mysqli_num_rows($result1) != 0){

        session_start();
        $_SESSION['sess_user'] = $Email;
        header ('Location: welcome_company.php');
    }
    else if(mysqli_num_rows($result2) != 0){
        echo '<script type="text/javascript">alert("Company not Verified by Admin!")</script>';
    }
    else{
        echo '<script type="text/javascript">alert("Invalid Email or Password!")</script>';
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Company Login</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
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
            <a href="index.php">Home</a>
            <a href="Statistics.php">Statistics</a>
        </div>
    </div>
    <p class = "heading">
        <center><h1>Company Login</h1></p>
        <p class = "top">
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="post">
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" required><br><br>

                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required><br><br>

                <button class="form-button" type="submit" value="Company" name = "Submit">Login</button>

                <p class = "top">No credentials yet? <a href="register_company.php">Register Now!</a></p>

            </form>
        </center>
    </p>
</body>
</html>
