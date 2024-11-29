<?php
session_start();
include "../dbcon.php"; // Database connection

// Check if the user is logged in and is not a System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Initialize variables
$success = "";
$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_prenatal_record'])) {
    $resident_id = $_POST['resident_name'];
    $checkup_date = $_POST['checkup_date'];
    $gestational_age = $_POST['gestational_age'];
    $blood_pressure = $_POST['blood_pressure'];
    $weight = $_POST['weight'];
    $fetal_heartbeat = $_POST['fetal_heartbeat'];
    $remarks = $_POST['remarks'] ?? '';

    // Checkboxes
    $calcium_supplementation = isset($_POST['calcium_supplementation']) ? 1 : 0;
    $iodine_capsules = isset($_POST['iodine_capsules']) ? 1 : 0;
    $deworming_tablets = isset($_POST['deworming_tablets']) ? 1 : 0;
    $syphilis_screened = isset($_POST['syphilis_screened']) ? 1 : 0;
    $hepB_screened = isset($_POST['hepB_screened']) ? 1 : 0;
    $hiv_screened = isset($_POST['hiv_screened']) ? 1 : 0;
    $td_vaccination = isset($_POST['td_vaccination']) ? 1 : 0;
    $td2plus_vaccination = isset($_POST['td2plus_vaccination']) ? 1 : 0;

    // Insert record into the database
    $query = "
        INSERT INTO prenatal (
            resident_id, checkup_date, gestational_age, blood_pressure, weight, fetal_heartbeat,
            calcium_supplementation, iodine_capsules, deworming_tablets, syphilis_screened,
            hepB_screened, hiv_screened, td_vaccination, td2plus_vaccination, remarks
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "issdsssssssssss",
        $resident_id, $checkup_date, $gestational_age, $blood_pressure, $weight, $fetal_heartbeat,
        $calcium_supplementation, $iodine_capsules, $deworming_tablets, $syphilis_screened,
        $hepB_screened, $hiv_screened, $td_vaccination, $td2plus_vaccination, $remarks
    );

    if ($stmt->execute()) {
        $success = "Prenatal record added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Fetch residents for the dropdown
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
    <title>Add Prenatal Record | CareVisio</title>
    <?php include "head.php"; ?>
    <style>
        form {
            display: flex;
            flex-direction: column;
            max-width: auto;
            margin: 0 auto;
            background: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            color: #333;
        }

        form h3 {
            margin-bottom: 20px;
            text-align: center;
            color: #5a5a5a;
        }

        form p {
            font-size: 14px;
            color: #666;
        }

        form table {
            width: 100%;
            border-spacing: 0 15px;
        }

        form table th {
            text-align: left;
            padding: 8px;
            font-size: 14px;
            vertical-align: top;
        }

        form table th label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form table th input,
        form table th select,
        form table th textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        form table th textarea {
            height: 80px;
        }

        form table th input[type="checkbox"] {
            width: auto;
            margin-right: 5px;
        }

        form .button-container {
            display: flex;
            justify-content: flex-end;
        }

        form button {
            display: inline-block;
            padding: 10px 40px;
            background-color: rgb(92, 84, 243);
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }

        form button:active {
            transform: scale(0.98);
        }

        .req {
            color: red;
            font-weight: bold;
        }
    </style>
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
                </div>

                <section id="main-content">
                    <?php if ($success): ?>
                        <div style="color: green;"><?php echo $success; ?></div>
                    <?php endif; ?>
                    <?php if ($error): ?>
                        <div style="color: red;"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form action="services7.php" method="post">
                        <div>
                            <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>
                            <hr>
                            <table>
                                <tr>
                                    <th>
                                        <label for="resident_name">Resident Name<span class="req">*</span></label>
                                        <select name="resident_name" id="resident_name" required>
                                            <option value="">Select Resident</option>
                                            <?php while ($row = mysqli_fetch_assoc($residents_result)): ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="checkup_date">Checkup Date<span class="req">*</span></label>
                                        <input type="date" name="checkup_date" id="checkup_date" required>
                                    </th>
                                    <th>
                                        <label for="gestational_age">Gestational Age<span class="req">*</span></label>
                                        <input type="number" name="gestational_age" id="gestational_age" required>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="blood_pressure">Blood Pressure<span class="req">*</span></label>
                                        <input type="text" name="blood_pressure" id="blood_pressure" required>
                                    </th>
                                    <th>
                                        <label for="weight">Weight<span class="req">*</span></label>
                                        <input type="number" name="weight" id="weight" step="0.01" required>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="fetal_heartbeat">Fetal Heartbeat<span class="req">*</span></label>
                                        <input type="text" name="fetal_heartbeat" id="fetal_heartbeat" required>
                                    </th>
                                    <th>
                                        <label for="remarks">Remarks</label>
                                        <textarea name="remarks" id="remarks"></textarea>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <label><input type="checkbox" name="calcium_supplementation"> Calcium Supplementation</label><br>
                                        <label><input type="checkbox" name="iodine_capsules"> Iodine Capsules</label><br>
                                        <label><input type="checkbox" name="deworming_tablets"> Deworming Tablets</label><br>
                                        <label><input type="checkbox" name="syphilis_screened"> Syphilis Screened</label><br>
                                        <label><input type="checkbox" name="hepB_screened"> Hepatitis B Screened</label><br>
                                        <label><input type="checkbox" name="hiv_screened"> HIV Screened</label><br>
                                        <label><input type="checkbox" name="td_vaccination"> Td Vaccination</label><br>
                                        <label><input type="checkbox" name="td2plus_vaccination"> Td2 Plus Vaccination</label>
                                    </th>
                                </tr>
                            </table>
                            <div class="button-container">
                                <button type="submit" name="add_prenatal_record">Save Record</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

</body>

</html>
