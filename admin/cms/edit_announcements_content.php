<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $announceType = $_POST["announce_type"];
    $announceHeading = $_POST["announce_heading"];
    $announceBody = $_POST["announce_body"];
    $file = $_FILES["announce_pic"];
    $fileName = basename($file["name"]); // Extract only the file name
    $targetDir = "uploads/";
    $targetFile = $targetDir . $fileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO `announcements` (`announce_type`, `announce_heading`, `announce_body`, `announce_pic`, `post_date`) 
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $announceType, $announceHeading, $announceBody, $fileName); // Bind the file name
        mysqli_stmt_execute($stmt);

        // Check if the insert was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Display a pop-up success message using JavaScript
            echo '<script>';
            echo 'alert("Saved successfully!");';
            echo 'window.location.href = "../wsAnnouncementsSettings.php";';  // Redirect after displaying the alert
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("Failed to save the announcement.");';
            echo 'window.location.href = "../wsAnnouncementsSettings.php";';
            echo '</script>';
        }
    } else {
        // Handle file upload error
        echo '<script>';
        echo 'alert("Failed to upload the image.");';
        echo 'window.location.href = "../wsAnnouncementsSettings.php";';
        echo '</script>';
    }
}
?>
