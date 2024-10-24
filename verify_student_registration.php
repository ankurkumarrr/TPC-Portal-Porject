<?php
require 'config.php';
session_start();

$email = $_SESSION['sess_user'];

$sql = "SELECT * FROM student where isVerified = 0";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM marks";
$result2 = mysqli_query($conn, $sql2);

$sql3 = "SELECT * FROM placement";
$result3 = mysqli_query($conn, $sql3);

$row2 = mysqli_fetch_assoc($result2);
$row3 = mysqli_fetch_assoc($result3);

$ct = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Student Registration</title>
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

        a{
            font-size: 20px;
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
            <a href="welcome_admin.php">Main Menu</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <center><h2> Here are the pending registrations, Click to Accept/Reject </h2></center>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Roll Number</th>
                <th>Gender</th>
                <th>Year of Enrollment</th>
                <th>Semester</th>
                <th>Specialization</th>
                <th>Area of Interest</th>

                <th>Class 10 Marks</th>
                <th>Class 12 Marks</th>
                <th>CPI</th>
                <th>Transcript Link</th>

                <th>Company</th>
                <th>Position</th>
                <th>City</th>
                <th>CTC</th>
                <th>Year of Joining</th>


            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <?php 

                $RollNo = $row['RollNo'];

                $sql2 = "SELECT * FROM marks where RollNo = '$RollNo'";
                $result2 = mysqli_query($conn, $sql2);

                $sql3 = "SELECT * FROM placement where RollNo = '$RollNo'";
                $result3 = mysqli_query($conn, $sql3);

                $row2 = mysqli_fetch_assoc($result2);
                $row3 = mysqli_fetch_assoc($result3);
                $Transcript = $row['Transcript'];

                 ?> 
                <tr onclick=" location.href='verify_student2.php?RollNo=<?php echo $row['RollNo']; ?>' ">
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['RollNo']; ?></td>
                    <td><?php echo $row['Gender']; ?></td>
                    <td><?php echo $row['YoE']; ?></td>
                    <td><?php echo $row['Semester']; ?></td>
                    <td><?php echo $row['Specialization']; ?></td>
                    <td><?php echo $row['AoI']; ?></td>

                    <td><?php echo $row2['Std10']; ?></td>
                    <td><?php echo $row2['Std12']; ?></td>
                    <td><?php echo $row2['CPI']; ?></td>
                    <td><a href="<?php echo $Transcript; ?>"> Link </a></td>

                    <td><?php echo $row3['Company']; ?></td>
                    <td><?php echo $row3['Position']; ?></td>
                    <td><?php echo $row3['City']; ?></td>
                    <td><?php echo $row3['CTC']; ?></td>
                    <td><?php echo $row3['YoJ']; ?></td>

                    
                    <td>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table><br><br>

</body>
</html>
