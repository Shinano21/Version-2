<?php
include "dbcon.php";

// Fetch existing member details
$id = $_GET['id'] ?? null;
if (!$id) {
    die("No member ID provided.");
}

$sql = "SELECT * FROM organization WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();

if (!$member) {
    die("Member not found.");
}

// Update member details
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $contact_info = $_POST['contact_info'];
    $description = $_POST['description'];
    $parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== "" ? intval($_POST['parent_id']) : null;

    // Handle photo update
    $photo_path = $member['photo']; // Keep existing photo by default
    if (!empty($_FILES["photo"]["tmp_name"])) {
        $upload_dir = "images/bnc/";
        $file_name = basename($_FILES["photo"]["name"]);
        $file_tmp = $_FILES["photo"]["tmp_name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_ext, $allowed_extensions)) {
            die("Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.");
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file_tmp);
        finfo_close($finfo);

        $valid_mime_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($mime_type, $valid_mime_types)) {
            die("Invalid file type. Please upload a valid image.");
        }

        $new_file_name = uniqid("bnc_", true) . '.' . $file_ext;
        $photo_path = $upload_dir . $new_file_name;

        if (!move_uploaded_file($file_tmp, $photo_path)) {
            die("Failed to upload photo. Please try again.");
        }
    }

    $stmt = $conn->prepare("UPDATE organization SET name = ?, position = ?, photo = ?, contact_info = ?, description = ?, parent_id = ? WHERE id = ?");
    $stmt->bind_param("sssssii", $name, $position, $photo_path, $contact_info, $description, $parent_id, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Member updated successfully!'); window.location.href = 'wsAddNewBNC.php';</script>";
    } else {
        echo "<script>alert('Error updating member: " . htmlspecialchars($stmt->error) . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Barangay Nutrition Committee Member</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Edit Barangay Nutrition Committee Member</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($member['name']); ?>" required><br>

        <label for="position">Position:</label>
        <select id="position" name="position" required>
            <option value="">-- Select Position --</option>
            <option value="Chairman" <?= $member['position'] === 'Chairman' ? 'selected' : ''; ?>>Chairman</option>
            <optgroup label="Under Chairman">
                <option value="Chairman, Committee on Health" <?= $member['position'] === 'Chairman, Committee on Health' ? 'selected' : ''; ?>>Chairman, Committee on Health</option>
            </optgroup>
            <optgroup label="Under Committee on Health">
                <option value="Councilor, Environment and Sanitation" <?= $member['position'] === 'Councilor, Environment and Sanitation' ? 'selected' : ''; ?>>Councilor, Environment and Sanitation</option>
                <option value="Barangay Nutrition Scholar (BNS)" <?= $member['position'] === 'Barangay Nutrition Scholar (BNS)' ? 'selected' : ''; ?>>Barangay Nutrition Scholar (BNS)</option>
                <option value="Barangay Nurse" <?= $member['position'] === 'Barangay Nurse' ? 'selected' : ''; ?>>Barangay Nurse</option>
            </optgroup>
            <optgroup label="Under BNS">
                <option value="Barangay Councilor" <?= $member['position'] === 'Barangay Councilor' ? 'selected' : ''; ?>>Barangay Councilor</option>
                <option value="Barangay Health Worker" <?= $member['position'] === 'Barangay Health Worker' ? 'selected' : ''; ?>>Barangay Health Worker</option>
                <option value="Daycare Worker" <?= $member['position'] === 'Daycare Worker' ? 'selected' : ''; ?>>Daycare Worker</option>
            </optgroup>
        </select><br>

        <label for="contact_info">Contact Info:</label>
        <input type="text" id="contact_info" name="contact_info" value="<?= htmlspecialchars($member['contact_info']); ?>"><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"><?= htmlspecialchars($member['description']); ?></textarea><br>

        <label for="photo">Photo (Leave blank to keep existing):</label>
        <input type="file" id="photo" name="photo" accept="image/*"><br>

        <label for="parent_id">Parent (Optional):</label>
        <select id="parent_id" name="parent_id">
            <option value="">-- None --</option>
            <!-- Populate parent dropdown dynamically -->
        </select><br>

        <button type="submit">Update Member</button>
    </form>
</body>
</html>
