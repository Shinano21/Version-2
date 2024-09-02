<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $announceType = $_POST["announce_type"];
    $announceHeading = $_POST["announce_heading"];
    $announceBody = $_POST["announce_body"];
    $announcePic = file_get_contents($_FILES["announce_pic"]["tmp_name"]);
    $sql = "INSERT INTO `announcements` (`announce_type`, `announce_heading`, `announce_body`, `announce_pic`, `post_date`) 
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $announceType, $announceHeading, $announceBody, $announcePic);
    mysqli_stmt_execute($stmt);
    
    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Display a pop-up success message using JavaScript
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsAnnouncementsSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script>';
    } else {
        // Redirect with an error message or appropriate handling
        header("Location: update_error.php");
        exit();
    }
    

}

?>