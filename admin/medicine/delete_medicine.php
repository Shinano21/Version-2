<?php
session_start();
include "../dbcon.php";

if (isset($_GET['id'])) {
    $medicine_id = $_GET['id'];
    $query = "DELETE FROM medicine_inventory WHERE medicine_id = $medicine_id";

    if (mysqli_query($conn, $query)) {
        header("Location: medicine_inventory.php?success=Medicine deleted successfully");
    } else {
        $error = "Error: " . mysqli_error($conn);
        header("Location: medicine_inventory.php?error=$error");
    }
} else {
    header("Location: medicine_inventory.php?error=Invalid medicine ID");
}
?>
