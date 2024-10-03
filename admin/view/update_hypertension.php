<?php
session_start();
include "../dbcon.php";

// Redirect if the user is not logged in or user type is System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $hypertension_id = $_POST['hypertension_id'];
    $resident_id = $_POST['resident_id'];
    $checkup_date = $_POST['checkup_date'];
    $medicine_type = $_POST['medicine_type'];
    $blood_pressure = $_POST['blood_pressure'];
    $remarks_type = $_POST['remarks_type'];

    // Validate form data (you can add more validation rules here as needed)
    if (empty($resident_id) || empty($checkup_date) || empty($blood_pressure)) {
        echo "Required fields are missing.";
        exit();
    }

    // Prepare the SQL update query
    $update_query = "UPDATE hypertension SET resident_id = ?, checkup_date = ?, medicine_type = ?, blood_pressure = ?, remarks_type = ? WHERE hypertension_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("issssi", $resident_id, $checkup_date, $medicine_type, $blood_pressure, $remarks_type, $hypertension_id);

    // Execute the query and check if the update was successful
    if ($stmt->execute()) {
        // Redirect to the hypertension records page after successful update
        header("Location: hypertension_records.php?status=success");
        exit();
    } else {
        // Handle the error case
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Redirect if accessed without form submission
    header("Location: hypertension_records.php");
    exit();
}
?>
