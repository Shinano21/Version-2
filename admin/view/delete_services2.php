<?php
include "../dbcon.php";

// Check if id is set in the query string
if (isset($_GET["id"])) {
    $idx = $_GET["id"];

    // Prepare and execute the DELETE query for the main table (nutrition)
    $stmt = $conn->prepare("DELETE FROM nutrition WHERE id = ?");
    $stmt->bind_param("i", $idx); // Bind the id as an integer
    $stmt->execute();
    $stmt->close();

    // Prepare and execute the DELETE queries for the related tables
    $relatedTables = ['nutrition_1', 'nutrition_2', 'nutrition_3', 'nutrition_4', 'nutrition_5'];

    foreach ($relatedTables as $table) {
        $stmt = $conn->prepare("DELETE FROM $table WHERE nutrition_id = ?");
        $stmt->bind_param("i", $idx); // Bind the id as an integer
        $stmt->execute();
        $stmt->close();
    }

    // Redirect after successful deletion
    header("Location: ../services2.php?deleted=success");
} else {
    // Handle case when id is not set
    header("Location: ../services2.php?deleted=error");
}

// Close the database connection
$conn->close();
?>
