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

if(isset($_POST["Submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];
    $RollNo = $_POST["RollNo"];
    $Gender = $_POST["Gender"];
    $Sem = $_POST["Sem"];
    $YoE = $_POST["YoE"];
    $Specialization = $_POST["Specialization"];
    $AoI = $_POST["AoI"];
    $placed = $_POST["placement-status"];

    $CPI = $_POST["CPI"];
    $Std10 = $_POST["Std10"];
    $Std12 = $_POST["Std12"];
    $Transcript = $_POST["Transcript"];

    $Company = $_POST["company"];
    $City = $_POST["city"];
    $Position = $_POST["position"];
    $Salary = $_POST["salary"];
    $YoJ = $_POST["YoJ"];
    $YoL = $_POST["YoL"];


    $number = preg_match('@[0-9]@', $pass1);         //password strength
    $uppercase = preg_match('@[A-Z]@', $pass1);
    $lowercase = preg_match('@[a-z]@', $pass1);
    $specialChars = preg_match('@[^\w]@', $pass1);

    
                                                        // roll num == 8
    if($pass1 != $pass2){
        echo '<script type="text/javascript">alert("Passwords Dont Match!")</script>';
    }
    else{
        if(!endsWith($email, '@iitp.ac.in')){           //email should have iitp.ac.in
            echo '<script type="text/javascript">alert("Enter IIT Patna email only!")</script>';
        }
        else{
            if(strlen($pass1) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                echo '<script type="text/javascript">alert("Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.")</script>';
              }
              else {
                $query = "select * from student where RollNo = '$RollNo'";        //check for existing user
                $result = mysqli_query($conn, $query);
    
                if (mysqli_num_rows($result)>0){
                    echo '<script type="text/javascript">alert("User already exists! \n Please Login.")</script>';
                }
                else{
                    if(strlen($RollNo) != 8){
                        echo '<script type="text/javascript">alert("Enter a valid Roll Number.")</script>';
                    }
                    else{
                        $query1 = "insert into student values('$email', '$pass1', '$name', '$RollNo', '$Gender', '$YoE', '$Sem', '$Specialization', '$AoI', '$placed', 0, '$Transcript')";      // insert into table if no issues
                        $result1 = mysqli_query($conn, $query1);

                        if($placed == "yes"){
                            $query2 = "insert into placement(RollNo, Company, Position, City, CTC, YoJ, YoL) values('$RollNo', '$Company', '$Position' ,'$City', '$Salary', '$YoJ', '$YoL')";
                            $result2 = mysqli_query($conn, $query2);
                        }
                        else if($placed == "no"){
                            $query2 = "insert into placement(RollNo) values('$RollNo')";
                            $result2 = mysqli_query($conn, $query2);
                        }

                        $query3 = "insert into marks values('$RollNo', '$Std10', '$Std12', '$CPI')";
                        $result3 = mysqli_query($conn, $query3);

                        if($result1 && $result2 && $result3){
                            echo '<script type="text/javascript">alert("User Registered Succesfully!")</script>';
                            echo '<script language="javascript">window.location = "http://localhost/miniproject/login_student.php";</script>';
                        }
                        else{
                            echo '<script type="text/javascript">alert("Error!")</script>';
                        }
                    }
                }
              }

    }
}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
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
        <center><h1>Student Registration</h1></p>

    <p class = "top">
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="" method="post">

                <label for="Name">Name:</label>
                <input type="text" id="Name" name="name" required><br><br>

                <label for="Email">Email Address:</label>
                <input type="email" id="Email" name="email" required><br><br>
                
                <label for="RollNo">Roll Number:</label>
                <input type="text" id="RollNo" name="RollNo" required><br><br>

                <label for="Gender">Gender:</label>
                <select id="Gender" name="Gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Non-Binary">Non-Binary</option>
                </select> 

                <label for="Password1">Password:</label>
                <input type="password" id="Password1" name="pass1"  required><br><br>

                <label for="Password2">Re-Enter Password:</label>
                <input type="password" id="Password2" name="pass2"  required><br><br>

                <label for="CPI">Current CPI:</label>
                <input type="number" step="any" id="CPI" name="CPI"  required><br><br>

                <label for="Transcript">Transcript Link:</label>
                <input type="url" id="Transcript" name="Transcript"  required><br><br>

                <label for="Sem">Current Semester:</label>
                <input type="number" id="Sem" name="Sem" min="1" max="8" required><br><br>

                <label for="YoE">Year of Enrollment:</label>
                <input type="number" id="YoE" name="YoE" min="2008"  required><br><br>


                <label for="Std10">10th Grade Marks (%):</label>
                <input type="number" step="any" id="Std10" name="Std10" min="0" max="100" required><br><br>

                <label for="Std12">12th Grade Marks (%):</label>
                <input type="number" step="any" id="Std12" name="Std12" min="0" max="100" required><br><br>



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

                <label for="AoI">Area of Interest:</label>
                <input type="text" id="AoI" name="AoI"  required><br><br>


                <label for="placement-status">Placement Status:</label>
                <select id="placement-status" name="placement-status">
                <option value="no">No, I'm not Placed</option>
                <option value="yes">Yes, I'm Placed</option>
                </select><br><br>


                <div id="company-input" style="display: none;">
                <label for="company">Company:</label>
                <input type="text" id="company" name="company" >
                </div>

                <div id="city-input" style="display: none;">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" >
                </div>

                <div id="position-input" style="display: none;">
                <label for="position">Position:</label>
                <input type="text" id="position" name="position" >
                </div>

                <div id="salary-input" style="display: none;">
                <label for="salary">Salary:</label>
                <input type="number" id="salary" name="salary" >
                </div> 
                
                <div id="YoJ-input" style="display: none;">
                <label for="YoJ">Year of Joining:</label>
                <input type="number" id="YoJ" name="YoJ" min="2008" >
                </div>                

                <div id="YoL-input" style="display: none;">
                <label for="YoL">Year of Leaving:</label>
                <input type="number" id="YoL" name="YoL" min="2008">
                </div>  <br><br>

                
                <button class="form-button" type="submit" value="Register" name = "Submit">Register</button>

                <script>
                var placementStatus = document.getElementById("placement-status");
                var companyInput = document.getElementById("company-input");
                var cityInput = document.getElementById("city-input");
                var positionInput = document.getElementById("position-input");
                var salaryInput = document.getElementById("salary-input");
                var YoJInput = document.getElementById("YoJ-input");
                var YoLInput = document.getElementById("YoL-input");

                placementStatus.addEventListener("change", function(){
                    if (placementStatus.value === "yes"){
                        companyInput.style.display = "block";
                        cityInput.style.display = "block";
                        positionInput.style.display = "block";
                        salaryInput.style.display = "block";
                        YoJInput.style.display = "block";
                        YoLInput.style.display = "block";
                    }
                    else{
                        companyInput.style.display = "none";
                        cityInput.style.display = "none";
                        positionInput.style.display = "none";
                        salaryInput.style.display = "none";
                        YoJInput.style.display = "none";
                        YoLInput.style.display = "none";
                    }
                });
                </script><br><br>


                <p class = "top">Already a user? <a href="login_student.php">Login</a>

            </form>
        </center>
    </p>
</body>
</html>
