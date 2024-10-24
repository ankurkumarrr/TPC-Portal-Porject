<?php
require 'config.php';

function endsWith($string, $smol)
{
  $len = strlen($smol);
  if ($len == 0) {
    return true;
  }
  return substr($string, -$len) === $smol;
}

session_start();

if (!isset($_SESSION['sess_user'])) {
	header("location: login_alumnus.php");
}
$RollNo = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from alumnus where RollNo = '$RollNo'");
$row = mysqli_fetch_array($result);

$result2 = mysqli_query($conn, "select * from marks where RollNo = '$RollNo'");
$row2 = mysqli_fetch_array($result2);

$result3 = mysqli_query($conn, "select * from placement where RollNo = '$RollNo'");
$row3 = mysqli_fetch_array($result3);

$Name = $row["Name"];
$Email = $row["Email"];
$RollNo = $row["RollNo"];
$Pass= $row["Password"];
$Gender = $row["Gender"];
$YoE = $row["YoE"];
$Specialization = $row["Specialization"];


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

if (isset($_POST['Submit'])){
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $new_pass1 = $_POST["pass1"];
    $new_pass2 = $_POST["pass2"];

    $Gender = $_POST["Gender"];
    $YoE = $_POST["YoE"];
    $Specialization = $_POST["Specialization"];

    $CPI = $_POST["CPI"];
    $Std10 = $_POST["Std10"];
    $Std12 = $_POST["Std12"];

    $Company = $_POST["company"];
    $City = $_POST["city"];
    $Position = $_POST["position"];
    $Salary = $_POST["salary"];
    $YoJ = $_POST["YoJ"];
    $YoL = $_POST["YoL"];

    $number = preg_match('@[0-9]@', $new_pass1);         //password strength
    $uppercase = preg_match('@[A-Z]@', $new_pass1);
    $lowercase = preg_match('@[a-z]@', $new_pass1);
    $specialChars = preg_match('@[^\w]@', $new_pass1);

    if($new_pass1 != $new_pass2){
        echo '<script type="text/javascript">alert("Passwords Dont Match!")</script>';
    }
    else{
        if(!endsWith($Email, '@iitp.ac.in')){           //email should have iitp.ac.in
            echo '<script type="text/javascript">alert("Enter IIT Patna email only!")</script>';
        }
            else{
                if(strlen($new_pass1) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                    echo '<script type="text/javascript">alert("Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.")</script>';
                }
                else{
                    $query1 = "update alumnus set Email = '$Email', Password = '$new_pass1', Gender = '$Gender', YoE = '$YoE', Specialization = '$Specialization' where RollNo = '$RollNo'";
                    $result1 = mysqli_query($conn, $query1);

                        $query2 = "update placement set Company = '$Company', Position = '$Position', City = '$City', CTC = '$Salary', YoJ = '$YoJ', YoL = '$YoL' where RollNo = '$RollNo'";
                        $result2 = mysqli_query($conn, $query2);

                    $query3 = "update marks set Std10 = '$Std10', Std12 = '$Std12', CPI = '$CPI' where RollNo = '$RollNo'";
                    $result3 = mysqli_query($conn, $query3);

                    if($result1 && $result2 && $result3){
                        echo '<script type="text/javascript">alert("Updated Successfully! Logging you out.")</script>';
                        echo '<script language="javascript">window.location = "http://localhost/miniproject/logout.php";</script>';
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
	<title>Update Profile</title>
    <link rel="stylesheet" href="styles.css">
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
            <a href="welcome_alumnus.php">Main Menu</a>
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
		<label for="Name">Name:</label>
		<input type="text" id="Name" name="Name" value = "<?php echo $Name ?>" required><br><br>

        <label for="Email">Email:</label>
		<input type="email" id="Email" name="Email" value = "<?php echo $Email ?>" required><br><br>

        <label for="Password1">Password:</label>
		<input type="text" id="Password1" name="pass1" value = "<?php echo $Pass ?>" required><br><br>

        <label for="Password2">Confirm Password:</label>
		<input type="text" id="Password2" name="pass2" value = "<?php echo $Pass ?>" required><br><br>

        <label for="Gender">Gender:</label>
                <select id="Gender" name="Gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Non-Binary">Non-Binary</option>
        </select>

        <label for="YoE">Year of Enrollment:</label>
		<input type="number" id="YoE" name="YoE" min="2008" value = "<?php echo $YoE ?>" required><br><br>

        <label for="Specialization">Specialization:</label>
                <select id="Specialization" name="Specialization">
                <option value="CSE">Computer Science and Engineering</option>
                <option value="AIDS">Artificial Intelligence and Data Science</option>
                <option value="MNC">Mathematics and Computer Science</option>
                <option value="EEE">Electrical and Electronics Engineering</option>
                <option value="ME">Mechanical Engineering</option>
                <option value="CE">Civil Engineering</option>
                <option value="CBE">Chemical Engineering</option>
                <option value="MME">Metallurgical and Materials Engineering</option>
                <option value="PH">Engineering Physics</option>
        </select> 

        <label for="CPI">Current CPI:</label>
        <input type="number" step="any" id="CPI" name="CPI"  value = "<?php echo $CPI?>" required><br><br>

        <label for="Transcript">Transcript Link:</label>
        <input type="url" id="Transcript" name="Transcript" value = "<?php echo $Transcript?>"  required><br><br>
        
        <label for="Std10">10th Grade Marks (%):</label>
        <input type="number" step="any" id="Std10" name="Std10" min="0" max="100" value = "<?php echo $Std10?>"  required><br><br>

        <label for="Std12">12th Grade Marks (%):</label>
        <input type="number" step="any" id="Std12" name="Std12" min="0" max="100" value = "<?php echo $Std12?>"  required><br><br>




                <div id="company">
                <label for="company">Company:</label>
                <input type="text" id="company" name="company" value = "<?php echo $Company?>" >
                </div>

                <div id="city">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value = "<?php echo $City?>" >
                </div>

                <div id="position">
                <label for="position">Position:</label>
                <input type="text" id="position" name="position" value = "<?php echo $Position?>" >
                </div>

                <div id="salary">
                <label for="salary">Salary:</label>
                <input type="number" id="salary" name="salary" value = "<?php echo $CTC?>" >
                </div> 
                
                <div id="YoJ">
                <label for="YoJ">Year of Joining:</label>
                <input type="number" id="YoJ" name="YoJ" min="2008" value = "<?php echo $YoJ?>" >
                </div>                

                <div id="YoL">
                <label for="YoL">Year of Leaving:</label>
                <input type="number" id="YoL" name="YoL" value = "<?php echo $YoL?>">
                </div>  <br><br>

                <button class="form-button" type="submit" value="Update Details" name = "Submit">Update</button>

                
            </form>
            <br><br>
        </center>
    </p>
</body>
</html>