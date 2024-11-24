<?php
include "dbcon.php";

// Fetch existing members for the parent dropdown
$members = [];
$sql = "SELECT id, name, position FROM organization ORDER BY position";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $members[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $contact_info = $_POST['contact_info'];
    $description = $_POST['description'];
    $parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== "" ? intval($_POST['parent_id']) : null;

    // Handle photo upload
    $photo_path = null;
    if (!empty($_FILES["photo"]["tmp_name"])) {
        $target_dir = "images/bnc/";
