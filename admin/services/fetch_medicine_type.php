<?php
// Set the content type to JSON for proper AJAX response
header('Content-Type: application/json');

// Include database connection file
require_once '../dbcon.php'; // Replace with the actual path to your database connection file

// Get the JSON input from the client
$data = json_decode(file_get_contents('php://input'), true);

// Check if the 'medicine_name' key exists in the input
if (isset($data['medicine_name'])) {
    // Escape the input to prevent SQL injection
    $medicineName = mysqli_real_escape_string($conn, $data['medicine_name']);

    // Query to fetch the medicine type based on the provided medicine name
    $query = "SELECT medicine_type FROM medicine_inventory WHERE medicine_name = '$medicineName'";
    $result = mysqli_query($conn, $query);

    // If a result is found, return the medicine type
    if ($result && mysqli_num_rows($result) > 0) {
        $medicine = mysqli_fetch_assoc($result);
        echo json_encode(['success' => true, 'medicine_type' => $medicine['medicine_type']]);
    } else {
        // If no result, send a failure response
        echo json_encode(['success' => false, 'message' => 'Medicine type not found.']);
    }
} else {
    // If 'medicine_name' is not provided, return an error
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}
