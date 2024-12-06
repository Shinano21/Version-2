<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $BHTName = $_POST["BHT_name"];
    $BHTPosition = $_POST["BHT_position"];
    
    // Handle file upload
    $uploadDir = "uploads/"; // Directory to save uploaded files
    $BHTPicName = $_FILES["BHT_pic"]["name"]; // Get the file name
    $BHTPicPath = $uploadDir . basename($BHTPicName);

    // Move the uploaded file to the server
    if (move_uploaded_file($_FILES["BHT_pic"]["tmp_name"], $BHTPicPath)) {
        $sql = "INSERT INTO `brgy_health` (`name`, `position`, `pic`) 
                VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $BHTName, $BHTPosition, $BHTPicName);
        mysqli_stmt_execute($stmt);

        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo '<script>';
            echo 'alert("Saved successfully!");';
            echo 'window.location.href = "../wsAboutSettings.php";';  // Redirect after success
            echo '</script>';
        } else {
            header("Location: update_error.php");
            exit();
        }
    } else {
        echo '<script>';
        echo 'alert("Error uploading the file.");';
        echo 'window.history.back();';  // Redirect back to the form
        echo '</script>';
    }
}
?>
