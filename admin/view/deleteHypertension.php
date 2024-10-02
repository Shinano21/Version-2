<?php
include "../dbcon.php";

// Check if 'id' is present in the URL and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idx = intval($_GET['id']); // Ensure 'id' is an integer for added security

    // Prepare the DELETE query for the hypertension table
    $sql = "DELETE FROM hypertension WHERE hypertension_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter and execute the query
        mysqli_stmt_bind_param($stmt, "i", $idx);
        mysqli_stmt_execute($stmt);

        // Redirect to the hypertension records page with a success message
        header("Location: ../services8.php?deleted=success");
        exit();
    } else {
        // Handle the error
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    // If 'id' is not valid, redirect to the hypertension records page with an error message
    header("Location: ../services8.php?deleted=error");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
