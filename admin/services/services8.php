<?php
session_start();
include "dbcon.php";

// Redirect if user is not logged in or user type is System Administrator
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
    <title>Add Hypertension Record | CareVisio</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/tables.css"> <!-- Ensure to have styles for tables -->
</head>
<body onload="display_ct();">

    <?php
        if ($_SESSION["user_type"] == "System Administrator") {
            include "partials/admin_sidebar.php";
        } else {
            include "partials/sidebar.php";
        }
    ?>
    <?php include "partials/header.php" ?>

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
                                <label for="resident_id">Resident ID:</label>
                                <input type="number" id="resident_id" name="resident_id" required>
                            </div>
                            <div class="form-group">
                                <label for="checkup_date">Checkup Date:</label>
                                <input type="date" id="checkup_date" name="checkup_date" required>
                            </div>
                            <div class="form-group">
                                <label for="medicine_type">Medicine Type:</label>
                                <input type="text" id="medicine_type" name="medicine_type">
                            </div>
                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure:</label>
                                <input type="text" id="blood_pressure" name="blood_pressure">
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
                                    <th>Resident ID</th>
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
</body>
</html>

