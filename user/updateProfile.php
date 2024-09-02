<?php
include "../dbcon.php";
session_start();
$unique_id = $_SESSION["unique_id"];

if (isset($_POST["submit"])) {
    $fname = $_POST["fname"];
    $mname = isset($_POST["mname"]) ? $_POST["mname"] : '';
    $lname = $_POST["lname"];
    $bday = $_POST["bday"];

    if (isset($_FILES['profile_pic'])) {
        $img_name = $_FILES['profile_pic']['name'];
        $img_type = $_FILES['profile_pic']['type'];
        $tmp_name = $_FILES['profile_pic']['tmp_name'];

        // Specify the target directory for storing uploaded images
        $target_dir = "images/";

        // Specify allowed image file extensions
        $allowed_extensions = ["jpeg", "jpg", "png"];

        // Get the file extension
        $img_explode = explode('.', $img_name);
        $img_ext = strtolower(end($img_explode));

        // Check if the file extension is allowed
        if (in_array($img_ext, $allowed_extensions)) {
            // Generate a unique name for the image
            $new_img_name = uniqid() . '.' . $img_ext;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($tmp_name, $target_dir . $new_img_name)) {
                // Continue with your existing code
            } else {
                echo "Image upload failed!";
                exit();
            }
        } else {
            echo "Please upload a valid image file (jpeg, jpg, png).";
            exit();
        }
    }

    // Update 'users' table
    $sqlUsers = "UPDATE `users` SET `fname` = ?, `mname` = ?, `lname` = ?, `bday` = ?, `img` = ? WHERE `unique_id` = ?";
    $stmtUsers = mysqli_prepare($conn, $sqlUsers);

    // Bind parameters for 'users' table
    mysqli_stmt_bind_param($stmtUsers, "ssssss", $fname, $mname, $lname, $bday, $new_img_name, $unique_id);

    // Execute the statement for 'users' table
    mysqli_stmt_execute($stmtUsers);

    // Check if the update was successful for 'users' table
    if (mysqli_stmt_affected_rows($stmtUsers) > 0) {
        // Insert into 'administrator' table
        $sqlAdmin = "UPDATE `administrator` SET `fname` = ?, `mname` = ?, `lname` = ? WHERE `unique_id` = ?";
        $stmtAdmin = mysqli_prepare($conn, $sqlAdmin);

        // Bind parameters for 'administrator' table
        mysqli_stmt_bind_param($stmtAdmin, "ssss", $fname, $mname, $lname, $unique_id);

        // Execute the statement for 'administrator' table
        mysqli_stmt_execute($stmtAdmin);
        
        if (mysqli_stmt_affected_rows($stmtAdmin) == 0) {
            // Redirect to a success page or appropriate location
            echo '<script>';
            echo 'alert("Profile updated successfully!");';
            echo 'window.location.href = "editProfile.php";';  // Optional: Redirect after displaying the alert
            echo '</script>';
            exit();
        }
        // Check if the update was successful for 'administrator' table
        else if (mysqli_stmt_affected_rows($stmtAdmin) > 0) {
            // Redirect to a success page or appropriate location
            echo '<script>';
            echo 'alert("Profile updated successfully!");';
            echo 'window.location.href = "editProfile.php";';  // Optional: Redirect after displaying the alert
            echo '</script>';
            exit();
        } else {
            // Redirect with an error message or appropriate handling for 'administrator' table
            echo "Error: " . mysqli_error($conn);
            exit();
        }

    } else {
        // Redirect with an error message or appropriate handling for 'users' table
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}
?>
