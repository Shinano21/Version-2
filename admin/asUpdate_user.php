<?php
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userId = $_POST['user_id']; // Get the user ID from the form

    // Collect updated user data from the form
    $firstName = $_POST["fname"];
    $midName = isset($_POST["mname"]) ? $_POST["mname"] : null;
    $lastName = $_POST["lname"];
    $cpNum = $_POST["contact"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = '';
    $position = $_POST["position"];
    $uniqueId = $_POST["unique_id"];

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
            // Handle the case when the user is not found
            header("Location: user_not_found.php");
            exit();
        }
    } else {
        // Handle database errors
        header("Location: db_error.php");
        exit();
    }

    // Update the user data in the 'administrator' table
    $sql = "UPDATE administrator SET fname=?, mname=?, lname=?, cpnumber=?, email=?, password=?, user_type=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssi", $firstName, $midName, $lastName, $cpNum, $email, $hashedPassword, $position, $userId);
        mysqli_stmt_execute($stmt);

        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Update the 'users' table
            $adminUpdateSql = "UPDATE users SET fname=?, mname=?, lname=?, email=?, password=? WHERE unique_id=?";
            $adminUpdateStmt = mysqli_prepare($conn, $adminUpdateSql);

            if ($adminUpdateStmt) {
                mysqli_stmt_bind_param($adminUpdateStmt, "ssssss", $firstName, $midName, $lastName, $email, $hashedPassword, $uniqueId);
                mysqli_stmt_execute($adminUpdateStmt);

                // Check if the update was successful
                if (mysqli_stmt_affected_rows($adminUpdateStmt) > 0) {
                    echo '<script>';
                    echo 'alert("Account updated successfully!");';
                    echo 'window.location.href = "asManageUsers.php";';  // Optional: Redirect after displaying the alert
                    echo '</script>';
                    exit();
                } else {
                    // Redirect with an error message or appropriate handling
                    echo "Error: " . mysqli_error($conn);
                    exit();
                }
            } else {
                // Handle prepared statement error
                echo "Prepared statement error: " . mysqli_error($conn);
                exit();
            }
        } else {
            // Redirect with an error message or appropriate handling
            echo "Error: " . mysqli_error($conn);
            header("Location: update_error.php");
            exit();
        }
    } else {
        // Handle database errors
        header("Location: db_error.php");
        exit();
    }
}
?>
