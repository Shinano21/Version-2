<?php
include "../dbcon.php";

// Check if id is set and valid
if (isset($_GET["id"]) && intval($_GET["id"]) > 0) {
    $idx = intval($_GET["id"]);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete from the main table
        $stmt = $conn->prepare("DELETE FROM family_planning WHERE id = ?");
        $stmt->bind_param("i", $idx);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting from family_planning: " . $stmt->error);
        }
        $stmt->close();

        // Delete from related tables
        $relatedTables = ['family_planning_sched', 'family_plan_rem'];

        foreach ($relatedTables as $table) {
            // Validate table name
            if (!in_array($table, $relatedTables, true)) {
                throw new Exception("Invalid table name: $table");
            }

            $stmt = $conn->prepare("DELETE FROM $table WHERE family_id = ?");
            $stmt->bind_param("i", $idx);
            if (!$stmt->execute()) {
                throw new Exception("Error deleting from $table: " . $stmt->error);
            }
            $stmt->close();
        }

        // Commit transaction
        $conn->commit();
        header("Location: ../services3.php?deleted=success");
    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        error_log("Error during deletion: " . $e->getMessage());
        header("Location: ../services3.php?deleted=error");
    }
} else {
    // Handle missing or invalid id
    header("Location: ../services3.php?deleted=error");
}

// Close the database connection
$conn->close();
?>
