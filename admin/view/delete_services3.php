<?php
include "../dbcon.php";

// Check if id is set in the query string
if (isset($_GET["id"])) {
    $idx = $_GET["id"];

    // Prepare and execute the DELETE query for the main table (family_planning)
    $stmt = $conn->prepare("DELETE FROM family_planning WHERE id = ?");
    $stmt->bind_param("i", $idx); // Bind the id as an integer
    $stmt->execute();
    $stmt->close();

    // Prepare and execute the DELETE queries for the related tables
    $relatedTables = ['family_planning_sched', 'family_plan_rem'];

    foreach ($relatedTables as $table) {
        $stmt = $conn->prepare("DELETE FROM $table WHERE family_id = ?");
        $stmt->bind_param("i", $idx); // Bind the id as an integer
        $stmt->execute();
        $stmt->close();
    }

    // Redirect after successful deletion
    header("Location: ../services3.php?deleted=success");
} else {
    // Handle case when id is not set
    header("Location: ../services3.php?deleted=error");
}

// Close the database connection
$conn->close();
?>
