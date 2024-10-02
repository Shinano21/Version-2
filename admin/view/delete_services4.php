<?php
include "../dbcon.php";

// Check if id is set in the query string
if (isset($_GET["id"])) {
    $idx = $_GET["id"];

    // Prepare and execute the DELETE query for the influenza_vaccination table
    $stmt = $conn->prepare("DELETE FROM influenza_vaccination WHERE id = ?");
    $stmt->bind_param("i", $idx); // Bind the id as an integer
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
        header("Location: ../services4.php?deleted=success");
    } else {
        header("Location: ../services4.php?deleted=error");
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle case when id is not set
    header("Location: ../services4.php?deleted=error");
}

// Close the database connection
$conn->close();
?>
