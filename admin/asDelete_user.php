<?php
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $userId = $_POST['user_id']; // Get the user ID to delete

    // Delete user from the database
    $sql = "DELETE FROM administrator WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo '<script>';
            echo 'alert("Account deleted successfully!");';
            echo 'window.location.href = "asManageUsers.php";';  // Optional: Redirect after displaying the alert
            echo '</script> ';
            exit();
        } else {
            // Redirect with an error message or appropriate handling
            header("Location: delete_error.php");
            exit();
        }
    } else {
        // Handle database errors
        header("Location: db_error.php");
        exit();
    }
}
?>
