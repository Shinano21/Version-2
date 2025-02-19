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
    <style>
         body{
               background-color: #CDE8E5;
            }
        /* General Styles for the Section */
#main-content {
    font-family: Arial, sans-serif;
    margin: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Style for the Form */
form {
    max-width: 900px;
    margin: 0 auto;
}

/* Sectioning Styles */
.sectioning {
    margin-bottom: 20px;
    width: 100%;
}

.sectioning p {
    font-size: 1.2em;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.sectioning hr {
    border: 1px solid #ddd;
    margin-bottom: 10px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
    color: #333;
    width: 30%;
}

td {
    background-color: #fff;
    color: #555;
}

/* Responsive Table Styles */
@media (max-width: 768px) {
    table, th, td {
        display: block;
        width: 100%;
    }

    th {
        text-align: center;
        padding-top: 10px;
    }

    td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    td:before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
    }
}

/* Specific Styles for the Rows in the Tables */
table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

/* Padding and Margin Adjustments for Tables */
table td, table th {
    padding: 10px;
}

/* Style for "No record found" Message */
#main-content .no-record {
    font-size: 1.2em;
    color: red;
    font-weight: bold;
    text-align: center;
}

/* Additional Adjustments for Form and Layout */
.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

#main-content .relative {
    position: relative;
}

    </style>
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
           p.calcium_supplementation, p.iodine_capsules, p.deworming_tablets,
           p.syphilis_screened, p.syphilis_positive, p.hepB_screened, p.hepB_positive,
           p.hiv_screened, p.cbc_tested, p.cbc_anemia, p.gestational_diabetes_screened, 
           p.gestational_diabetes_positive,
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
                                <tr>
                                    <th>Calcium Supplementation</th>
                                    <td><?php echo $row["calcium_supplementation"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>Iodine Capsules</th>
                                    <td><?php echo $row["iodine_capsules"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>Deworming Tablets</th>
                                    <td><?php echo $row["deworming_tablets"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>Syphilis Screened</th>
                                    <td><?php echo $row["syphilis_screened"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>Syphilis Positive</th>
                                    <td><?php echo $row["syphilis_positive"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>Hepatitis B Screened</th>
                                    <td><?php echo $row["hepB_screened"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>Hepatitis B Positive</th>
                                    <td><?php echo $row["hepB_positive"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>HIV Screened</th>
                                    <td><?php echo $row["hiv_screened"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>CBC Tested</th>
                                    <td><?php echo $row["cbc_tested"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>CBC Anemia</th>
                                    <td><?php echo $row["cbc_anemia"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>Gestational Diabetes Screened</th>
                                    <td><?php echo $row["gestational_diabetes_screened"] ? 'Yes' : 'No'; ?></td>
                                </tr>
                                <tr>
                                    <th>Gestational Diabetes Positive</th>
                                    <td><?php echo $row["gestational_diabetes_positive"] ? 'Yes' : 'No'; ?></td>
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
        function display_ct() {
            var refresh = 1000; // Refresh rate in milliseconds
            setTimeout(display_ct, refresh);
            var x = new Date();
            var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var timeString = x.toLocaleTimeString('en-US', options);
            var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });
            var x1 = datePart + ' - ' + timeString;
            document.getElementById('ct').innerHTML = x1;
        }
        display_ct();
    </script>
</body>
</html>
