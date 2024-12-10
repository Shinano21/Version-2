<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    // Get file info
    $file = $_FILES["bg_img"];
    $fileName = basename($file["name"]); // Extract the filename
    $targetDir = "uploads/";
    $targetFile = $targetDir . $fileName;

    // Move uploaded file to the target directory
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Check if there are any existing records
        $result = $conn->query("SELECT COUNT(*) as count FROM home");
        $row = $result->fetch_assoc();

        if ($row['count'] == 0) {
            $sql = "INSERT INTO `home` (`announce_pic`) VALUES (?)";
        } else {
            $sql = "UPDATE `home` SET `announce_pic` = ?";
        }

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $fileName); // Save only the filename
        mysqli_stmt_execute($stmt);

        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo '<script>';
            echo 'alert("Saved successfully!");';
            echo 'window.location.href = "../wsAnnouncementsSettings.php";';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("Failed to save the announcement.");';
            echo 'window.location.href = "../wsAnnouncementsSettings.php";';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'alert("Failed to upload the image.");';
        echo 'window.location.href = "../wsAnnouncementsSettings.php";';
        echo '</script>';
    }
}
?>
