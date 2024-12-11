<?php
include "../dbcon.php";

if (isset($_GET["id"]) && intval($_GET["id"]) > 0) {
    $id = intval($_GET["id"]);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Prepare the DELETE statement
        $stmt = $conn->prepare("DELETE FROM influenza_vaccination WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare the statement: " . $conn->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute the statement: " . $stmt->error);
        }

        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Commit the transaction
            $conn->commit();
            header("Location: ../services4.php?deleted=success");
            exit;
        } else {
            // No matching record found
            throw new Exception("No record found with the given ID.");
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        error_log("Error during deletion: " . $e->getMessage());
        header("Location: ../services4.php?deleted=error");
        exit;
    } finally {
        // Close the prepared statement
        if (isset($stmt) && $stmt !== false) {
            $stmt->close();
        }
        // Close the database connection
        $conn->close();
    }
} else {
    // Redirect if ID is invalid or not provided
    header("Location: ../services4.php?deleted=error");
    exit;
}
?>
