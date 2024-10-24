<?php
require 'config.php';
session_start();

$email = $_SESSION['sess_user'];
$jobcode = $_POST["jobcode"];
$sql = "select * from jobs where jobcode = '$jobcode'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$x = strip_tags($row["Position"])
?>

<!DOCTYPE html>
<html>
<head>
	<title>Company Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <p class = "heading">
        <center><h1>Job Update</h1></p>

    <p class = "top">

            <form action="update_job.php" method="post">

                <label for="Position">Position:</label>
                <input type="text" id="Position" name="position" value= "<?php echo strip_tags($row["Position"])?>" required><br><br>

                <label for="City">City:</label>
                <input type="text" id="City" name="city" value= <?php echo $row["City"]?> required><br><br>

                <label for="CTC">CTC:</label>
                <input type="text" id="CTC" name="ctc" value= <?php echo $row["CTC"]?> required><br><br>

                <label for="InterviewType">Interview Type:</label>
                <select id="InterviewType" name="interviewtype" required>
                <option value="">--Select Type--</option>
                <option value="Oral"<?php if($row["InterviewType"] == "Oral") echo " selected";?>>Oral</option>
                <option value="Written" <?php if($row["InterviewType"] == "Written") echo " selected";?>>Written</option>
                </select><br><br>

                <label for="InterviewMode">Interview Mode:</label>
                <select id="InterviewMode" name="interviewmode" required>
                <option value="">--Select Mode--</option>
                <option value="Offline" <?php if($row["InterviewMode"] == "Offline") echo " selected";?>>Offline</option>
                <option value="Online" <?php if($row["InterviewMode"] == "Online") echo " selected";?>>Online</option>
                </select><br><br>

                <label for="Gender">Gender:</label>
                <select id="Gender" name="gender">
                <option value="Male" <?php if($row["Gender"] == "Male") echo " selected";?>>Male</option>
                <option value="Female" <?php if($row["Gender"] == "Female") echo " selected";?>>Female</option>
                <option value="Non-Binary" <?php if($row["Gender"] == "Non-Binary") echo " selected";?>>Non-Binary</option>
                </select> 

                <label for="MinCPI">Minimum CPI:</label>
                <input type="number" step="any" id="MinCPI" name="mincpi" value = <?php echo $row["MinCPI"]?> required><br><br>

                <label for="Std10">Minimum 10th Grade Marks (%):</label>
                <input type="number" step="any" id="MinStd10" name="minstd10" min="0" max="100" value = <?php echo $row["MinStd10"]?> required><br><br>

                <label for="Std12">Minimum 12th Grade Marks (%):</label>
                <input type="number" step="any" id="MinStd12" name="minstd12" min="0" max="100" value = <?php echo $row["MinStd12"]?> required><br><br>
                <input type="hidden" name="jobcode" value="<?php echo $row['jobcode']; ?>">
                <button  type="submit" value="updatejob" name = "updatejob">Update Job</button>

            </form>
        </center>
    </p>
</body>
</html>
