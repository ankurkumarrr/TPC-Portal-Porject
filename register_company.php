<?php
require 'config.php';

if(isset($_POST["Submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];

    // $CPI = $_POST["CPI"];
    // $Std10 = $_POST["Std10"];
    // $Std12 = $_POST["Std12"];

    // $InterviewMode = $_POST["InterviewMode"];
    // $InterviewType = $_POST["InterviewType"];



    $number = preg_match('@[0-9]@', $pass1);         //password strength
    $uppercase = preg_match('@[A-Z]@', $pass1);
    $lowercase = preg_match('@[a-z]@', $pass1);
    $specialChars = preg_match('@[^\w]@', $pass1);

    if($pass1 != $pass2){
        echo '<script type="text/javascript">alert("Passwords Dont Match!")</script>';
    }
        else{
            if(strlen($pass1) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                echo '<script type="text/javascript">alert("Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.")</script>';
              }
              else {
                $query = "select * from company where Email = '$email'";        //check for existing user
                $result = mysqli_query($conn, $query);
    
                if (mysqli_num_rows($result)>0){
                    echo '<script type="text/javascript">alert("User already exists! \n Please Login.")</script>';
                }
                    else{
                        $query1 = "insert into company values('$name', '$email', '$pass1', 0)";      // insert into table if no issues
                        $result1 = mysqli_query($conn, $query1);

                        if($result1){
                            echo '<script type="text/javascript">alert("User Registered Succesfully!")</script>';
                            echo '<script language="javascript">window.location = "http://localhost/miniproject/login_company.php";</script>';
                        }
                        else{
                            echo '<script type="text/javascript">alert("Error!")</script>';
                        }
                    }
                }
              }

    }


?>
<!DOCTYPE html>
<html>
<head>
	<title>Company Registration</title>
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
        <center><h1>Company Registration</h1></p>

    <p class = "top">
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="post">

                <label for="Name">Name:</label>
                <input type="text" id="Name" name="name" required><br><br>

                <label for="Email">Email Address:</label>
                <input type="email" id="Email" name="email" required><br><br>

                <label for="Password1">Password:</label>
                <input type="password" id="Password1" name="pass1"  required><br><br>

                <label for="Password2">Re-Enter Password:</label>
                <input type="password" id="Password2" name="pass2"  required><br><br>

                <!-- <label for="CPI">Minimum CPI:</label>
                <input type="number" step="any" id="CPI" name="CPI"  required><br><br>

                <label for="Std10">Minimum 10th Marks (%):</label>
                <input type="number" step="any" id="Std10" name="Std10" min="0" max="100" required><br><br>

                <label for="Std11">Minimum 12th Marks (%):</label>
                <input type="number" step="any" id="Std12" name="Std12" min="0" max="100" required><br><br>

                <label for="InterviewMode">Interview Mode:</label>
                <select id="InterviewMode" name="InterviewMode">
                <option value="Online">Online</option>
                <option value="Offline">Offline</option>
                </select> 
                
                <label for="InterviewType">Interview Type:</label>
                <select id="InterviewType" name="InterviewType">
                <option value="Written">Written</option>
                <option value="Interview">Interview</option>
                </select>  -->


                <button class="form-button" type="submit" value="Register" name = "Submit">Register</button>


                <p class = "top">Already a user? <a href="login_company.php">Login</a>

            </form>
        </center>
    </p>
</body>
</html>
