<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $programType = $_POST["program_type"];
    $progHeading = $_POST["prog_heading"];
    $progBody = $_POST["prog_body"];
    $progPic = file_get_contents($_FILES["prog_pic"]["tmp_name"]);
    $sql = "INSERT INTO `programs` (`program_type`, `prog_heading`, `prog_body`, `prog_pic`, `post_date`) 
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $programType, $progHeading, $progBody, $progPic);
    mysqli_stmt_execute($stmt);
    
    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Display a pop-up success message using JavaScript
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsProgramSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script>';
    } else {
        // Redirect with an error message or appropriate handling
        header("Location: update_error.php");
        exit();
    }
    

}

?>