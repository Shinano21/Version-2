<?php
session_start();
include "dbcon.php";

// Redirect if user is not logged in or user type is System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Query to fetch residents from the database
$query = "SELECT id, fname, lname FROM residents";
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
    <title>Add Hypertension Record | CareVisio</title>
    <?php include "head.php"; ?>
</head>

<body onload="display_ct();">

    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                        <h1>Hypertension Record</h1>
                        <h6>Add New Hypertension Record</h6>
                    </div>
                </div>

                <section id="main-content">
                    <div class="form-container">
                        <form action="addHypertension.php" method="POST">
                            <div class="form-group">
                                <label for="resident_name">Resident Name:<span class="req">*</span></label>
                                <select name="resident_id" id="resident_name" required>
                                    <option value="">Select Resident</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['id'] . '">' . $row['fname'] . ' ' . $row['lname'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="checkup_date">Checkup Date:<span class="req">*</span></label>
                                <input type="date" id="checkup_date" name="checkup_date" required>
                            </div>
                            <div class="form-group">
                                <label for="medicine_type">Medicine Type:</label>
                                <input type="text" id="medicine_type" name="medicine_type">
                            </div>
                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure:<span class="req">*</span></label>
                                <input type="text" id="blood_pressure" name="blood_pressure" required>
                            </div>
                            <div class="form-group">
                                <label for="remarks_type">Remarks:</label>
                                <textarea id="remarks_type" name="remarks_type"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-btn">Add Record</button>
                            </div>
                        </form>
                    </div>

                    <!-- Displaying Records -->
                    <div class="record-display">
                        <h2>Hypertension Records</h2>
                        <table class="table-records">
                            <thead>
                                <tr>
                                    <th>Resident Name</th>
                                    <th>Checkup Date</th>
                                    <th>Medicine Type</th>
                                    <th>Blood Pressure</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include "data/showHypertension.php"; ?> <!-- Fetch and display hypertension records -->
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="js/scripts.js"></script> <!-- Link your JS file -->

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
        th, td {
            padding: 10px;
        }
        .form-container, .record-display {
            padding: 20px;
            background-color: #f9f9fd;
            box-shadow: 0px 0px 2px gray;
            border-radius: 10px;
            width: 100%;
            margin-bottom: 20px;
        }
        .table-records {
            width: 100%;
            border-collapse: collapse;
        }
        .table-records th, .table-records td {
            border: 1px solid #ddd;
        }
    </style>

</body>
</html>
