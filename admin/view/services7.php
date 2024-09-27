<?php
session_start();
include "../dbcon.php";  // Database connection

// Redirect if user is not logged in or is a System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Fetch the prenatal record ID from the URL
$prenatal_id = isset($_GET['id']) ? $_GET['id'] : '';
if (!$prenatal_id) {
    header("Location: prenatal_records.php");  // Redirect if no ID is provided
    exit();
}

// Prepare statement to fetch the specific prenatal record
$query_prenatal = $conn->prepare("SELECT * FROM prenatal WHERE id = ?");
$query_prenatal->bind_param('i', $prenatal_id);
$query_prenatal->execute();
$result_prenatal = $query_prenatal->get_result();
$prenatal_data = $result_prenatal->fetch_assoc();

if (!$prenatal_data) {
    header("Location: prenatal_records.php");  // Redirect if no record is found
    exit();
}

// Fetch residents from the database for the dropdown
$query_residents = $conn->prepare("SELECT id, fname, lname FROM residents");
$query_residents->execute();
$result_residents = $query_residents->get_result();
?>

<?php
// Check if form is submitted
if (isset($_POST['update_prenatal_record'])) {
    // Get form inputs safely using prepared statements
    $resident_id = $_POST['resident_name'];
    $checkup_date = $_POST['checkup_date'];
    $gestational_age = $_POST['gestational_age'];
    $blood_pressure = $_POST['blood_pressure'];
    $weight = $_POST['weight'];
    $fetal_heartbeat = $_POST['fetal_heartbeat'];
    $remarks = $_POST['remarks'];

    // Update the prenatal record safely using prepared statements
    $query_update = $conn->prepare("UPDATE prenatal 
                                    SET resident_id = ?, checkup_date = ?, 
                                        gestational_age = ?, blood_pressure = ?, 
                                        weight = ?, fetal_heartbeat = ?, remarks = ?
                                    WHERE id = ?");
    $query_update->bind_param('issssssi', $resident_id, $checkup_date, $gestational_age, $blood_pressure, $weight, $fetal_heartbeat, $remarks, $prenatal_id);

    if ($query_update->execute()) {
        echo "<script>alert('Prenatal record updated successfully.'); window.location.href='prenatal_records.php';</script>";
    } else {
        echo "<script>alert('Error updating prenatal record.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-name" content="focus" />
    <title>Update Prenatal Record | CareVisio</title>
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
                                <a href="../services6.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Prenatal Records</h7>
                                </a>
                                <h1>Update Prenatal Record</h1>
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
                    <form action="update_prenatal_record.php?id=<?php echo $prenatal_id; ?>" method="post">
                        <div class="row">
                            <div class="sectioning">
                                <br>
                                <p>Please update all fields marked by asterisks (<span class="req">*</span>)</p>
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
                                                while ($row = $result_residents->fetch_assoc()) {
                                                    $selected = ($row['id'] == $prenatal_data['resident_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['fname'] . ' ' . $row['lname'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>Checkup Details</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="checkup_date">Checkup Date<span class="req">*</span></label><br>
                                            <input type="date" name="checkup_date" id="checkup_date" value="<?php echo $prenatal_data['checkup_date']; ?>" required>
                                        </th>
                                        <th>
                                            <label for="gestational_age">Gestational Age<span class="req">*</span></label><br>
                                            <input type="text" name="gestational_age" id="gestational_age" value="<?php echo $prenatal_data['gestational_age']; ?>" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="blood_pressure">Blood Pressure<span class="req">*</span></label><br>
                                            <input type="text" name="blood_pressure" id="blood_pressure" value="<?php echo $prenatal_data['blood_pressure']; ?>" required>
                                        </th>
                                        <th>
                                            <label for="weight">Weight (kg)<span class="req">*</span></label><br>
                                            <input type="text" name="weight" id="weight" value="<?php echo $prenatal_data['weight']; ?>" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="fetal_heartbeat">Fetal Heartbeat<span class="req">*</span></label><br>
                                            <input type="text" name="fetal_heartbeat" id="fetal_heartbeat" value="<?php echo $prenatal_data['fetal_heartbeat']; ?>" required>
                                        </th>
                                        <th>
                                            <label for="remarks">Remarks</label><br>
                                            <textarea name="remarks" id="remarks"><?php echo $prenatal_data['remarks']; ?></textarea>
                                        </th>
                                    </tr>
                                </table>
                                <br>
                                <button type="submit" name="update_prenatal_record">Update</button>
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

                            .row {
                                position: relative;
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
    <!-- nano scroller -->
    <script src="../js/lib/menubar/sidebar.js"></script>
    <script src="../js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../js/lib/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>

</body>
</html>
