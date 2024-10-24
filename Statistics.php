<?php
require 'config.php';
session_start();

$year = 2018;
if (isset($_POST["Submit"])) {
    $temp = $_POST["Year-choose"];
    $year = $temp-4;
}

function Average($conn1, $yearNeeded)
{
    $result = mysqli_query($conn1, "SELECT AVG(CTC/100000) as Average FROM placement LEFT JOIN alumnus ON placement.RollNo = alumnus.RollNo WHERE alumnus.YoE = $yearNeeded");
    $row = mysqli_fetch_array($result);
    $average = $row["Average"];

    echo $average;
}


// $resultm19 - mysqli_query($conn, "SELECT AVG(CTC) as median_val FROM ( SELECT d.CTC, @rownum:=@rownum+1 as `row_number`, @total_rows:=@rownum
//   FROM data d, (SELECT @rownum:=0) r
//   WHERE d.val is NOT NULL
//   -- put some where clause here
//   ORDER BY d.val
// ) as dd
// WHERE dd.row_number IN ( FLOOR((@total_rows+1)/2), FLOOR((@total_rows+2)/2) );")

// -------------------------------------------------------------------------------------

function Maximum($conn1, $yearNeeded)
{
    $result = mysqli_query($conn1, "SELECT MAX(CTC/100000) as Maximum FROM placement LEFT JOIN alumnus ON placement.RollNo = alumnus.RollNo WHERE alumnus.YoE = $yearNeeded");
    $row = mysqli_fetch_array($result);
    $max = $row["Maximum"];

    echo $max;
}
// -------------------------------------------------------------------------------------
function Offers($conn1, $yearNeeded)
{
    $result = mysqli_query($conn1, "SELECT SUM(offerct) as Offers FROM placement LEFT JOIN alumnus ON placement.RollNo = alumnus.RollNo WHERE alumnus.YoE = $yearNeeded");
    $row = mysqli_fetch_array($result);
    $offer = $row["Offers"];

    echo $offer;
}

// -------------------------------------------------------------------------------------

function Placed($conn1, $yearNeeded)
{
    $result = mysqli_query($conn1, "SELECT COUNT(DISTINCT placement.RollNo) as Placed FROM placement LEFT JOIN alumnus ON placement.RollNo = alumnus.RollNo WHERE alumnus.YoE = $yearNeeded");
    $row = mysqli_fetch_array($result);
    $placed = $row["Placed"];

    echo $placed;
}
//------------------------------------------------------------------------
function Company($conn1, $yearNeeded)
{
    $result = mysqli_query($conn1, "SELECT COUNT(DISTINCT placement.Company) as Companycnt FROM placement LEFT JOIN alumnus ON placement.RollNo = alumnus.RollNo WHERE alumnus.YoE = $yearNeeded");
    $row = mysqli_fetch_array($result);
    $comp = $row["Companycnt"];

    echo $comp;
}

function averageBranch($conn, $branch, $year)
{
    $result = mysqli_query($conn, "SELECT AVG(CTC/100000) as Average FROM placement LEFT JOIN alumnus ON placement.RollNo = alumnus.RollNo WHERE alumnus.YoE = $year and Specialization = '$branch'");
    $row = mysqli_fetch_array($result);
    $average = $row["Average"];

    echo $average;
}

function maxBranch($conn, $branch, $year)
{
    $result = mysqli_query($conn, "SELECT MAX(CTC/100000) as Average FROM placement LEFT JOIN alumnus ON placement.RollNo = alumnus.RollNo WHERE alumnus.YoE = $year and Specialization = '$branch'");
    $row = mysqli_fetch_array($result);
    $average = $row["Average"];

    echo $average;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Placement Statistics</title>
    <link rel="stylesheet" href="style_stats.css?v=<?php echo time(); ?>">
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <div class="header">
        <a href="index.php" class="logo">
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
            <a href="index.php">Home</a>
            <a href="Statistics.php">Statistics</a>
            <a href="about_us.php">About Us</a>
        </div>
    </div>

    <center>
        <h1> PLACEMENT STATISTICS </h1>
    </center>
    <h2> Trends Over the Years </h2>

    <div style="width: 100%;">
        <div style="width: 50%; height: 500px; float: left;">
            <canvas id="chart1" style="width:100%;max-width:600px;height:100%;max-height:500px"></canvas>
        </div>
        <div style="margin-left: 50%; height: 500px;">
            <canvas id="chart2" style="width:100%;max-width:600px;height:100%;max-height:500px"></canvas>
        </div>

        <script>
            new Chart(document.getElementById('chart1'), {
                type: 'bar',
                data: {
                    labels: ['2018-19', '2019-20', '2020-21', '2021-22'],
                    datasets: [{
                        label: 'Average',
                        data: [<?php Average($conn, 2015); ?>, <?php Average($conn, 2016); ?>, <?php Average($conn, 2017); ?>, <?php Average($conn, 2018); ?>],
                        backgroundColor: 'rgba(124, 181, 236, 0.9)',
                        borderColor: 'rgb(124, 181, 236)',
                        borderWidth: 1
                    },
                    {
                        label: 'Max',
                        data: [<?php Maximum($conn, 2015); ?>, <?php Maximum($conn, 2016); ?>, <?php Maximum($conn, 2017); ?>, <?php Maximum($conn, 2018); ?>],
                        backgroundColor: 'rgba(128,128,128,0.9)',
                        borderColor: 'rgba(128,128,128,0.9)',
                        borderWidth: 1
                    }
                    ]
                },
                options: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    }
                }
            });
        </script>


        <script>
            new Chart(document.getElementById('chart2'), {
                type: 'bar',
                data: {
                    labels: ['2018-19', '2019-20', '2020-21', '2021-22'],
                    datasets: [{
                        label: 'Offers',
                        data: [<?php Offers($conn, 2015); ?>, <?php Offers($conn, 2016); ?>, <?php Offers($conn, 2017); ?>, <?php Offers($conn, 2018); ?>],
                        backgroundColor: 'rgba(124, 181, 236, 0.9)',
                        borderColor: 'rgb(124, 181, 236)',
                        borderWidth: 1
                    },
                    {
                        label: 'Placed',
                        data: [<?php Placed($conn, 2015); ?>, <?php Placed($conn, 2016); ?>, <?php Placed($conn, 2017); ?>, <?php Placed($conn, 2018); ?>],
                        backgroundColor: 'rgba(67, 67, 72, 0.9)',
                        borderColor: 'rgb(67, 67, 72)',
                        borderWidth: 1
                    },
                    {
                        label: 'Companies',
                        data: [<?php Company($conn, 2015); ?>, <?php Company($conn, 2016); ?>, <?php Company($conn, 2017); ?>, <?php Company($conn, 2018); ?>],
                        backgroundColor: 'rgba(128,128,128,0.9)',
                        borderColor: 'rgba(128,128,128,0.9)',
                        borderWidth: 1
                    }
                    ]
                },
                options: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    }
                }
            });
        </script>
        <br>
        <form action="Statistics.php" method="post">
            <label for="Year-choose">
                <h2 id="year">Choose a Year to see Statistics</h2>
            </label>
            <select name="Year-choose" id="Year-choose" width="200px">
                <option value="2022" >2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
            </select>


            <button class="my-button" type="submit" value="Submit" name="Submit">Go</button>
        </form><br>
        <center>
            <table id="tableStats" height="400px" width="700px">
                <tr>
                    <td>Branch Name </td>
                    <td>Average Salary (LPA) </td>
                    <td>Highest CTC </td>
                </tr>
                <tr>
                    <td>Compter Science and Engineering</td>
                    <td>
                        <?php averageBranch($conn, "CSE", $year); ?>
                    </td>
                    <td>
                        <?php maxBranch($conn, "CSE", $year); ?>
                    </td>
                </tr>
                <tr>
                    <td>Electrical Engineering</td>
                    <td>
                        <?php averageBranch($conn, "EEE", $year); ?>
                    </td>
                    <td>
                        <?php maxBranch($conn, "EEE", $year); ?>
                    </td>
                </tr>
                <tr>
                    <td>Mechanical Engineering</td>
                    <td>
                        <?php averageBranch($conn, "ME", $year); ?>
                    </td>
                    <td>
                        <?php maxBranch($conn, "ME", $year); ?>
                    </td>
                </tr>
                <tr>
                    <td>Civil Engineering</td>
                    <td>
                        <?php averageBranch($conn, "CE", $year); ?>
                    </td>
                    <td>
                        <?php maxBranch($conn, "CE", $year); ?>
                    </td>
                </tr>
                <tr>
                    <td>Chemical Engineering</td>
                    <td>
                        <?php averageBranch($conn, "CBE", $year); ?>
                    </td>
                    <td>
                        <?php maxBranch($conn, "CBE", $year); ?>
                    </td>
                </tr>
                <tr>
                    <td>Metallurgical and Materials Engineering</td>
                    <td>
                        <?php averageBranch($conn, "MME", $year); ?>
                    </td>
                    <td>
                        <?php maxBranch($conn, "MME", $year); ?>
                    </td>
                </tr>
                <tr>
                    <td>Engineering Physics</td>
                    <td>
                        <?php averageBranch($conn, "EP", $year); ?>
                    </td>
                    <td>
                        <?php maxBranch($conn, "EP", $year); ?>
                    </td>
                </tr>
            </table>

        <canvas id="chart3" style="margin-top: 20px;width:100%;max-width:600px;height:100%;max-height:500px;"></canvas>
        <script>
            new Chart(document.getElementById('chart3'), {
                type: 'bar',
                data: {
                    labels: ['Offers', 'Placed', 'Companies'],
                    datasets: [{
                        data: [<?php Offers($conn, $year); ?>,<?php Placed($conn, $year); ?>,<?php Company($conn, $year); ?>],
                        backgroundColor: ['rgba(124, 181, 236, 0.9)', 'white', 'black'],
                        borderColor: 'rgb(124, 181, 236)',
                        borderWidth: 1
                    }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        </script>
        </center>
        <h2>Top Recruiters</h2>

        <list>
            <h3> By Highest CTC </h3>
            <ul>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM placement LEFT JOIN alumnus ON placement.RollNo = alumnus.RollNo WHERE alumnus.YoE = $year ORDER BY CTC DESC LIMIT 3");
                while ($row = mysqli_fetch_array($result)) {
                    echo "<li>".$row['Company'] ."</li>";
                }

                ?>
            </ul>
            </list>
<br><br>
            <list>
            <h3> By Most Offers </h3>
            <ul>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM placement LEFT JOIN alumnus ON placement.RollNo = alumnus.RollNo WHERE alumnus.YoE = $year ORDER BY offerct DESC LIMIT 3");
                while ($row = mysqli_fetch_array($result)) {
                    echo"<li>".$row['Company'] . "</li>";
                }

                ?>
            </ul>
            </list>
</body>

</html>