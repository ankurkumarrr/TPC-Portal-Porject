<!DOCTYPE html>
<html>
<head>
	<title>Student Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>

<center>
<body>
    <h2> Placement Details </h2>

    <table>
        <tr>
            <td>Company:       </td>
            <td><?php echo $Company; ?></td>
</tr>
        <tr>
            <td>Position:      </td>
            <td><?php echo $Position; ?></td>

</tr>
        <tr>
            <td>City:      </td>
            <td><?php echo $City; ?></td>
</tr>
        <tr>
            <td>Salary:      </td>
            <td><?php echo $CTC; ?></td>
</tr>
        <tr>
            <td>Year of Joining:      </td>
            <td><?php echo $YoJ; ?></td>
</tr>
        <tr>
            <td>Year of Leaving:      </td>
            <td><?php echo $YoL; ?></td>
</tr>

</table>
<br/>

</center>
</body>
</html>