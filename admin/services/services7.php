<?php
session_start();

include "../dbcon.php";  // Database connection

// Check if the user is logged in and is not a System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Query to fetch residents from the database
$query = "SELECT id, fname, lname FROM residents";  // Assuming the residents table is called "residents"
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>Add Prenatal Record | CareVisio</title>
    <?php include "head.php"; ?>
</head>

<body onload="display_ct();">

    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <a href="../services7.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Prenatal Records</h7>
                                </a>
                                <h1>New Prenatal Record</h1>
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
                    <form action="add_prenatal_record.php" method="post">
                        <div class="row">
                            <div class="sectioning">
                                <br>
                                <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>
                                <hr>
                                <table>
                                    <tr>
                                        <th><b>Resident Name<span class="req">*</span></b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="resident_name">Resident Name<span class="req">*</span></label><br>
                                            <select name="resident_name" id="resident_name" required>
                                                <option value="">Select Resident</option>
                                                <?php
                                                // Loop through the fetched data and populate the dropdown
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option value="' . $row['id'] . '">' . $row['fname'] . ' ' . $row['lname'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>Prenatal Checkup Details</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="checkup_date">Checkup Date<span class="req">*</span></label><br>
                                            <input type="date" name="checkup_date" id="checkup_date" required>
                                        </th>
                                        <th>
                                            <label for="gestational_age">Gestational Age<span class="req">*</span></label><br>
                                            <input type="number" name="gestational_age" id="gestational_age" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="blood_pressure">Blood Pressure<span class="req">*</span></label><br>
                                            <input type="text" name="blood_pressure" id="blood_pressure" required>
                                        </th>
                                        <th>
                                            <label for="weight">Weight<span class="req">*</span></label><br>
                                            <input type="number" name="weight" id="weight" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="fetal_heartbeat">Fetal Heartbeat<span class="req">*</span></label><br>
                                            <input type="text" name="fetal_heartbeat" id="fetal_heartbeat" required>
                                        </th>
                                        <th>
                                            <label for="remarks">Remarks</label><br>
                                            <textarea name="remarks" id="remarks"></textarea>
                                        </th>
                                    </tr>
                                </table>
                                <br>
                                <button type="submit" name="add_prenatal_record">Save</button>
                                <br><br>
                                <hr>
                            </div>
                        </div>

                        <style>
                            body {
                                overflow-x: hidden;
                            }
                            button[type="submit"] {
                                padding: 10px 40px;
                                border: none;
                                box-shadow: 0px 0px 3px gray;
                                color: white;
                                background-color: rgb(92, 84, 243);
                                border-radius: 10px;
                                float: right;
                                margin: 1%;
                            }
                            textarea, input, select {
                                border: none;
                                box-shadow: 0px 0px 2px gray;
                                border-radius: 10px;
                                padding: 7px;
                                width: 90%;
                            }
                            .req {
                                color: red;
                            }
                            table {
                                width: 100%;
                            }
                            th {
                                padding: 10px;
                            }
                            .sectioning {
                                padding: 20px;
                                background-color: #f9f9fd;
                                box-shadow: 0px 0px 2px gray;
                                border-radius: 10px;
                                width: 100%;
                            }
                        </style>
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

    <!-- jquery vendor -->
    <script src="../js/lib/jquery.min.js"></script>
    <script src="../js/lib/jquery.nanoscroller.min.js"></script>
    <script src="../js/lib/menubar/sidebar.js"></script>
    <script src="../js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../js/lib/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>

</body>

</html>
