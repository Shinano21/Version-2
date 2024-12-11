<?php
include "../dbcon.php";

// Check if id is set and valid
if (isset($_GET["id"]) && intval($_GET["id"]) > 0) {
    $idx = intval($_GET["id"]);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete from related tables first (based on foreign key constraints)
        $relatedTables = ['nutrition_1', 'nutrition_2', 'nutrition_3', 'nutrition_4', 'nutrition_5'];

        foreach ($relatedTables as $table) {
            // Delete from each related table using the nutrition_id as the reference
            $stmt = $conn->prepare("DELETE FROM $table WHERE nutrition_id = ?");
            $stmt->bind_param("i", $idx);
            if (!$stmt->execute()) {
                throw new Exception("Error deleting from $table: " . $stmt->error);
            }
            $stmt->close();
        }

        // Now delete from the main nutrition table
        $stmt = $conn->prepare("DELETE FROM nutrition WHERE id = ?");
        $stmt->bind_param("i", $idx);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting from nutrition: " . $stmt->error);
        }
        $stmt->close();

        // Commit the transaction
        $conn->commit();

        // Redirect with success message
        header("Location: ../services2.php?deleted=success");
    } catch (Exception $e) {
        // Rollback if any error occurs
        $conn->rollback();
        error_log("Error during deletion: " . $e->getMessage());

        // Redirect with error message
        header("Location: ../services2.php?deleted=error");
    }
} else {
    // Handle missing or invalid id
    header("Location: ../services2.php?deleted=error");
}

// Close the database connection
$conn->close();
?>
