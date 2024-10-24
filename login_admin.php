<?php
require 'config.php';

if(isset($_POST["Submit"])){
    $Email = $_POST["Email"];
    $pass = $_POST["pass"];

    $query = "select * from company where Email = '$Email' and Password = '$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) != 0){

        session_start();
        $_SESSION['sess_user'] = $Email;
        header ('Location: welcome_admin.php');
    }
    else{
        echo '<script type="text/javascript">alert("Invalid Email or Password!")</script>';
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
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
        <center><h1>Admin Login</h1></p>
        <p class = "top">
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="post">
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" required><br><br>

                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required><br><br>

                <button class="form-button" style="margin-right: 600px;" type="submit" value="Admin" name = "Submit">Login</button>

            </form>
        </center>
    </p>
</body>
</html>
