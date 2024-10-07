<?php
session_start();

// Ensure only system administrators can access
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] !== "System Administrator") {
    header("Location: index.php");
    exit();
}

include "dbcon.php";

$modalMessage = "";
$modalType = "";  // This will help us define success or failure

if (isset($_POST["submit"])) {
   // Collect form input safely
$status = "Active";  // Set a_status to Active
$firstName = $_POST["fname"];
$midName = isset($_POST["mname"]) ? $_POST["mname"] : null;
$lastName = $_POST["lname"];
$cpNum = $_POST["contact"];
$email = $_POST["email"];
$password = $_POST["password"];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);  // Hash password securely
$position = $_POST["position"];
$user_type = $_POST["type"];
$ran_id = bin2hex(random_bytes(16));  // More secure unique ID

// Prepared statement for 'administrator' table
$sqlAdmin = "INSERT INTO `administrator` (`firstname`, `midname`, `lastname`, `cpnumber`, `email`, `password`, `user_type`, `a_status`) VALUES (?, IFNULL(?, ''), ?, ?, ?, ?, ?, ?)";
$stmtAdmin = mysqli_prepare($conn, $sqlAdmin);

if ($stmtAdmin) {
    mysqli_stmt_bind_param($stmtAdmin, "ssssssss", $firstName, $midName, $lastName, $cpNum, $email, $hashedPassword, $position, $status);
    mysqli_stmt_execute($stmtAdmin);

    if (mysqli_stmt_affected_rows($stmtAdmin) > 0) {
        // Administrator account created successfully, proceed with inserting into 'users' table
    } else {
        // Log the exact error for diagnosing the problem
        $modalMessage = "Error creating administrator account: " . mysqli_error($conn);
        $modalType = "error";  // For error modal
    }
} else {
    // Log the exact error from preparing the statement
    $modalMessage = "Error preparing statement for administrator: " . mysqli_error($conn);
    $modalType = "error";  // For error modal
}


    // Close statements
    if ($stmtAdmin) mysqli_stmt_close($stmtAdmin);
    if (isset($stmtUsers)) mysqli_stmt_close($stmtUsers);  // Ensure $stmtUsers is defined before closing
}

// Close the database connection
mysqli_close($conn);

// Redirect back to the asAddUsers.php with success or error messages
if ($modalType === "success") {
    header("Location: asAddUsers.php?success=" . urlencode($modalMessage));
} else {
    header("Location: asAddUsers.php?error=" . urlencode($modalMessage));
}
exit();
?>
