<?php
include "../dbcon.php"; // Include the database connection

// Check if 'id' is present in the URL and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idx = intval($_GET['id']); // Ensure 'id' is an integer for added security

    // Prepare the DELETE query for the animal_bite_records table
    $sql = "DELETE FROM animal_bite_records WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter (i = integer) and execute the query
        mysqli_stmt_bind_param($stmt, "i", $idx);

        if (mysqli_stmt_execute($stmt)) {
            // Close the database connection before redirecting
            mysqli_close($conn);
            // Redirect to the animal bite records page with a success message
            header("Location: ../services6.php?deleted=success");
            exit();
        } else {
            // Close the database connection before redirecting
            mysqli_close($conn);
            // Handle execution failure
            header("Location: ../services6.php?deleted=error");
            exit();
        }
    } else {
        // Close the database connection before redirecting
        mysqli_close($conn);
        // Handle statement preparation failure
        header("Location: ../services6.php?deleted=error");
        exit();
    }
} else {
    // Close the database connection before redirecting
    mysqli_close($conn);
    // If 'id' is not valid, redirect to the animal bite records page with an error message
    header("Location: ../services6.php?deleted=error");
    exit();
}
?>
