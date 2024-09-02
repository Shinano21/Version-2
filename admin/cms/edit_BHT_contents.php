<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $BHTName = $_POST["BHT_name"];
    $BHTPosition = $_POST["BHT_position"];
    $BHTPic = file_get_contents($_FILES["BHT_pic"]["tmp_name"]);
    $sql = "INSERT INTO `brgy_health` (`name`, `position`, `pic`) 
            VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $BHTName, $BHTPosition, $BHTPic);
    mysqli_stmt_execute($stmt);
    
    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Display a pop-up success message using JavaScript
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsAboutSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script>';
    } else {
        // Redirect with an error message or appropriate handling
        header("Location: update_error.php");
        exit();
    }
    

}

?>