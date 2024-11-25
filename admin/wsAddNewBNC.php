<?php
include "dbcon.php"; // Include the database connection file

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
    // Sanitize and fetch user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== "" ? intval($_POST['parent_id']) : null;

    // Handle photo upload
    $photo_path = null;
    if (!empty($_FILES["photo"]["tmp_name"])) {
        $target_dir = "images/bnc/";
        // Ensure the directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo_path = $target_file; // Save file path
        }
    }

    // Insert the new member into the database
    $sql = "INSERT INTO organization (name, position, photo, contact_info, description, parent_id) 
            VALUES ('$name', '$position', " . ($photo_path ? "'$photo_path'" : "NULL") . ", 
                    '$contact_info', '$description', " . ($parent_id ? $parent_id : "NULL") . ")";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New member added successfully!'); window.location.href = 'wsaddnewBNC.php';</script>";
    } else {
        echo "<script>alert('Error adding member: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Barangay Nutrition Committee Member</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Add New Barangay Nutrition Committee Member</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="position">Position:</label>
        <select id="position" name="position" required>
            <option value="">-- Select Position --</option>
            <option value="Chairman">Chairman</option>
            <optgroup label="Under Chairman">
                <option value="Chairman, Committee on Health">Chairman, Committee on Health</option>
            </optgroup>
            <optgroup label="Under Committee on Health">
                <option value="Councilor, Environment and Sanitation">Councilor, Environment and Sanitation</option>
                <option value="Barangay Nutrition Scholar (BNS)">Barangay Nutrition Scholar (BNS)</option>
                <option value="Barangay Nurse">Barangay Nurse</option>
            </optgroup>
            <optgroup label="Under BNS">
                <option value="Barangay Councilor">Barangay Councilor</option>
                <option value="Barangay Health Worker">Barangay Health Worker</option>
                <option value="Daycare Worker">Daycare Worker</option>
            </optgroup>
        </select><br>

        <label for="contact_info">Contact Info:</label>
        <input type="text" id="contact_info" name="contact_info"><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*"><br>

        <label for="parent_id">Parent (Optional):</label>
        <select id="parent_id" name="parent_id">
            <option value="">-- None --</option>
            <?php foreach ($members as $member): ?>
                <option value="<?= $member['id']; ?>"><?= $member['name']; ?> - <?= $member['position']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Add Member</button>
    </form>
</body>
</html>
