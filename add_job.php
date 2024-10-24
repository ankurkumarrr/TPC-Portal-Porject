<?php
require 'config.php';
session_start();
//to code
function generateRandomCode($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

if (isset($_POST["addjob"])) {
    // $email = $_SESSION['sess_user'];
    // $position = $_POST['position'];
    // $city = $_POST['city'];
    // $ctc = $_POST['ctc'];
    // if (isset($_POST["specialization"])) {
    //   } else {
    //     echo "Please select a specialization.";
    //     exit;
    // }
    // $specialization = $_POST['specialization'];
    // foreach($specialization as $val){
    //     echo $val;
    // }
    $email = $_SESSION['sess_user'];
    $position = $_POST['position'];
    $city = $_POST['city'];
    $ctc = $_POST['ctc'];
    if (isset($_POST["specialization"])) {
    } else {
        echo "Please select a specialization.";
        exit;
    }
    $specialization = $_POST['specialization'];
    $interviewtype = $_POST['interviewtype'];
    $interviewmode = $_POST['interviewmode'];
    $gender = $_POST['gender'];
    $mincpi = $_POST['mincpi'];
    $minstd10 = $_POST['minstd10'];
    $minstd12 = $_POST['minstd12'];

    foreach ($specialization as $value) {
        $jobcode = generateRandomCode(8);
        $sql = "SELECT * FROM jobs where Company = '$email' and Position = '$position' and City = '$city'and Specialization = '$value'";
        $result = mysqli_query($conn, $sql);
        $ct = 0;
        $current_year = date('Y');
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ct += 1;
                $sql1 = "update jobs set CTC = '$ctc' ,InterviewType = '$interviewtype', InterviewMode = '$interviewmode', MinCPI = '$mincpi' , MinStd10 = '$minstd10', MinStd12 = '$minstd12', Gender = '$gender' where Company = '$email' and Position = '$position' and City = '$city'and Specialization = '$value'";
                $result1 = mysqli_query($conn, $sql1);
            }
        }
        if ($ct == 0) {
            $sql1 = "insert into jobs values ('$email', '$position', '$city' ,'$ctc', '$value', '$interviewtype', '$interviewmode', '$mincpi', '$minstd10' , '$minstd12', '$gender', '$jobcode', 0 ,'$current_year')";
            $result1 = mysqli_query($conn, $sql1);
        }
    }


}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add a Job</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="header">
        <a class="logo">
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
    <p class="heading">
        <center>
            <h1>Add a Job</h1>
    </p>

    <p class="top">
        <?php if (isset($error)): ?>
        <p>
            <?php echo $error; ?>
        </p>
    <?php endif; ?>

    <form action="" method="post">

        <label for="Position">Position:</label>
        <input type="text" id="Position" name="position" required><br><br>

        <label for="City">City:</label>
        <input type="text" id="City" name="city" required><br><br>

        <label for="CTC">CTC:</label>
        <input type="text" id="CTC" name="ctc" required><br><br>

        <label for="specialization">Specialization:</label><br>
        <div class="checkbox-group">
            <div>
                <label for="cse"><span class="square"></span> CSE</label>
                <input type="checkbox" id="cse" name="specialization[]" value="CSE">
            </div>
            <div>
                <label for="aids"><span class="square"></span> Artificial Intelligence and Data Science</label>
                <input type="checkbox" id="aids" name="specialization[]" value="AIDS">
            </div>
            <div>

                <label for="mnc"><span class="square"></span> Mathematics and Computer Science</label>
                <input type="checkbox" id="mnc" name="specialization[]" value="MNC">
            </div>
            <div>

                <label for="eee"><span class="square"></span> Electrical and Electronics Engineering</label>
                <input type="checkbox" id="eee" name="specialization[]" value="EEE">
            </div>
            <div>
                <label for="me"><span class="square"></span> Mechanical Engineering</label>
                <input type="checkbox" id="me" name="specialization[]" value="ME">
            </div>
            <div>

                <label for="ce"><span class="square"></span> Civil Engineering</label>
                <input type="checkbox" id="ce" name="specialization[]" value="CE">
            </div>
            <div>

                <label for="cbe"><span class="square"></span> Chemical Engineering</label>
                <input type="checkbox" id="cbe" name="specialization[]" value="CBE">
            </div>
            <div>
                <label for="mme"><span class="square"></span> Metallurgical and Materials Engineering</label>
                <input type="checkbox" id="mme" name="specialization[]" value="MME">
            </div>
            <div>

                <label for="mme"><span class="square"></span> Metallurgical and Materials Engineering</label>
                <input type="checkbox" id="ph" name="specialization[]" value="PH">x
            </div>
        </div>

        <label for="InterviewType">Interview Type:</label>
        <select id="InterviewType" name="interviewtype" required>
            <option value="">--Select Type--</option>
            <option value="Oral">Oral</option>
            <option value="Written">Written</option>
        </select><br><br>

        <label for="InterviewMode">Interview Mode:</label>
        <select id="InterviewMode" name="interviewmode" required>
            <option value="">--Select Mode--</option>
            <option value="Offline">Offline</option>
            <option value="Online">Online</option>
        </select><br><br>

        <label for="Gender">Gender:</label>
        <select id="Gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Non-Binary">Non-Binary</option>
        </select>

        <label for="MinCPI">Minimum Current CPI:</label>
        <input type="number" step="any" id="MinCPI" name="mincpi" required><br><br>

        <label for="Std10">Minimum 10th Grade Marks (%):</label>
        <input type="number" step="any" id="MinStd10" name="minstd10" min="0" max="100" required><br><br>

        <label for="Std12">Minimum 12th Grade Marks (%):</label>
        <input type="number" step="any" id="MinStd12" name="minstd12" min="0" max="100" required><br><br>



        <button class="form-button" type="submit" value="addjob" name="addjob">Add Job</button>

    </form>
    </center>
    </p>
</body>

</html>