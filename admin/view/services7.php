<?php
session_start();
include "../dbcon.php"; // Include the database connection

// Check if the user is logged in and is not a System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Initialize variables
$success = "";
$error = "";

// Check if the prenatal_id is passed in the URL
if (!isset($_GET['id'])) {
    echo "No record ID specified.";
    exit();
}

$prenatal_id = intval($_GET['id']);

// Fetch the existing record to populate the form
$query = "SELECT * FROM prenatal WHERE prenatal_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $prenatal_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Record not found.";
    exit();
}

$record = $result->fetch_assoc();

// Handle form submission for updating the record
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_prenatal_record'])) {
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

    // Update the record in the database
    $update_query = "
        UPDATE prenatal 
        SET resident_id = ?, checkup_date = ?, gestational_age = ?, blood_pressure = ?, weight = ?, 
            fetal_heartbeat = ?, calcium_supplementation = ?, iodine_capsules = ?, deworming_tablets = ?, 
            syphilis_screened = ?, hepB_screened = ?, hiv_screened = ?, td_vaccination = ?, 
            td2plus_vaccination = ?, remarks = ? 
        WHERE prenatal_id = ?
    ";

    $stmt = $conn->prepare($update_query);
    $stmt->bind_param(
        "issdsssssssssssi",
        $resident_id, $checkup_date, $gestational_age, $blood_pressure, $weight, $fetal_heartbeat,
        $calcium_supplementation, $iodine_capsules, $deworming_tablets, $syphilis_screened,
        $hepB_screened, $hiv_screened, $td_vaccination, $td2plus_vaccination, $remarks, $prenatal_id
    );

    if ($stmt->execute()) {
        $success = "Prenatal record updated successfully!";
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Prenatal Record | CareVisio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <section id="main-content">
                    <h1>Update Prenatal Record</h1>
                    <?php if ($success): ?>
                        <div style="color: green;"><?php echo $success; ?></div>
                    <?php endif; ?>
                    <?php if ($error): ?>
                        <div style="color: red;"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <table>
                            <tr>
                                <th>
                                    <label for="resident_name">Resident Name<span class="req">*</span></label>
                                    <select name="resident_name" id="resident_name" required>
                                        <option value="">Select Resident</option>
                                        <?php while ($row = mysqli_fetch_assoc($residents_result)): ?>
                                            <option value="<?php echo $row['id']; ?>" 
                                                <?php echo ($row['id'] == $record['resident_id']) ? 'selected' : ''; ?>>
                                                <?php echo $row['fname'] . ' ' . $row['lname']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="checkup_date">Checkup Date<span class="req">*</span></label>
                                    <input type="date" name="checkup_date" id="checkup_date" value="<?php echo $record['checkup_date']; ?>" required>
                                </th>
                                <th>
                                    <label for="gestational_age">Gestational Age<span class="req">*</span></label>
                                    <input type="number" name="gestational_age" id="gestational_age" value="<?php echo $record['gestational_age']; ?>" required>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="blood_pressure">Blood Pressure<span class="req">*</span></label>
                                    <input type="text" name="blood_pressure" id="blood_pressure" value="<?php echo $record['blood_pressure']; ?>" required>
                                </th>
                                <th>
                                    <label for="weight">Weight<span class="req">*</span></label>
                                    <input type="number" name="weight" id="weight" step="0.01" value="<?php echo $record['weight']; ?>" required>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="fetal_heartbeat">Fetal Heartbeat<span class="req">*</span></label>
                                    <input type="text" name="fetal_heartbeat" id="fetal_heartbeat" value="<?php echo $record['fetal_heartbeat']; ?>" required>
                                </th>
                                <th>
                                    <label for="remarks">Remarks</label>
                                    <textarea name="remarks" id="remarks"><?php echo $record['remarks']; ?></textarea>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label><input type="checkbox" name="calcium_supplementation" <?php echo $record['calcium_supplementation'] ? 'checked' : ''; ?>> Calcium Supplementation</label><br>
                                    <label><input type="checkbox" name="iodine_capsules" <?php echo $record['iodine_capsules'] ? 'checked' : ''; ?>> Iodine Capsules</label><br>
                                    <label><input type="checkbox" name="deworming_tablets" <?php echo $record['deworming_tablets'] ? 'checked' : ''; ?>> Deworming Tablets</label><br>
                                    <label><input type="checkbox" name="syphilis_screened" <?php echo $record['syphilis_screened'] ? 'checked' : ''; ?>> Syphilis Screened</label><br>
                                    <label><input type="checkbox" name="hepB_screened" <?php echo $record['hepB_screened'] ? 'checked' : ''; ?>> Hepatitis B Screened</label><br>
                                    <label><input type="checkbox" name="hiv_screened" <?php echo $record['hiv_screened'] ? 'checked' : ''; ?>> HIV Screened</label><br>
                                    <label><input type="checkbox" name="td_vaccination" <?php echo $record['td_vaccination'] ? 'checked' : ''; ?>> Td Vaccination</label><br>
                                    <label><input type="checkbox" name="td2plus_vaccination" <?php echo $record['td2plus_vaccination'] ? 'checked' : ''; ?>> Td2 Plus Vaccination</label>
                                </th>
                            </tr>
                        </table>
                        <button type="submit" name="update_prenatal_record">Update Record</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
