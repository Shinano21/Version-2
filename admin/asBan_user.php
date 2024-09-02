<?php
include "../dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userId = $_POST['user_id']; // Get the user ID from the form

    $status = $_POST["status"];
    // Update the account status 
    $sql = "UPDATE administrator SET a_status=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "si", $status, $userId);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Check if the update was successful
    if(mysqli_stmt_affected_rows($stmt) > 0){
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        // Display alert and redirect
        echo '<script>';
        echo 'alert("Account status updated successfully!");';
        echo 'window.location.href = "asManageUsers.php";';  // Redirect after displaying the alert
        echo '</script>';
        exit();
    } else {
        echo "Failed to update account status.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Close the connection
    mysqli_close($conn);
}
?>
