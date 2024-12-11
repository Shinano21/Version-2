<?php
include "../dbcon.php";

// Check if id is set and valid
if (isset($_GET["id"]) && intval($_GET["id"]) > 0) {
    $idx = intval($_GET["id"]); // Sanitize and validate id

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete from the main table
        $stmt = $conn->prepare("DELETE FROM nutrition WHERE id = ?");
        $stmt->bind_param("i", $idx);

        if (!$stmt->execute()) {
            throw new Exception("Error deleting from nutrition: " . $stmt->error);
        }
        $stmt->close();

        // Define related tables to delete from
        $relatedTables = ['nutrition_1', 'nutrition_2', 'nutrition_3', 'nutrition_4', 'nutrition_5'];

        foreach ($relatedTables as $table) {
            // Delete from each related table
            $stmt = $conn->prepare("DELETE FROM $table WHERE nutrition_id = ?");
            $stmt->bind_param("i", $idx);

            if (!$stmt->execute()) {
                throw new Exception("Error deleting from $table: " . $stmt->error);
            }
            $stmt->close();
        }

        // Commit transaction
        $conn->commit();
        header("Location: ../services2.php?deleted=success");
    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();

        // Log the error for debugging
        error_log("Error during deletion: " . $e->getMessage());
        header("Location: ../services2.php?deleted=error");
    }
} else {
    // Handle missing or invalid id
    header("Location: ../services2.php?deleted=error");
}

// Close the database connection
$conn->close();
?>
