<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] !== "System Administrator") {
    header("Location: index.php");
    exit();
}

include "dbcon.php";
$query = "SET GLOBAL max_allowed_packet=1000000000";
mysqli_query($conn, $query);

if (isset($_POST["submit"])) {
    $status = $_POST["status"];
    $firstName = $_POST["fname"];
    $midName = isset($_POST["mname"]) ? $_POST["mname"] : null;
    $lastName = $_POST["lname"];
    $cpNum = $_POST["contact"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $position = $_POST["position"];
    $user_type = $_POST["type"];
    $ran_id = rand(time(), 100000000);

    // Insert into 'administrator' table
    $sqlAdmin = "INSERT INTO `administrator` (`firstname`, `midname`, `lastname`, `cpnumber`, `email`, `password`, `user_type`, `a_status`) VALUES (?, IFNULL(?, ''), ?, ?, ?, ?, ?, ?)";
    $stmtAdmin = mysqli_prepare($conn, $sqlAdmin);

    if ($stmtAdmin) {
        mysqli_stmt_bind_param($stmtAdmin, "ssssssss", $firstName, $midName, $lastName, $cpNum, $email, $hashedPassword, $position, $status);
        mysqli_stmt_execute($stmtAdmin);

        if (mysqli_stmt_affected_rows($stmtAdmin) > 0) {
            // Insert into 'users' table
            $sqlUsers = "INSERT INTO `users` (`first_name`, `middle_name`, `last_name`, `email`, `password`, `unique_id`, `user_type`) VALUES (?, IFNULL(?, ''), ?, ?, ?, ?, ?)";
            $stmtUsers = mysqli_prepare($conn, $sqlUsers);

            if ($stmtUsers) {
                mysqli_stmt_bind_param($stmtUsers, "sssssss", $firstName, $midName, $lastName, $email, $hashedPassword, $ran_id, $user_type);
                mysqli_stmt_execute($stmtUsers);

                if (mysqli_stmt_affected_rows($stmtUsers) > 0) {
                    echo '<script>';
                    echo 'alert("Account created successfully!");';
                    echo 'window.location.href = "asManageUsers.php";';  // Optional: Redirect after displaying the alert
                    echo '</script>';
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                    exit();
                }
            } else {
                echo "Prepared statement error for 'users' table: " . mysqli_error($conn);
                exit();
            }
        } else {
            header("Location: account_system.php?error=Error creating account");
            exit();
        }
    } else {
        header("Location: account_system.php?error=Database error");
        exit();
    }
}
?>
