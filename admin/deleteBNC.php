<?php
include "dbcon.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    die("No member ID provided.");
}

// Fetch photo to delete it from the server
$sql = "SELECT photo FROM organization WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();

if ($member && $member['photo']) {
    $photo_path = $member['photo'];
    if (file_exists($photo_path)) {
        unlink($photo_path); // Delete the photo file
    }
}

// Delete the member from the database
$sql = "DELETE FROM organization WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Member deleted successfully!'); window.location.href = 'wsAboutSettings.php';</script>";
} else {
    echo "<script>alert('Error deleting member: " . $stmt->error . "');</script>";
}
$stmt->close();
?>
