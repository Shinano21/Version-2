<?php
session_start();

include "dbcon.php";
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Fetch existing member details
$id = $_GET['id'] ?? null;
if (!$id) {
    die("No member ID provided.");
}

// Fetch existing members for the parent dropdown
$members = [];
$sql = "SELECT id, name, position FROM organization ORDER BY position";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $members[] = $row;
    }
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
    $photo_filename = $member['photo']; // Keep existing photo by default
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

        $new_file_name = uniqid("bnc_", true) . '.' . $file_ext; // Unique filename
        $photo_path = $upload_dir . $new_file_name; // Full path for file upload
        $photo_filename = $new_file_name; // Only the filename for the database

        if (!move_uploaded_file($file_tmp, $photo_path)) {
            die("Failed to upload photo. Please try again.");
        }
    }

    $stmt = $conn->prepare("UPDATE organization SET name = ?, position = ?, photo = ?, contact_info = ?, description = ?, parent_id = ? WHERE id = ?");
    $stmt->bind_param("sssssii", $name, $position, $photo_filename, $contact_info, $description, $parent_id, $id);

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
    <title>Edit Barangay Nutrition Committee Member | TechCare</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/wsHome.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
          body{
    background-color: #CDE8E5;
  }
    </style>
</head>
< onload="display_ct();">
<?php include "partials/sidebar.php"?>
    <!-- Sidebar -->
    <?php include "partials/header.php" ?>
    <!-- Header -->
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <h5 style="padding: 25px 30px 0;">About / Edit Nutrition Committee Member</h5>
                <section id="main-content">
                    <div class="tabcontent show">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Edit Member Details</h5>
                                <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
                                
                                <div class="formInput" style="width: 100%;">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" placeholder="Enter Name" required>
                                </div>

                                <div class="formInput" style="width: 100%;">
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
                                    </select>
                                </div>

                                <div class="formInput" style="width: 100%;">
                                    <label for="contact_info">Contact Info:</label>
                                    <input type="text" id="contact_info" name="contact_info" value="<?php echo htmlspecialchars($member['contact_info']); ?>">
                                </div>

                                <div class="formInput" style="width: 100%;">
                                    <label for="description">Description:</label>
                                    <textarea id="description" name="description"><?php echo htmlspecialchars($member['description']); ?></textarea>
                                </div>

                                <div class="photo">
                                    <label for="photo">Photo (Leave blank to keep existing):</label>
                                    <input type="file" id="photo" name="photo" accept="image/*">
                                </div>

                                <!-- Parent Dropdown -->
                            <div class="formInput" style="width: 100%;">
                                <label>Parent (Optional)</label>
                                <select id="parent_id" name="parent_id">
                                    <option value="">-- None --</option>
                                    <?php foreach ($members as $member): ?>
                                        <option value="<?= $member['id']; ?>"><?= $member['name']; ?> - <?= $member['position']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                                <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                    <button type="submit" name="submit">Update Member</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        function display_c() {
            var refresh = 1000; // Refresh rate in milliseconds
            mytime = setTimeout('display_ct()', refresh);
        }

        function display_ct() {
            var x = new Date();
            
            // Set the time zone to Philippine Time (PHT)
            var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var timeString = x.toLocaleTimeString('en-US', options);

            // Extract the date part in the format "Day, DD Mon YYYY"
            var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });

            // Combine date and time in the desired format
            var x1 = datePart + ' - ' + timeString;

            document.getElementById('ct').innerHTML = x1;
            tt = display_c();
        }

        // Initial call to start displaying time
        display_c();
    </script>
    <?php include "partials/scripts.php"; ?>
    <script src="js/preview.js"></script>
</body>
</html>
