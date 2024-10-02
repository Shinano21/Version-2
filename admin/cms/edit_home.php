<?php
include "../dbcon.php";

// Check if the form is submitted
if (isset($_POST["submit"])) {

    // Get the form data
    $header = $_POST["header"];
    $result = $conn->query("SELECT COUNT(*) FROM home");
    $row = $result->fetch_assoc();

    // Handle the Hero Section
    if ($header == "Hero Section") {
        $center_name = $_POST["center_name"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $open_hours = $_POST["open_hours"];

        // Handle the background image upload
        $bg_img = $_FILES['bg_img']['name'];  // Just the file name
        $targetDir = "uploads/";  // Directory to save images
        $bg_img_path = $targetDir . basename($bg_img);  // Full file path

        // Move the uploaded file to the target directory
        if (!empty($bg_img) && move_uploaded_file($_FILES['bg_img']['tmp_name'], $bg_img_path)) {
            // If file is uploaded, include the bg_img path in the database query
            if ($row['COUNT(*)'] == 0) {
                $sql = "INSERT INTO `home` (`center_name`, `address`, `email`, `contact`, `open_hours`, `bg_img`) VALUES (?, ?, ?, ?, ?, ?)";
            } else {
                $sql = "UPDATE `home` SET `center_name` = ?, `address` = ?, `email` = ?, `contact` = ?, `open_hours` = ?, `bg_img` = ?";
            }
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $center_name, $address, $email, $contact, $open_hours, $bg_img_path);
        } else {
            // If no image is uploaded, skip the bg_img field
            if ($row['COUNT(*)'] == 0) {
                $sql = "INSERT INTO `home` (`center_name`, `address`, `email`, `contact`, `open_hours`) VALUES (?, ?, ?, ?, ?)";
            } else {
                $sql = "UPDATE `home` SET `center_name` = ?, `address` = ?, `email` = ?, `contact` = ?, `open_hours` = ?";
            }
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssss", $center_name, $address, $email, $contact, $open_hours);
        }
        
        mysqli_stmt_execute($stmt);
    
    // Handle the About Us section
    } else if ($header == "About Us") {
        $short_desc = $_POST["short_desc"];
        $mission = $_POST["mission"];
        $vision = $_POST["vision"];
        $goal = $_POST["goal"];
        $chairman = $_POST["chairman"];
        $chairman_comm = $_POST["chairman_comm"];

        // Handle image uploads for About Us
        $chairman_pic = $_FILES['chairman_pic']['name'];
        $chairman_comm_pic = $_FILES['chairman_comm_pic']['name'];
        $section_pic = $_FILES['section_pic']['name'];

        // Set the target directory and file paths
        $chairman_pic_path = $targetDir . basename($chairman_pic);
        $chairman_comm_pic_path = $targetDir . basename($chairman_comm_pic);
        $section_pic_path = $targetDir . basename($section_pic);

        // Move uploaded files to the target directory
        if (!empty($chairman_pic)) move_uploaded_file($_FILES['chairman_pic']['tmp_name'], $chairman_pic_path);
        if (!empty($chairman_comm_pic)) move_uploaded_file($_FILES['chairman_comm_pic']['tmp_name'], $chairman_comm_pic_path);
        if (!empty($section_pic)) move_uploaded_file($_FILES['section_pic']['tmp_name'], $section_pic_path);

        // SQL query to insert or update
        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `home` (`short_desc`, `mission`, `vision`, `goal`, `chairman`, `chairman_pic`, `chairman_comm`, `chairman_comm_pic`, `section_pic`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        } else {
            $sql = "UPDATE `home` SET `short_desc` = ?, `mission` = ?, `vision` = ?, `goal` = ?, `chairman` = ?, `chairman_pic` = ?, `chairman_comm` = ?, `chairman_comm_pic` = ?, `section_pic` = ?";
        }

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssss", $short_desc, $mission, $vision, $goal, $chairman, $chairman_pic_path, $chairman_comm, $chairman_comm_pic_path, $section_pic_path);
        mysqli_stmt_execute($stmt);

    // Handle the Contact Us section
    } else {
        $contact_mess = $_POST["contact_mess"];
        $office_hrs = $_POST["office_hrs"];
        $sql = "UPDATE `home` SET `contact_mess` = ?, `office_hrs` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $contact_mess, $office_hrs);
        mysqli_stmt_execute($stmt);
    }

    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Display a success message and redirect
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsHomeSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script>';
    } else {
        // Redirect to an error page or handle the error
        header("Location: update_error.php");
        exit();
    }
}
?>
