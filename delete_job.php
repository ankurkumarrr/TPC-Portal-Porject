<?php
require 'config.php';
session_start();

$email = $_SESSION['sess_user'];
$jobcode = $_POST["jobcode"];
$sql = "delete from jobs where jobcode = '$jobcode'";
$result = mysqli_query($conn , $sql);


?>
<script>
    window.location.href = "view_job.php";
</script>