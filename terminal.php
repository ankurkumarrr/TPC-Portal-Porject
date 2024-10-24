<html>
<head>
    <title>Admin Query</title>
    <style>
/* Style the form */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
}

label {
    font-size: 18px;
    margin-bottom: 10px;
}

input[type="text"] {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 500px;
    max-width: 100%;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 8px 16px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #3e8e41;
}

/* Style the table */
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
}
    </style>
</head>
<body>
<form method="post" action="">
    <label for="query">Enter MySQL query:</label>
    <input type="text" name="query" id="query">
    <hr style="border-top: 1px dashed #ccc; width: 100%;">
    <input type="submit" name="submit" value="Execute">
</form>
</body>
</html>
<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the MySQL query from the text box
    $query = $_POST['query'];

    // Connect to the MySQL database
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $database = "cs260_final";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $database);

    // Execute the MySQL query
    $result = mysqli_query($conn, $query);
    if (strpos($query, "SELECT") !== false || strpos($query , "select") !== false) {
         // echo $result;
         $num_fields = mysqli_num_fields($result);

         echo "<table>";
         echo "<tr>";
         for ($i = 0; $i < $num_fields; $i++) {
             $field_name = mysqli_fetch_field_direct($result, $i)->name;
             echo "<th>" . $field_name . "</th>";
         }
         echo "</tr>";
         while ($row = mysqli_fetch_assoc($result)) {
             echo "<tr>";
             foreach ($row as $value) {
                 echo "<td>" . $value . "</td>";
             }
             echo "</tr>";
         }
         echo "</table>";
    } else {
        echo "EXECUTED SUCCESSFULLY";
    }
}
?>