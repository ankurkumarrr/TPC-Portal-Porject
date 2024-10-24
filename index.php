<?php
require 'config.php';

if(isset($_POST["Student"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/login_student.php";</script>';
}

if(isset($_POST["Alumnus"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/login_alumnus.php";</script>';
}

if(isset($_POST["Company"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/login_company.php";</script>';
}

if(isset($_POST["Stats"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/Statistics.php";</script>';
}

if(isset($_POST["Admin"])){
    echo '<script language="javascript">window.location = "http://localhost/miniproject/login_admin.php";</script>';
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>TPC Portal</title>
    <link rel="stylesheet" href="styles_homepage.css?v=<?php echo time(); ?>">
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
            <a href="about_us.php">About Us</a>
        </div>
    </div>
    <p class = "heading">
        <center>
            <h1>Welcome to IIT Patna TPC Portal!</h1></p>

            <h2>Please navigate according to your need.</h2>
            <p class = "top">
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="post">
                <button class="my-button" type="submit" value="Student" name = "Student">Student Login</button>

                <button class="my-button" type="submit" value="Alumnus" name = "Alumnus">Alumnus Login</button>

                <button class="my-button" type="submit" value="Company" name = "Company">Company Login</button>

                <button class="my-button" type="submit" value="Admin" name = "Admin">Admin</button>
            </form>
        </center>
    </p>
</body>
</html>
