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
    $medicine_type = mysqli_real_escape_string($conn, $_POST['medicine_type']);
    $blood_pressure = mysqli_real_escape_string($conn, $_POST['blood_pressure']);
    $remarks_type = mysqli_real_escape_string($conn, $_POST['remarks_type']);

    // Validate required fields
    if (!empty($resident_id) && !empty($checkup_date) && !empty($blood_pressure)) {
        // Prepare and execute SQL query to insert the new record
        $query = "INSERT INTO hypertension_records (resident_id, checkup_date, medicine_type, blood_pressure, remarks_type) 
                  VALUES ('$resident_id', '$checkup_date', '$medicine_type', '$blood_pressure', '$remarks_type')";

        if (mysqli_query($conn, $query)) {
            // Redirect to the hypertension records page after successful insertion
            $_SESSION['message'] = "Hypertension Record added successfully!";
            header("Location: ../services_hypertension.php");
            exit();
        } else {
            // Handle SQL error
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        // Handle missing required fields
        $_SESSION['error'] = "Please fill in all the required fields.";
        header("Location: services_hypertension.php");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
