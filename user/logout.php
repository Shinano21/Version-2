<?php
// User logout process
session_start();
include_once 'dbcon.php';

if (isset($_SESSION['user_unique_id'])) {
    $status = "Offline now";
    $logout_id = $_SESSION['user_unique_id'];
    $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id='{$logout_id}'");

    if ($sql) {
        // Unset user session variables
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_lastname']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_unique_id']);
    } else {
        echo "No log out ID";
    }
}

// Redirect to the login page or any other desired page after logout
header("Location: ../index.php");
exit();

?>