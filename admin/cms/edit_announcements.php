<?php
include "../dbcon.php";
$data = $_POST["submit"];

$result = $conn->query("SELECT COUNT(*) FROM home");
$row = $result->fetch_assoc();
if (isset($_POST["submit"])) {

    $header = file_get_contents($_FILES["bg_img"]["tmp_name"]);
    if ($row['COUNT(*)'] == 0) {
        $sql = "INSERT INTO `home` (`announce_pic`)
        VALUES (?)";
    } else {
        $sql = "UPDATE `home` SET `announce_pic` = ?";
    }
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $header);
    mysqli_stmt_execute($stmt);
    
    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Display a pop-up success message using JavaScript
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsAnnouncementSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script>';
    } else {
        // Redirect with an error message or appropriate handling
        header("Location: update_error.php");
        exit();
    }
    

}

?>