<?php
// Include the database connection
include '../dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $purokId = $_POST['id'];

    $sql = "DELETE FROM purok_boundaries WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $purokId);

    if ($stmt->execute()) {
        $message = "Purok deleted successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();

    // Redirect back to the table
    header("Location: purok_tables.php");
    exit;
}
?>
