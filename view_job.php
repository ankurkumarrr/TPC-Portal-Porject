<?php
require 'config.php';
session_start();

$email = $_SESSION['sess_user'];

$sql = "SELECT * FROM jobs where Company = '$email'";
$result = mysqli_query($conn, $sql);

$ct = 0;
// while($row = mysqli_fetch_assoc($result)){
//     $ct+=1;
// }
// if($ct == 0){
//     header("Location: /add_job.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html>
<head>
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
    <table>
        <thead>
            <tr>
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
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr onclick="location.href='job_info.php?jobcode=<?php echo $row['jobcode']; ?>'">
                    <td><?php echo $row['Position']; ?></td>
                    <td><?php echo $row['City']; ?></td>
                    <td><?php echo $row['CTC']; ?></td>
                    <td><?php echo $row['Specialization']; ?></td>
                    <td><?php echo $row['InterviewType']; ?></td>
                    <td><?php echo $row['InterviewMode']; ?></td>
                    <td><?php echo $row['MinCPI']; ?></td>
                    <td><?php echo $row['MinStd10']; ?></td>
                    <td><?php echo $row['MinStd12']; ?></td>
                    <td><?php echo $row['Gender']; ?></td>
                    <td>
                    <form method="post" action="delete_job.php">
                        <input type="hidden" name="jobcode" value="<?php echo $row['jobcode']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <form method="post" action="update_delete_job.php">
                        <input type="hidden" name="jobcode" value="<?php echo $row['jobcode']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
