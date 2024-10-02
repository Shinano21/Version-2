<?php
include "../dbcon.php";

// Check if the id is set in the query string
if (isset($_GET["id"])) {
    $idx = $_GET["id"];

    // Prepare and execute the DELETE query for the main table (immunization)
    $stmt = $conn->prepare("DELETE FROM immunization WHERE id = ?");
    $stmt->bind_param("i", $idx); // Bind the id as an integer
    $stmt->execute();
    $stmt->close();

    // Prepare and execute the DELETE queries for the related tables
    $relatedTables = ['immunization_1', 'immunization_2', 'immunization_3', 'immunization_4', 'immunization_5'];

    foreach ($relatedTables as $table) {
        $stmt = $conn->prepare("DELETE FROM $table WHERE immu_id = ?");
        $stmt->bind_param("i", $idx); // Bind the id as an integer
        $stmt->execute();
        $stmt->close();
    }

    // Redirect after successful deletion
    header("Location: ../services1.php?deleted=success");
} else {
    // Handle case when id is not set
    header("Location: ../services1.php?deleted=error");
}

// Close the database connection
$conn->close();
?>
