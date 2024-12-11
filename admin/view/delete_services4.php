<?php
include "../dbcon.php";

// Check if id is set and valid
if (isset($_GET["id"]) && intval($_GET["id"]) > 0) {
    $idx = intval($_GET["id"]);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Prepare and execute the DELETE query for the influenza_vaccination table
        $stmt = $conn->prepare("DELETE FROM influenza_vaccination WHERE id = ?");
        $stmt->bind_param("i", $idx);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting from influenza_vaccination: " . $stmt->error);
        }

        // Check if a row was deleted
        if ($stmt->affected_rows > 0) {
            $conn->commit(); // Commit transaction
            header("Location: ../services4.php?deleted=success");
        } else {
            throw new Exception("No matching record found for deletion.");
        }
        
        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction on error
        error_log("Error during deletion: " . $e->getMessage());
        header("Location: ../services4.php?deleted=error");
    }
} else {
    // Handle missing or invalid id
    header("Location: ../services4.php?deleted=error");
}

// Close the database connection
$conn->close();
?>
