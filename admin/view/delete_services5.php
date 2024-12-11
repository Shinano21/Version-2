<?php
include "../dbcon.php";

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $idx = intval($_GET["id"]); // Ensure $idx is an integer

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM anti_pneumonia WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $idx); // "i" denotes the ID is an integer

        // Execute the query
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            header("Location: ../services5.php?deleted=success");
        } else {
            header("Location: ../services5.php?deleted=error");
        }

        // Close the statement
        $stmt->close();
    } else {
        header("Location: ../services5.php?deleted=error");
    }
} else {
    header("Location: ../services5.php?deleted=invalid");
}

// Close the connection
$conn->close();
?>
