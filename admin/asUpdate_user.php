<?php
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userId = $_POST['user_id'];

    // Collect updated user data from the form
    $firstName = $_POST["fname"];
    $midName = isset($_POST["mname"]) ? $_POST["mname"] : null;
    $lastName = $_POST["lname"];
    $cpNum = $_POST["contact"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = '';
    $position = $_POST["position"];

    // Check if user password needs to be updated or retained
    $query = "SELECT password FROM administrator WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $currentPass = $row['password'];

            if ($currentPass == $password) {
                $hashedPassword = $password;
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            }
        } else {
            header("Location: user_not_found.php");
            exit();
        }
    } else {
        header("Location: db_error.php");
        exit();
    }

    // Update the user data in the 'administrator' table
    $sql = "UPDATE administrator SET firstname=?, midname=?, lastname=?, cpnumber=?, email=?, password=?, user_type=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssi", $firstName, $midName, $lastName, $cpNum, $email, $hashedPassword, $position, $userId);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo '<script>';
            echo 'alert("Account updated successfully!");';
            echo 'window.location.href = "asManageUsers.php";';
            echo '</script>';
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
            header("Location: update_error.php");
            exit();
        }
    } else {
        header("Location: db_error.php");
        exit();
    }
}
?>
