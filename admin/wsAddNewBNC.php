<?php
session_start();

include "dbcon.php"; // Include the database connection file
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and fetch user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== "" ? intval($_POST['parent_id']) : null;

    // Handle photo upload
    $photo_name = null;
    if (!empty($_FILES["photo"]["tmp_name"])) {
        $target_dir = "images/bnc/";
        // Ensure the directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $photo_name = basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $photo_name;
        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo_name = null; // Reset if upload fails
        }
    }

    // Insert the new member into the database
    $sql = "INSERT INTO organization (name, position, photo, contact_info, description, parent_id) 
            VALUES ('$name', '$position', " . ($photo_name ? "'$photo_name'" : "NULL") . ", 
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
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/wsHome.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php include "partials/sidebar.php"?>
    <!-- Sidebar -->
    <?php include "partials/header.php" ?>
    <!-- Header -->

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <!-- <h5 style="padding: 25px 60px 0;">Barangay Nutrition Committee / Add New Member</h5> -->
            <section id="main-content">
                <div class="tabcontent show">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form">
                            <h5>Add New Barangay Nutrition Committee Member</h5>
                            
                            <!-- Name Input -->
                            <div class="formInput" style="width: 100%;">
                                <label>Name</label>
                                <input type="text" id="name" name="name" placeholder="Enter Name" required>
                            </div>

                            <!-- Position Input -->
                            <div class="formInput" style="width: 100%;">
                                <label>Position</label>
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
                                </select>
                            </div>

                            <!-- Contact Info Input -->
                            <div class="formInput" style="width: 100%;">
                                <label>Contact Info</label>
                                <input type="text" id="contact_info" name="contact_info" placeholder="Enter Contact Info">
                            </div>

                            <!-- Description Input -->
                            <div class="formInput" style="width: 100%;">
                                <label>Description</label>
                                <textarea id="description" name="description" placeholder="Enter Description"></textarea>
                            </div>

                            <!-- Photo Upload -->
                            <div class="photo">
                                <label for="photo">Profile Picture:</label>
                                <input type="file" id="photo" name="photo" accept="image/*">
                                <div class="preview">
                                    <img id="preview" src="#" alt="Preview" style="display:none; max-width:250px; max-height:250px;">
                                </div>
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

                            <!-- Submit Button -->
                            <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                <button type="submit">Add Member</button>
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
