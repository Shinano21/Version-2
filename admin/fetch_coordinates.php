<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "carevisio"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch boundaries from the `purok_boundaries` table
$boundaries = [];
$sql = "SELECT purok_name, barangay_name, boundary_coordinates, color FROM purok_boundaries";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $boundaries[] = [
            "purok_name" => $row['purok_name'],
            "barangay_name" => $row['barangay_name'],
            "boundary_coordinates" => json_decode($row['boundary_coordinates']), // Convert JSON string to array
            "color" => $row['color']
        ];
    }
}

// Return JSON response
echo json_encode($boundaries);

$conn->close();
?>
