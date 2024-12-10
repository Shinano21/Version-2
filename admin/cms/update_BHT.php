<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $BHTname = $_POST["BHT_name"];
    $BHTposition = $_POST["BHT_position"];

    // Handle file upload
    $target_dir = "uploads/";
    $filename = basename($_FILES["BHT_pic"]["name"]);
    $target_file = $target_dir . $filename;
    
    if (move_uploaded_file($_FILES["BHT_pic"]["tmp_name"], $target_file)) {
        // Save only the filename to the database
        $sql = "UPDATE `brgy_health` SET `name` = ?, `position` = ?, `pic` = ? WHERE `id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $BHTname, $BHTposition, $filename, $id);
        mysqli_stmt_execute($stmt);

        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo '<script>';
            echo 'alert("Saved successfully!");';
            echo 'window.location.href = "../wsAboutSettings.php";';
            echo '</script>';
        } else {
            header("Location: update_error.php");
            exit();
        }
    } else {
        echo '<script>';
        echo 'alert("File upload failed.");';
        echo 'window.history.back();';
        echo '</script>';
    }
}
?>
