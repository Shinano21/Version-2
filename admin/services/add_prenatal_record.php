<?php
session_start();
include "../dbcon.php";  // Database connection

// Check if the user is logged in and is not a System Administrator
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
} elseif ($_SESSION["user_type"] == "System Administrator") {
    // Redirect System Administrators away from this page
    header("Location: ../admin_dashboard.php");
    exit();
}

// Check if the form has been submitted
if (isset($_POST['add_prenatal_record'])) {
    // Retrieve and sanitize the form data
    $resident_id = mysqli_real_escape_string($conn, $_POST['resident_name']);
    $checkup_date = mysqli_real_escape_string($conn, $_POST['checkup_date']);
    $gestational_age = mysqli_real_escape_string($conn, $_POST['gestational_age']);
    $blood_pressure = mysqli_real_escape_string($conn, $_POST['blood_pressure']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $fetal_heartbeat = mysqli_real_escape_string($conn, $_POST['fetal_heartbeat']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    // Validation: Ensure required fields are filled
    if (empty($resident_id) || empty($checkup_date)) {
        $_SESSION['error'] = "Please fill out all required fields.";
        header("Location: ../services/services7.php"); // Redirect back to the form
        exit();
    }

    // Insert the prenatal record into the database
    $sql = "INSERT INTO prenatal (resident_id, checkup_date, gestational_age, blood_pressure, weight, fetal_heartbeat, remarks)
            VALUES ('$resident_id', '$checkup_date', '$gestational_age', '$blood_pressure', '$weight', '$fetal_heartbeat', '$remarks')";

    if (mysqli_query($conn, $sql)) {
        // Success: Record successfully inserted
        $_SESSION['success'] = "Prenatal record added successfully.";
        header("Location: ../services7.php");  // Redirect to the prenatal records list
        exit();
    } else {
        // Error during insertion
        $_SESSION['error'] = "Error adding prenatal record: " . mysqli_error($conn);
        header("Location: ../services/services7.php"); // Redirect back to the form
        exit();
    }
} else {
    // If accessed directly without form submission, redirect back to the form
    header("Location: ../services/services7.php");
    exit();
}
?>
