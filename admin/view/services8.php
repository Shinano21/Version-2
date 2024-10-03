<?php
session_start();
include "../dbcon.php";

// Redirect if the user is not logged in or user type is System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Get the hypertension record ID from the query string
if (isset($_GET['id'])) {
    $hypertension_id = $_GET['id'];

    // Fetch the existing hypertension record based on ID
    $query = "SELECT * FROM hypertension WHERE hypertension_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $hypertension_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found!";
        exit();
    }

    // Fetch residents for the dropdown list
    $resident_query = "SELECT id, fname, lname FROM residents";
    $resident_result = mysqli_query($conn, $resident_query);
} else {
    echo "Invalid request!";
    exit();
}

// Handle the form submission to update the record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resident_id = $_POST['resident_id'];
    $checkup_date = $_POST['checkup_date'];
    $medicine_type = $_POST['medicine_type'];
    $blood_pressure = $_POST['blood_pressure'];
    $remarks_type = $_POST['remarks_type'];

    // Update the hypertension record
    $update_query = "UPDATE hypertension SET resident_id = ?, checkup_date = ?, medicine_type = ?, blood_pressure = ?, remarks_type = ? WHERE hypertension_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("issssi", $resident_id, $checkup_date, $medicine_type, $blood_pressure, $remarks_type, $hypertension_id);

    if ($update_stmt->execute()) {
        header("Location: ../services8.php"); // Redirect after update
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
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
    <title>Update Hypertension Record | CareVisio</title>
    <?php include "head.php"; ?>
</head>

<body>
    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                        <h1>Hypertension Record</h1>
                        <h6>Update Hypertension Record</h6>
                    </div>
                </div>

                <section id="main-content">
                    <div class="form-container">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="resident_name">Resident Name:<span class="req">*</span></label>
                                <select name="resident_id" id="resident_name" required>
                                    <option value="">Select Resident</option>
                                    <?php
                                    while ($resident_row = mysqli_fetch_assoc($resident_result)) {
                                        $selected = ($resident_row['id'] == $row['resident_id']) ? 'selected' : '';
                                        echo '<option value="' . $resident_row['id'] . '" ' . $selected . '>' . $resident_row['fname'] . ' ' . $resident_row['lname'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="checkup_date">Checkup Date:<span class="req">*</span></label>
                                <input type="date" id="checkup_date" name="checkup_date" value="<?php echo $row['checkup_date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="medicine_type">Medicine Type:</label>
                                <input type="text" id="medicine_type" name="medicine_type" value="<?php echo $row['medicine_type']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure:<span class="req">*</span></label>
                                <input type="text" id="blood_pressure" name="blood_pressure" value="<?php echo $row['blood_pressure']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="remarks_type">Remarks:</label>
                                <textarea id="remarks_type" name="remarks_type"><?php echo $row['remarks_type']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-btn">Update Record</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
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
        .form-container {
            padding: 20px;
            background-color: #f9f9fd;
            box-shadow: 0px 0px 2px gray;
            border-radius: 10px;
            width: 100%;
        }
    </style>

</body>
</html>
