<?php
session_start();
include "../dbcon.php";

// Check if the user is logged in
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $resident_id = mysqli_real_escape_string($conn, $_POST['resident_id']);
    $checkup_date = mysqli_real_escape_string($conn, $_POST['checkup_date']);
    $medicine_name = mysqli_real_escape_string($conn, $_POST['medicine_name']);
    $medicine_type = mysqli_real_escape_string($conn, $_POST['medicine_type']);
    $quantity = (int)mysqli_real_escape_string($conn, $_POST['quantity']);
    $blood_pressure = mysqli_real_escape_string($conn, $_POST['blood_pressure']);
    $remarks_type = mysqli_real_escape_string($conn, $_POST['remarks_type']);

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert into hypertension table
        $query = "INSERT INTO hypertension (resident_id, checkup_date, medicine_name, medicine_type, quantity, blood_pressure, remarks_type) 
                  VALUES ('$resident_id', '$checkup_date', '$medicine_name', '$medicine_type', '$quantity', '$blood_pressure', '$remarks_type')";
        mysqli_query($conn, $query);

        // Update medicine inventory
        $update_inventory = "UPDATE medicine_inventory 
                             SET quantity = quantity - $quantity 
                             WHERE medicine_name = '$medicine_name' AND medicine_type = '$medicine_type' AND quantity >= $quantity";
        $update_result = mysqli_query($conn, $update_inventory);

        if (mysqli_affected_rows($conn) <= 0) {
            throw new Exception("Failed to update inventory. Medicine may not be available or insufficient quantity.");
        }

        // Insert into medicine_log table
        $log_query = "INSERT INTO medicine_log (resident_id, medicine_name, medicine_type, quantity, checkup_date) 
                      VALUES ('$resident_id', '$medicine_name', '$medicine_type', '$quantity', '$checkup_date')";
        mysqli_query($conn, $log_query);

        // Commit transaction
        mysqli_commit($conn);

        $_SESSION['message'] = "Hypertension record and medicine log added successfully!";
        header("Location: ../services8.php");
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../services8.php");
        exit();
    }
}

// Close database connection
mysqli_close($conn);
?>