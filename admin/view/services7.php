<?php
session_start();
include "../dbcon.php"; // Database connection

// Ensure the user is authenticated
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

// Get the record ID from the URL
$prenatal_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($prenatal_id <= 0) {
    echo "Invalid prenatal record ID.";
    exit();
}

// Handle form submission
if (isset($_POST['update_prenatal_record'])) {
    // Sanitize and collect form inputs
    $resident_id = mysqli_real_escape_string($conn, $_POST['resident_id']);
    $checkup_date = mysqli_real_escape_string($conn, $_POST['checkup_date']);
    $gestational_age = intval($_POST['gestational_age']);
    $blood_pressure = mysqli_real_escape_string($conn, $_POST['blood_pressure']);
    $weight = floatval($_POST['weight']);
    $fetal_heartbeat = mysqli_real_escape_string($conn, $_POST['fetal_heartbeat']);
    $calcium_supplementation = isset($_POST['calcium_supplementation']) ? 1 : 0;
    $iodine_capsules = isset($_POST['iodine_capsules']) ? 1 : 0;
    $deworming_tablets = isset($_POST['deworming_tablets']) ? 1 : 0;
    $syphilis_screened = isset($_POST['syphilis_screened']) ? 1 : 0;
    $syphilis_positive = isset($_POST['syphilis_positive']) ? 1 : 0;
    $hepB_screened = isset($_POST['hepB_screened']) ? 1 : 0;
    $hepB_positive = isset($_POST['hepB_positive']) ? 1 : 0;
    $hiv_screened = isset($_POST['hiv_screened']) ? 1 : 0;
    $cbc_tested = isset($_POST['cbc_tested']) ? 1 : 0;
    $cbc_anemia = isset($_POST['cbc_anemia']) ? 1 : 0;
    $gestational_diabetes_screened = isset($_POST['gestational_diabetes_screened']) ? 1 : 0;
    $gestational_diabetes_positive = isset($_POST['gestational_diabetes_positive']) ? 1 : 0;
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    // Update the prenatal record in the database
    $update_query = "
        UPDATE prenatal 
        SET 
            resident_id = '$resident_id', 
            checkup_date = '$checkup_date', 
            gestational_age = '$gestational_age',
            blood_pressure = '$blood_pressure',
            weight = '$weight',
            fetal_heartbeat = '$fetal_heartbeat',
            calcium_supplementation = '$calcium_supplementation',
            iodine_capsules = '$iodine_capsules',
            deworming_tablets = '$deworming_tablets',
            syphilis_screened = '$syphilis_screened',
            syphilis_positive = '$syphilis_positive',
            hepB_screened = '$hepB_screened',
            hepB_positive = '$hepB_positive',
            hiv_screened = '$hiv_screened',
            cbc_tested = '$cbc_tested',
            cbc_anemia = '$cbc_anemia',
            gestational_diabetes_screened = '$gestational_diabetes_screened',
            gestational_diabetes_positive = '$gestational_diabetes_positive',
            remarks = '$remarks'
        WHERE prenatal_id = $prenatal_id
    ";

    if (mysqli_query($conn, $update_query)) {
        // Redirect after successful update
        header("Location: ../services7.php?success=1");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch the existing record data
$record_query = "SELECT * FROM prenatal WHERE prenatal_id = $prenatal_id";
$record_result = mysqli_query($conn, $record_query);

if (mysqli_num_rows($record_result) == 0) {
    echo "Record not found.";
    exit();
}

$record = mysqli_fetch_assoc($record_result);

// Fetch residents for the dropdown
$residents_query = "SELECT id, fname, lname FROM residents";
$residents_result = mysqli_query($conn, $residents_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Prenatal Record</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .checkbox-group label {
            font-weight: normal;
        }

        .form-actions {
            text-align: center;
        }

        .form-actions button {
            padding: 12px 25px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-actions button:hover {
            background-color: #45a049;
        }

        .req {
            color: red;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-actions button {
                width: 100%;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Update Prenatal Record</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="resident_id">Resident Name <span class="req">*</span></label>
                <select name="resident_id" id="resident_id" class="select2" required>
                    <option value="">Select Resident</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($residents_result)) {
                        $selected = ($row['id'] == $record['resident_id']) ? 'selected' : '';
                        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['fname'] . ' ' . $row['lname'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="checkup_date">Checkup Date <span class="req">*</span></label>
                <input type="date" name="checkup_date" id="checkup_date" value="<?php echo $record['checkup_date']; ?>" required>
            </div>

            <div class="form-group">
                <label for="gestational_age">Gestational Age (weeks)</label>
                <input type="number" name="gestational_age" id="gestational_age" value="<?php echo $record['gestational_age']; ?>">
            </div>

            <div class="form-group">
                <label for="blood_pressure">Blood Pressure <span class="req">*</span></label>
                <input type="text" name="blood_pressure" id="blood_pressure" value="<?php echo $record['blood_pressure']; ?>" required>
            </div>

            <div class="form-group">
                <label for="weight">Weight (kg) <span class="req">*</span></label>
                <input type="number" name="weight" id="weight" step="0.01" value="<?php echo $record['weight']; ?>" required>
            </div>

            <div class="form-group">
                <label for="fetal_heartbeat">Fetal Heartbeat <span class="req">*</span></label>
                <input type="text" name="fetal_heartbeat" id="fetal_heartbeat" value="<?php echo $record['fetal_heartbeat']; ?>" required>
            </div>

            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea name="remarks" id="remarks"><?php echo $record['remarks']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Additional Services</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="calcium_supplementation" <?php echo $record['calcium_supplementation'] ? 'checked' : ''; ?>> Calcium Supplementation</label>
                    <label><input type="checkbox" name="iodine_capsules" <?php echo $record['iodine_capsules'] ? 'checked' : ''; ?>> Iodine Capsules</label>
                    <label><input type="checkbox" name="deworming_tablets" <?php echo $record['deworming_tablets'] ? 'checked' : ''; ?>> Deworming Tablets</label>
                    <label><input type="checkbox" name="syphilis_screened" <?php echo $record['syphilis_screened'] ? 'checked' : ''; ?>> Syphilis Screened</label>
                    <label><input type="checkbox" name="hepB_screened" <?php echo $record['hepB_screened'] ? 'checked' : ''; ?>> Hepatitis B Screened</label>
                    <label><input type="checkbox" name="hiv_screened" <?php echo $record['hiv_screened'] ? 'checked' : ''; ?>> HIV Screened</label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" name="update_prenatal_record">Update Prenatal Record</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Select a resident",
                allowClear: true
            });
        });
    </script>
</body>

</html>
