<!-- delete jobs and see who has applied for jobs -->

<?php 
require 'config.php';
session_start();

$jobcode = $_GET["jobcode"];
$sql= "select * from applied where jobcode = '$jobcode'";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html>
<head>
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
            <a href="welcome_admin.php">Main Menu</a>
            <a href="logout.php">Log Out</a>
            <a href="admin_all_jobs.php">Go back</a>
        </div>
    </div>
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
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Roll No</th>
                <th>Gender</th>
                <th>YoE</th>
                <th>Semester</th>
                <th>Area of Interest</th>
                <th>Placed</th>
                <th>Current CPI</th>
                <th>Std 10 marks (in %)</th>
                <th>Std 12 marks (in %)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($num_rows != 0){
                
            }
            while ($row = mysqli_fetch_assoc($result)) {
                //info
                // $jobcode1 = $row["jobcode"];
                $temproll = $row["studentrollno"];
                // echo $jobcode;

                $sqltemp = "select * from student where RollNo = '$temproll'";
                $restemp = mysqli_query($conn, $sqltemp);
                $rowtemp = mysqli_fetch_assoc($restemp);
                
                //marks
                $sqltemp1 = "select * from marks where RollNo = '$temproll'";
                $restemp1 = mysqli_query($conn, $sqltemp1);
                $rowtemp1 = mysqli_fetch_assoc($restemp1);


                echo "<tr>";
                echo "<td>" . $rowtemp["Name"] . "</td>";
                echo "<td>" . $rowtemp["RollNo"] . "</td>";
                echo "<td>" . $rowtemp["Gender"] . "</td>";
                echo "<td>" . $rowtemp["YoE"] . "</td>";
                echo "<td>" . $rowtemp["Semester"] . "</td>";
                echo "<td>" . $rowtemp["AoI"] . "</td>";
                echo "<td>" . $rowtemp["Placed"] . "</td>";
                echo "<td>" . $rowtemp1["CPI"] . "</td>";
                echo "<td>" . $rowtemp1["Std10"] . "</td>";
                echo "<td>" . $rowtemp1["Std12"] . "</td>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
