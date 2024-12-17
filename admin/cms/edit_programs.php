<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {

    // Check if a file was uploaded
    if (isset($_FILES["bg_img"]) && $_FILES["bg_img"]["error"] === UPLOAD_ERR_OK) {
        
        // Get the file details
        $file_name = basename($_FILES["bg_img"]["name"]);  // Extract only the file name
        $upload_dir = "uploads/";  // Folder to store uploaded files
        $upload_path = $upload_dir . $file_name;  // Full path to save the file

        // Move the uploaded file to the "uploads" folder
        if (move_uploaded_file($_FILES["bg_img"]["tmp_name"], $upload_path)) {

            // Check if the table already has a record
            $result = $conn->query("SELECT COUNT(*) as total FROM home");
            $row = $result->fetch_assoc();

            if ($row['total'] == 0) {
                // Insert new record if table is empty
                $sql = "INSERT INTO `home` (`programs_pic`) VALUES (?)";
            } else {
                // Update the existing record
                $sql = "UPDATE `home` SET `programs_pic` = ?";
            }

            // Prepare and execute the statement
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $file_name);
            mysqli_stmt_execute($stmt);

            // Check if the query was successful
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo '<script>';
                echo 'alert("Saved successfully!");';
                echo 'window.location.href = "../wsProgramSettings.php";';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'alert("No changes made or error occurred!");';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'alert("Failed to move uploaded file. Please check folder permissions.");';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'alert("No file uploaded or an error occurred.");';
        echo '</script>';
    }
}
?>
