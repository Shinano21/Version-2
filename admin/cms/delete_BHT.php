<?php
include "../dbcon.php";

if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    $sql = "DELETE FROM brgy_health WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../wsAboutSettings.php?deleted=success");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>