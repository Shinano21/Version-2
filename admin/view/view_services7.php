<?php
session_start();

include "../dbcon.php";
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Prenatal Record | CareVisio</title>
    <?php include "../services/head.php"; ?>
</head>

<body onload="display_ct();">

    <?php include "../services/header.php"?>
    <?php include "../services/sidebar.php"?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <a href="../services7.php"><h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i>Back to Prenatal Records</h7></a>
                                <h1>View Prenatal Record</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../home.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Services</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="main-content">
                <form>
                    <div class="row" position="relative;" id="a1">

                    <?php
                    // Get the prenatal record ID from the query parameter
                    $id = $_GET["view"];

                    // SQL query to fetch the prenatal record and the associated resident details
                    $query = "
                        SELECT p.prenatal_id, p.checkup_date, p.gestational_age, p.blood_pressure, 
                               p.weight, p.fetal_heartbeat, p.remarks,
                               r.fname, r.mname, r.lname, r.suffix, r.sex, r.bday
                        FROM prenatal p
                        JOIN residents r ON p.resident_id = r.id
                        WHERE p.prenatal_id = $id
                        LIMIT 1
                    ";

                    $result = $conn->query($query);

                    // Check if the query returned any result
                    if ($result && $result->num_rows > 0) {
                        // Fetch the result as an associative array
                        $row = $result->fetch_assoc();
                    ?>
                        <div class="sectioning">
                            <br>
                            <p>Patient Information</p>
                            <hr>
                            <table>
                                <tr>
                                    <th>First Name</th>
                                    <td><?php echo $row["fname"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Middle Name</th>
                                    <td><?php echo $row["mname"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td><?php echo $row["lname"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Suffix</th>
                                    <td><?php echo $row["suffix"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Sex</th>
                                    <td><?php echo $row["sex"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Birthdate</th>
                                    <td><?php echo $row["bday"]; ?></td>
                                </tr>
                            </table>
                            <br>
                            <p>Prenatal Checkup Details</p>
                            <hr>
                            <table>
                                <tr>
                                    <th>Checkup Date</th>
                                    <td><?php echo $row["checkup_date"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Gestational Age</th>
                                    <td><?php echo $row["gestational_age"]; ?> weeks</td>
                                </tr>
                                <tr>
                                    <th>Blood Pressure</th>
                                    <td><?php echo $row["blood_pressure"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td><?php echo $row["weight"]; ?> kg</td>
                                </tr>
                                <tr>
                                    <th>Fetal Heartbeat</th>
                                    <td><?php echo $row["fetal_heartbeat"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Remarks</th>
                                    <td><?php echo $row["remarks"]; ?></td>
                                </tr>
                            </table>
                        </div>
                    <?php
                    } else {
                        echo "<p>No record found.</p>";
                    }
                    ?>

                    </div>
                </form>
                </section>
            </div>
        </div>
    </div>

    <script>
        function display_c() {
            var refresh = 1000;
            mytime = setTimeout('display_ct()', refresh);
        }

        function display_ct() {
            var x = new Date();
            var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var timeString = x.toLocaleTimeString('en-US', options);
            var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });
            var x1 = datePart + ' - ' + timeString;
            document.getElementById('ct').innerHTML = x1;
            tt = display_c();
        }

        display_c();
    </script>
</body>

</html>
