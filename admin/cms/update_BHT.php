<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $BHTname = $_POST["BHT_name"];
    $BHTposition = $_POST["BHT_position"];
    $BHTpic = file_get_contents($_FILES["BHT_pic"]["tmp_name"]);
    $sql = "UPDATE `brgy_health` SET `name` = ?, `position` = ?, `pic` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $BHTname, $BHTposition, $BHTpic, $id);
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