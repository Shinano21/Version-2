<?php
// Start the session
session_start();
include_once 'dbcon.php';

// Check if the user is logged in and has a unique_id
if (isset($_SESSION['unique_id'])) {
    $status = "Offline now";
    $logout_id = $_SESSION['unique_id'];

    // Update the status in the `administrator` table instead of `users`
    $sql = mysqli_query($conn, "UPDATE administrator SET status = '{$status}' WHERE id='{$logout_id}'");

    if ($sql) {
        // Unset all of the session variables
        $_SESSION = array();
        session_unset();
        session_destroy();
    } else {
        echo "Failed to update logout status";
    }
}

// Redirect to the login page or any other desired page after logout
header("Location: index.php");
exit();
?>
