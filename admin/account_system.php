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
    $time = time(); 
    $ran_id = rand(time(), 100000000);

    // Insert into 'administrator' table
    $sqlAdmin = "INSERT INTO `administrator` (`fname`, `mname`, `lname`, `cpnumber`, `email`, `password`, `user_type`, `unique_id`, `a_status`) VALUES (?, IFNULL(?, ''), ?, ?, ?, ?, ?, ?, ?)";
    $stmtAdmin = mysqli_prepare($conn, $sqlAdmin);

    if ($stmtAdmin) {
        mysqli_stmt_bind_param($stmtAdmin, "sssssssss", $firstName, $midName, $lastName, $cpNum, $email, $hashedPassword, $position, $ran_id, $status);
        mysqli_stmt_execute($stmtAdmin);

        if (mysqli_stmt_affected_rows($stmtAdmin) > 0) {
            // Insert into 'users' table
            $sqlUsers = "INSERT INTO `users` (`fname`, `mname`, `lname`, `email`, `password`, `unique_id`, `user_type`) VALUES (?, IFNULL(?, ''), ?, ?, ?, ?, ?)";
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
                    // Redirect with an error message or appropriate handling
                    echo "Error: " . mysqli_error($conn);
                    exit();
                }
            } else {
                // Handle prepared statement error for 'users' table
                echo "Prepared statement error: " . mysqli_error($conn);
                exit();
            }
        } else {
            // Redirect with an error message or appropriate handling
            header("Location: account_system.php?error=Error creating account");
            exit();
        }
    } else {
        // Handle prepared statement error for 'administrator' table
        header("Location: account_system.php?error=Database error");
        exit();
    }
}
?>
