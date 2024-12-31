<?php
include "dbcon.php";

if (isset($_GET["id"])) {
    $idx = $_GET["id"];

    // Check if the deletion is confirmed
    if (isset($_GET["confirm"]) && $_GET["confirm"] == "yes") {
        $sql = "DELETE FROM residents WHERE id = '$idx'";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: residents.php?deleted=success");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo '<script>
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "delete.php?id=' . $idx . '&confirm=yes";
            } else {
                window.location.href = "residents.php";
            }
        </script>';
    }
}
?>
