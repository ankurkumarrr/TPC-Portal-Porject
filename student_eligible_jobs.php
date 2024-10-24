<?php
require 'config.php';
session_start();

$RollNo = $_SESSION['sess_user'];

$sql = "select * from student where RollNo = '$RollNo'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $placed = $row['Placed'];
    $gender = $row['Gender'];
    $spl = $row['Specialization'];
    $ctc = 0 ;
}

if($placed == 'yes'){
    $sql1 = "SELECT * FROM placement where RollNo  = '$RollNo'";
    $result1 = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($result1);
    $ctc = $row['CTC'];
}

$sql2 = "select * from marks where RollNo = '$RollNo'";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);

// echo $row;

$std10 = $row['Std10'];
$std12 = $row['Std12'];
$cpi = $row['CPI'];

//job filtering
$sql3 = "select * from jobs where CTC >'$ctc' and Specialization = '$spl' and MinCPI <= '$cpi' and MinStd10 <= '$std10' and MinStd12 <= '$std12' and Gender = '$gender' ";
$result3 = mysqli_query($conn, $sql3);


//already applied jobs
$sql4 = "select * from applied where studentrollno = '$RollNo'";
$result4 = mysqli_query($conn, $sql4);

?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Job Table</title>
    <link rel="stylesheet" href="styles_verify.css?v=<?php echo time(); ?>">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
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
            <a href="welcome_student.php">Main Menu</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
	<h1>Job List</h1>
	<table>
    <thead>
            <tr>
                <th>Company</th>
                <th>Position</th>
                <th>City</th>
                <th>CTC</th>
                <th>Specialization</th>
                <th>Interview Type</th>
                <th>Interview Mode</th>
                <th>Min CPI</th>
                <th>Min Std 10</th>
                <th>Min Std 12</th>
                <th>Gender</th>
            </tr>
    </thead>
		<tbody>
			<?php 
                while($row = mysqli_fetch_assoc($result3)) {
                    $compem = $row["Company"];
                    $sqltemp = "select * from company where Email = '$compem'";
                    $restemp = mysqli_query($conn, $sqltemp);
                    $rowtemp = mysqli_fetch_assoc($restemp);
                    echo "<tr>";
                    echo "<td>" . $rowtemp["Company"] . "</td>";
                    echo "<td>" . $row["Position"] . "</td>";
                    echo "<td>" . $row["City"] . "</td>";
                    echo "<td>" . $row["CTC"] . "</td>";
                    echo "<td>" . $row["Specialization"] . "</td>";
                    echo "<td>" . $row["InterviewType"] . "</td>";
                    echo "<td>" . $row["InterviewMode"] . "</td>";
                    echo "<td>" . $row["MinCPI"] . "</td>";
                    echo "<td>" . $row["MinStd10"] . "</td>";
                    echo "<td>" . $row["MinStd12"] . "</td>";
                    echo "<td>" . $row["Gender"] . "</td>";

                    $jobcode = $row["jobcode"];
                    $applied = false;
                    // Check if the student has already applied for the job
                    while($row2 = mysqli_fetch_assoc($result4)) {
                        if($row2["jobcode"] == $jobcode) {
                            $applied = true;
                            break;
                        }
                    }
                    // Display the applied or rescind button
                    if($applied) {
                        echo "<td><button onclick='rescindJob(\"$jobcode\")'>Rescind</button></td>";
                    } else {
                        echo "<td><button onclick='appliedJob(\"$jobcode\")'>Apply</button></td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            ?>
		</tbody>
	</table>
</body>
</html>

<script>
function appliedJob(jobcode) {
    // Send an AJAX request to insert a new row into the applied table
    console.log("appliedJob called with jobcode:", jobcode);
    $.ajax({
        type: "POST",
        url: "applied_job.php",
        data: { jobcode: jobcode },
        success: function(data) {
            // Handle the response from the server
            console.log(data);
            // If the job was applieded successfully, update the UI
            window.location.href = "job_applied_by_stud.php";
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
        }
    });

}


function rescindJob(jobcode) {
    // Send an AJAX request to delete the row from the applied table
    $.ajax({
        type: "POST",
        url: "rescind_job.php",
        data: { jobcode: jobcode },
        success: function(data) {
            // Handle the response from the server
            console.log(data);
            // If the job was rescinded successfully, update the UI
            window.location.href = "job_rescinded_by_stud.php";
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
        }
    });
}

</script>
