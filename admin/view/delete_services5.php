<?php
include "../dbcon.php";

if (isset($_GET["id"])) {
    $idx = $_GET["id"];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM anti_pneumonia WHERE id = ?");
    $stmt->bind_param("i", $idx); // "i" denotes the ID is an integer

    // Execute the query
    if ($stmt->execute()) {
        header("Location: ../services5.php?deleted=success");
    } else {
        header("Location: ../services5.php?deleted=error");
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
