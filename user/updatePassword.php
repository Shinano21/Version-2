<?php
include "../dbcon.php";
session_start();
$unique_id = $_SESSION["unique_id"];

if (isset($_POST["submit"])) {
    $old_pass = $_POST["old_password"];
    $new_pass = isset($_POST["new_password"]) ? $_POST["new_password"] : '';
    $confirm_pass = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : '';

    // Fetch the current hashed password from the 'users' table
    $sqlUsers = "SELECT `password` FROM `users` WHERE `unique_id` = ?";
    $stmtUsers = mysqli_prepare($conn, $sqlUsers);
    mysqli_stmt_bind_param($stmtUsers, "s", $unique_id);
    mysqli_stmt_execute($stmtUsers);
    mysqli_stmt_store_result($stmtUsers);

    if (mysqli_stmt_num_rows($stmtUsers) > 0) {
        mysqli_stmt_bind_result($stmtUsers, $hashedPassword);
        mysqli_stmt_fetch($stmtUsers);

        // Verify if the entered old password matches the stored hashed password
        if (password_verify($old_pass, $hashedPassword)) {
            // Old password is correct, proceed with the update in 'users' table
            $hashedNewPassword = password_hash($new_pass, PASSWORD_BCRYPT);

            $sqlUpdateUsers = "UPDATE `users` SET `password` = ? WHERE `unique_id` = ?";
            $stmtUpdateUsers = mysqli_prepare($conn, $sqlUpdateUsers);
            mysqli_stmt_bind_param($stmtUpdateUsers, "ss", $hashedNewPassword, $unique_id);
            mysqli_stmt_execute($stmtUpdateUsers);

            // Check if the update was successful in 'users' table
            if (mysqli_stmt_affected_rows($stmtUpdateUsers) > 0) {
                echo '<script>';
                echo 'alert("Password updated successfully!");';
                echo 'window.location.href = "editProfile.php";';  // Optional: Redirect after displaying the alert
                echo '</script>';
                exit();
            } else {
                // Redirect with an error message or appropriate handling for 'users' table
                echo "Error: " . mysqli_error($conn);
                exit();
            }
        } else {
            // Old password is incorrect, handle accordingly (display an error message, redirect, etc.)
            echo "Error: " . mysqli_error($conn);
            exit();
        }
    } else {
        // Handle the case where the user is not found in the 'users' table
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}
?>
