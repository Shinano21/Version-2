<?php
include "../dbcon.php";

if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    $sql = "DELETE FROM announcements WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo '<script>';
        echo 'alert("Announcement deleted successfully!");';
        echo 'window.location.href = "../wsAnnouncementsSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script> ';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>