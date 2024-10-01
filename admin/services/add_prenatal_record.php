<?php
session_start();
include "../dbcon.php"; // Database connection

// Check if the user is logged in and not a System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $resident_id = mysqli_real_escape_string($conn, $_POST['resident_id']);
    $checkup_date = mysqli_real_escape_string($conn, $_POST['checkup_date']);
    $gestational_age = mysqli_real_escape_string($conn, $_POST['gestational_age']);
    $blood_pressure = mysqli_real_escape_string($conn, $_POST['blood_pressure']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $fetal_heartbeat = mysqli_real_escape_string($conn, $_POST['fetal_heartbeat']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    // Validate required fields
    if (!empty($resident_id) && !empty($checkup_date)) {
        // Prepare and execute SQL query to insert the new record
        $query = "INSERT INTO prenatal (resident_id, checkup_date, gestational_age, blood_pressure, weight, fetal_heartbeat, remarks) 
                  VALUES ('$resident_id', '$checkup_date', '$gestational_age', '$blood_pressure', '$weight', '$fetal_heartbeat', '$remarks')";

        if (mysqli_query($conn, $query)) {
            // Redirect to prenatal records page after successful insertion
            $_SESSION['message'] = "Prenatal record added successfully!";
            header("Location: ../prenatal_records.php");
            exit();
        } else {
            // Handle SQL error
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        // Handle missing required fields
        $_SESSION['error'] = "Please fill in all the required fields.";
        header("Location: ../services7.php");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
