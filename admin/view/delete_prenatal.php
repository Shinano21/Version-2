<?php
session_start();
include "../dbcon.php";  // Include the database connection

// Check if the user is logged in and is not a System Administrator
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
} elseif ($_SESSION["user_type"] == "System Administrator") {
    // Redirect System Administrators away from this page
    header("Location: ../admin_dashboard.php");
    exit();
}

// Check if 'id' is present in the URL and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $prenatal_id = intval($_GET['id']); // Ensure 'id' is an integer for added security

    // Prepare the DELETE query for the prenatal table
    $sql = "DELETE FROM prenatal WHERE prenatal_id = ?";  // Use 'prenatal_id' instead of 'id'
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter (i = integer) and execute the query
        mysqli_stmt_bind_param($stmt, "i", $prenatal_id);

        if (mysqli_stmt_execute($stmt)) {
            // Success: Redirect with a success message
            $_SESSION['success'] = "Prenatal record deleted successfully.";
            mysqli_close($conn);
            header("Location: ../services7.php?deleted=success");
            exit();
        } else {
            // Error during deletion
            $_SESSION['error'] = "Error deleting prenatal record.";
            mysqli_close($conn);
            header("Location: ../services7.php?deleted=error");
            exit();
        }
    } else {
        // Error preparing the statement
        $_SESSION['error'] = "Error preparing the delete statement.";
        mysqli_close($conn);
        header("Location: ../services7.php?deleted=error");
        exit();
    }
} else {
    // Invalid or missing 'id', redirect to the prenatal records page with an error message
    $_SESSION['error'] = "Invalid prenatal record ID.";
    mysqli_close($conn);
    header("Location: ../services7.php?deleted=error");
    exit();
}
?>
