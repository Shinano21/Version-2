<?php
include "dbcon.php";

$idx = $_GET["id"]; // Retrieve the resident's ID from the query string
$sql = "DELETE FROM residents WHERE id = '$idx'";

// Execute the delete query
if (mysqli_query($conn, $sql)) {
    header("Location: residents.php?deleted=success"); // Redirect with success message
    exit();
} else {
    echo "Error: Unable to delete resident. " . mysqli_error($conn); // Display error if query fails
}
?>
