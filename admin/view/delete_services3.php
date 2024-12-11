<?php
include "../dbcon.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure the id is an integer

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM family_planning WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id); // Bind the id as an integer
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            // Redirect back to the main page (or wherever appropriate)
            header("Location: ../services3.php?delete=success");
            exit;
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $conn->error;
    }
} else {
    echo "No ID provided for deletion.";
}

// Close the database connection
$conn->close();
?>
