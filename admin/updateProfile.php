<?php
include "../dbcon.php";
session_start();
$unique_id = $_SESSION["unique_id"];

if (isset($_POST["submit"])) {
    $fname = $_POST["fname"];
    $mname = isset($_POST["mname"]) ? $_POST["mname"] : '';
    $lname = $_POST["lname"];
    $email = $_POST["email"];

    // Update other fields (fname, mname, lname, bday) even if the profile picture is not provided
    $userUpdateSql = "UPDATE `users` SET `fname` = ?, `mname` = ?, `lname` = ?, `email` = ? WHERE `unique_id` = ?";
    $userUpdateStmt = mysqli_prepare($conn, $userUpdateSql);

    // Bind parameters for user table update
    mysqli_stmt_bind_param($userUpdateStmt, "sssss", $fname, $mname, $lname, $email, $unique_id);

    // Execute the user table update
    mysqli_stmt_execute($userUpdateStmt);

    // Check if the update was successful
    if (mysqli_stmt_affected_rows($userUpdateStmt) > 0) {
        // You can add another SQL query to update the administrator table
        $adminUpdateSql = "UPDATE `administrator` SET `fname` = ?, `mname` = ?, `lname` = ?, `email` = ? WHERE `unique_id` = ?";
        $adminUpdateStmt = mysqli_prepare($conn, $adminUpdateSql);

        // Bind parameters for administrator table update
        mysqli_stmt_bind_param($adminUpdateStmt, "sssss", $fname, $mname, $lname, $email, $unique_id);

        // Execute the administrator table update
        mysqli_stmt_execute($adminUpdateStmt);

        // Check if the update was successful
        if (mysqli_stmt_affected_rows($adminUpdateStmt) > 0) {
            echo '<script>';
            echo 'alert("Profile updated successfully!");';
            echo 'window.location.href = "edit_admin_profile.php";';
            echo '</script> ';
            exit();
        } else {
            // Redirect with an error message or appropriate handling for administrator table update
            header("Location: update_error.php");
            exit();
        }
    } else {
        // Redirect with an error message or appropriate handling for user table update
        header("Location: update_error.php");
        exit();
    }
}
?>
