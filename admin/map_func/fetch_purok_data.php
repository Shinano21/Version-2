<?php
// Database connection
require_once '../dbcon.php';

// Fetch data from the database
$query = "SELECT purok_name, color, boundary_coordinates FROM purok_boundaries";
$result = $conn->query($query);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $coordinates = json_decode($row['boundary_coordinates'], true)['coordinates'][0]; // Extract coordinates
        $coord_with_z = array_map(function ($coord) {
            return [$coord[0], $coord[1], 0]; // Add Z-coordinate (0)
        }, $coordinates);

        $data[$row['purok_name']] = [
            'color' => $row['color'],
            'coord' => $coord_with_z,
        ];
    }
}

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($data);
