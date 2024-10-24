<?php
require 'config.php';
session_start();

$email = $_SESSION['sess_user'];

$sql = "SELECT * FROM company where isVerified = 0 and Email != 'admin@iitp.ac.in'";
$result = mysqli_query($conn, $sql);

$ct = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Company Registration</title>
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
                <th>Company Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <?php $Email = $row['Email']; ?> 

                <tr onclick=" location.href='verify_company2.php?Email=<?php echo $row['Email']; ?>' ">
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Company']; ?></td>
                    <td>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table><br><br>
</body>
</html>
