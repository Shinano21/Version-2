<?php
include "../dbcon.php";

if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    $sql = "DELETE FROM programs WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../wsProgramSettings.php?deleted=success");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>