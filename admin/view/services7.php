<?php
session_start();
include "../dbcon.php"; // Database connection

// Ensure the user is authenticated and not a System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Get the record ID from the URL (assuming it's passed as a GET parameter)
$record_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($record_id <= 0) {
    echo "Invalid record ID.";
    exit();
}

// Handle form submission
if (isset($_POST['update_prenatal_record'])) {
    $resident_id = mysqli_real_escape_string($conn, $_POST['resident_name']);
    $checkup_date = mysqli_real_escape_string($conn, $_POST['checkup_date']);
    $gestational_age = mysqli_real_escape_string($conn, $_POST['gestational_age']);
    $blood_pressure = mysqli_real_escape_string($conn, $_POST['blood_pressure']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $fetal_heartbeat = mysqli_real_escape_string($conn, $_POST['fetal_heartbeat']);
    $calcium_supplementation = isset($_POST['calcium_supplementation']) ? 1 : 0;
    $iodine_capsules = isset($_POST['iodine_capsules']) ? 1 : 0;
    $deworming_tablets = isset($_POST['deworming_tablets']) ? 1 : 0;
    $syphilis_screened = isset($_POST['syphilis_screened']) ? 1 : 0;
    $hepB_screened = isset($_POST['hepB_screened']) ? 1 : 0;
    $hiv_screened = isset($_POST['hiv_screened']) ? 1 : 0;
    $td_vaccination = isset($_POST['td_vaccination']) ? 1 : 0;
    $td2plus_vaccination = isset($_POST['td2plus_vaccination']) ? 1 : 0;
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    // Update the prenatal record in the database
   // Update the prenatal record in the database
$update_query = "
UPDATE prenatal 
SET resident_id = '$resident_id',
    checkup_date = '$checkup_date',
    gestational_age = '$gestational_age',
    blood_pressure = '$blood_pressure',
    weight = '$weight',
    fetal_heartbeat = '$fetal_heartbeat',
    calcium_supplementation = '$calcium_supplementation',
    iodine_capsules = '$iodine_capsules',
    deworming_tablets = '$deworming_tablets',
    syphilis_screened = '$syphilis_screened',
    hepB_screened = '$hepB_screened',
    hiv_screened = '$hiv_screened',
    td_vaccination = '$td_vaccination',
    td2plus_vaccination = '$td2plus_vaccination',
    remarks = '$remarks'
WHERE prenatal_id = $record_id";



    if (mysqli_query($conn, $update_query)) {
        header("Location: ../services7.php?success=1");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Query to fetch the existing record data based on the ID
$record_query = "SELECT * FROM prenatal WHERE prenatal_id = $record_id";
$record_result = mysqli_query($conn, $record_query);

if (mysqli_num_rows($record_result) == 0) {
    echo "Record not found.";
    exit();
}

$record = mysqli_fetch_assoc($record_result);

// Query to fetch residents for the dropdown
$residents_query = "SELECT id, fname, lname FROM residents";
$residents_result = mysqli_query($conn, $residents_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-name" content="focus" />
    <title>Update Prenatal Record | CareVisio</title>
    <?php include "../services/head.php"; ?>
</head>

<body onload="display_ct();">

    <?php include "../services/header.php"; ?>
    <?php include "../services/sidebar.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <a href="../services_prenatal.php">
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
                    <form action="services7.php?id=<?php echo $record_id; ?>" method="post">
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
                                                while ($row = mysqli_fetch_assoc($residents_result)) {
                                                    $selected = ($row['id'] == $record['resident_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['fname'] . ' ' . $row['lname'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>Prenatal Details</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="checkup_date">Checkup Date<span class="req">*</span></label><br>
                                            <input type="date" name="checkup_date" id="checkup_date" value="<?php echo $record['checkup_date']; ?>" required>
                                        </th>
                                        <th>
                                            <label for="gestational_age">Gestational Age (weeks)<span class="req">*</span></label><br>
                                            <input type="number" name="gestational_age" id="gestational_age" value="<?php echo $record['gestational_age']; ?>" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="blood_pressure">Blood Pressure<span class="req">*</span></label><br>
                                            <input type="text" name="blood_pressure" id="blood_pressure" value="<?php echo $record['blood_pressure']; ?>" required>
                                        </th>
                                        <th>
                                            <label for="weight">Weight (kg)<span class="req">*</span></label><br>
                                            <input type="number" step="0.01" name="weight" id="weight" value="<?php echo $record['weight']; ?>" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="fetal_heartbeat">Fetal Heartbeat<span class="req">*</span></label><br>
                                            <input type="text" name="fetal_heartbeat" id="fetal_heartbeat" value="<?php echo $record['fetal_heartbeat']; ?>" required>
                                        </th>
                                        <th>
                                            <label for="remarks">Remarks</label><br>
                                            <textarea name="remarks" id="remarks"><?php echo $record['remarks']; ?></textarea>
                                        </th>
                                    </tr>
                                    <tr>
                                    <tr>
    <th>
        <label>
            <input type="checkbox" name="calcium_supplementation" 
                <?php echo $record['calcium_supplementation'] ? 'checked' : ''; ?>> 
            Calcium Supplementation
        </label><br>
        
        <label>
            <input type="checkbox" name="iodine_capsules" 
                <?php echo $record['iodine_capsules'] ? 'checked' : ''; ?>> 
            Iodine Capsules
        </label><br>
        
        <label>
            <input type="checkbox" name="deworming_tablets" 
                <?php echo $record['deworming_tablets'] ? 'checked' : ''; ?>> 
            Deworming Tablets
        </label><br>
        
        <label>
            <input type="checkbox" name="syphilis_screened" 
                <?php echo $record['syphilis_screened'] ? 'checked' : ''; ?>> 
            Syphilis Screened
        </label><br>
        
        <label>
            <input type="checkbox" name="hepB_screened" 
                <?php echo $record['hepB_screened'] ? 'checked' : ''; ?>> 
            Hepatitis B Screened
        </label><br>
        
        <label>
            <input type="checkbox" name="hiv_screened" 
                <?php echo $record['hiv_screened'] ? 'checked' : ''; ?>> 
            HIV Screened
        </label><br>
        
        <label>
            <input type="checkbox" name="td_vaccination" 
                <?php echo $record['td_vaccination'] ? 'checked' : ''; ?>> 
            Td Vaccination
        </label><br>
        
        <label>
            <input type="checkbox" name="td2plus_vaccination" 
                <?php echo $record['td2plus_vaccination'] ? 'checked' : ''; ?>> 
            Td2 Plus Vaccination
        </label>
    </th>
</tr>

                                    </tr>
                                </table>
                                <br>
                                <button type="submit" name="update_prenatal_record">Update</button>
                                <br><br>
                                <hr>
                            </div>
                        </div>

                        <style>
                            body { overflow-x: hidden; }
                            button[type="submit"] {
                                padding: 10px 40px; border: none; box-shadow: 0px 0px 3px gray;
                                color: white; background-color: rgb(92, 84, 243); border-radius: 10px; float: right; margin: 1%;
                            }
                            textarea, input, select {
                                border: none; box-shadow: 0px 0px 2px gray; border-radius: 10px;
                                padding: 7px; width: 90%;
                            }
                            .req { color: red; }
                            table { width: 100%; }
                            th { padding: 10px; }
                            .sectioning {
                                padding: 20px; background-color: #f9f9fd;
                                box-shadow: 0px 0px 2px gray; border-radius: 10px; width: 100%;
                            }
                            .row { position: relative; }
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

    <script src="../js/lib/jquery.min.js"></script>
    <script src="../js/lib/jquery.nanoscroller.min.js"></script>
    <script src="../js/lib/menubar/sidebar.js"></script>
    <script src="../js/lib/preloader/pace.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>

</html>
