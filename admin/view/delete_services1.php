<?php
include "../dbcon.php";

// Check if the id is set and valid
if (isset($_GET["id"]) && intval($_GET["id"]) > 0) {
    $idx = intval($_GET["id"]);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete from the main table
        $stmt = $conn->prepare("DELETE FROM immunization WHERE id = ?");
        $stmt->bind_param("i", $idx);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting from immunization: " . $stmt->error);
        }
        $stmt->close();

        // Delete from related tables
        $relatedTables = ['immunization_1', 'immunization_2', 'immunization_3', 'immunization_4', 'immunization_5'];

        foreach ($relatedTables as $table) {
            $stmt = $conn->prepare("DELETE FROM $table WHERE immu_id = ?");
            $stmt->bind_param("i", $idx);
            if (!$stmt->execute()) {
                throw new Exception("Error deleting from $table: " . $stmt->error);
            }
            $stmt->close();
        }

        // Commit transaction
        $conn->commit();
        header("Location: ../services1.php?deleted=success");
    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        error_log("Error during deletion: " . $e->getMessage());
        header("Location: ../services1.php?deleted=error");
    }
} else {
    // Handle missing or invalid id
    header("Location: ../services1.php?deleted=error");
}

// Close the database connection
$conn->close();
?>
