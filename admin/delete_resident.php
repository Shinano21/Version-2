<?php
include "dbcon.php";

$idx = $_GET["id"]; // Retrieve the resident's ID from the query string

// Check for related records in all tables
$animalBiteQuery = "SELECT COUNT(*) as count FROM animal_bite_records WHERE resident_id = '$idx'";
$prenatalQuery = "SELECT COUNT(*) as count FROM prenatal WHERE resident_id = '$idx'";
$hypertensionQuery = "SELECT COUNT(*) as count FROM hypertension WHERE resident_id = '$idx'";

$animalBiteResult = mysqli_query($conn, $animalBiteQuery);
$prenatalResult = mysqli_query($conn, $prenatalQuery);
$hypertensionResult = mysqli_query($conn, $hypertensionQuery);

$animalBiteCount = mysqli_fetch_assoc($animalBiteResult)['count'];
$prenatalCount = mysqli_fetch_assoc($prenatalResult)['count'];
$hypertensionCount = mysqli_fetch_assoc($hypertensionResult)['count'];

if ($animalBiteCount > 0 || $prenatalCount > 0 || $hypertensionCount > 0) {
    // If the resident is linked to records, show a popup message
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create the modal container
            const modal = document.createElement('div');
            modal.style.position = 'fixed';
            modal.style.top = '50%';
            modal.style.left = '50%';
            modal.style.transform = 'translate(-50%, -50%)';
            modal.style.backgroundColor = '#fff';
            modal.style.padding = '20px';
            modal.style.borderRadius = '8px';
            modal.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
            modal.style.textAlign = 'center';
            modal.style.zIndex = '1000';

            // Add the error message
            const message = document.createElement('p');
            message.textContent = 'Error: Cannot delete resident because they are linked to other records.';
            modal.appendChild(message);

            // Add the OK button
            const button = document.createElement('button');
            button.textContent = 'OK';
            button.style.marginTop = '10px';
            button.style.padding = '10px 20px';
            button.style.backgroundColor = '#007bff';
            button.style.color = '#fff';
            button.style.border = 'none';
            button.style.borderRadius = '4px';
            button.style.cursor = 'pointer';
            button.addEventListener('click', function() {
                window.location.href = 'residents.php'; // Redirect to residents.php
            });
            modal.appendChild(button);

            // Append modal to the body
            document.body.appendChild(modal);
        });
    </script>
    ";
} else {
    // If no related records exist, proceed with deletion
    $deleteQuery = "DELETE FROM residents WHERE id = '$idx'";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: residents.php?deleted=success"); // Redirect with success message
        exit();
    } else {
        echo "Error: Unable to delete resident. " . mysqli_error($conn); // Display error if query fails
    }
}
?>
