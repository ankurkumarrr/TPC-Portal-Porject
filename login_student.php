<?php
require 'config.php';

if(isset($_POST["Submit"])){
    $RollNo = $_POST["RollNo"];
    $pass = $_POST["pass"];

    $query1 = "select * from student where RollNo = '$RollNo' and Password = '$pass' and isVerified = 1";
    $result1 = mysqli_query($conn, $query1);

    $query2 = "select * from student where RollNo = '$RollNo' and Password = '$pass' and isVerified = 0";
    $result2 = mysqli_query($conn, $query2);


    if (mysqli_num_rows($result1) != 0){

        session_start();
        $_SESSION['sess_user'] = $RollNo;
        header ('Location: welcome_student.php');
    }
    else if(mysqli_num_rows($result2) != 0){
        echo '<script type="text/javascript">alert("User not Verified by Admin!")</script>';
    }
    else{
        echo '<script type="text/javascript">alert("Invalid Email or Password!")</script>';
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Login</title>
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
        <center><h1>Student Login</h1></p>
        <p class = "top">
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="post">
                <label for="RollNo">Roll Number:</label>
                <input type="text" id="RollNo" name="RollNo" required><br><br>

                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required><br><br>
                <button class="form-button" type="submit" value="Login" name = "Submit">Login</button>
                
                <p class = "top">No credentials yet? <a href="register_student.php">Register Now!</a></p>


            </form><br> 


        </center>
    </p>
</body>
</html>
