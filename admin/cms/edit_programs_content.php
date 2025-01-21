<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    // Retrieve form inputs
    $programType = $_POST["program_type"];
    $progHeading = $_POST["prog_heading"];
    $progBody = $_POST["prog_body"];
    $what = $_POST["what"];
    $where = $_POST["where"];
    $when = $_POST["when"];
    $who = $_POST["who"];
    $progPic = $_FILES["prog_pic"]["name"]; // Get the filename

    // Set the target directory for uploaded files
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($progPic);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["prog_pic"]["tmp_name"], $targetFile)) {
        // Prepare the SQL query to insert data into the database
        $sql = "INSERT INTO `programs` 
                (`program_type`, `prog_heading`, `prog_body`, `what`, `where`, `when`, `who`, `prog_pic`, `post_date`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $programType, $progHeading, $progBody, $what, $where, $when, $who, $progPic);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success: Display a pop-up message and redirect
            echo '<script>';
            echo 'alert("Program saved successfully!");';
            echo 'window.location.href = "../wsProgramSettings.php";';
            echo '</script>';
        } else {
            // Failure: Redirect with an error message
            echo '<script>';
            echo 'alert("Failed to save the program. Please try again.");';
            echo 'window.location.href = "../wsProgramSettings.php";';
            echo '</script>';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle file upload error
        echo '<script>';
        echo 'alert("Failed to upload the file. Please try again.");';
        echo 'window.location.href = "../wsProgramSettings.php";';
        echo '</script>';
    }
}

// Close the database connection
mysqli_close($conn);
?>
