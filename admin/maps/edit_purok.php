<?php
// Include the database connection
include '../dbcon.php';

// Handle updates to boundary details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'], $data['purok_name'], $data['color'], $data['boundary_coordinates'])) {
        $id = $data['id'];
        $purok_name = $data['purok_name'];
        $color = $data['color'];
        $boundary_coordinates = json_encode($data['boundary_coordinates']);

        $sql = "UPDATE purok_boundaries SET purok_name = ?, color = ?, boundary_coordinates = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $purok_name, $color, $boundary_coordinates, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
    $conn->close();
    exit;
}

// Fetch a specific Purok based on ID (or default to the first Purok)
$purok_id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$sql = "SELECT id, purok_name, color, boundary_coordinates FROM purok_boundaries WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $purok_id);
$stmt->execute();
$result = $stmt->get_result();
$purok = $result->fetch_assoc();

$stmt->close();
$conn->close();

if (!$purok) {
    die('Purok not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Purok Boundary</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        h1 { text-align: center; margin: 20px; }
        .map-container { width: 100%; height: 400px; margin-bottom: 30px; }
        .form-container { width: 80%; margin: 0 auto 30px; }
        .form-container input { width: 100%; padding: 10px; margin: 10px 0; }
        .form-container button { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .form-container button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h1>Edit Purok: <?php echo htmlspecialchars($purok['purok_name']); ?></h1>

    <!-- Editable Form -->
    <div class="form-container">
        <label for="purok_name">Purok Name:</label>
        <input type="text" id="purok_name" value="<?php echo htmlspecialchars($purok['purok_name']); ?>">

        <label for="color">Boundary Color:</label>
        <input type="color" id="color" value="<?php echo htmlspecialchars($purok['color']); ?>">

        <button id="save-btn">Save Changes</button>
    </div>

    <!-- Map Container -->
    <div class="map-container" id="map"></div>

    <script>
    (function() {
        var map = L.map('map').setView([13.1387, 123.7353], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Parse the boundary coordinates from JSON
        var boundaryCoordinates = <?php echo $purok['boundary_coordinates']; ?>;

        // Create a Feature Group to hold the polygon
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        // Add the polygon to the Feature Group
        var polygon = L.geoJSON(boundaryCoordinates, {
            style: {
                color: '<?php echo htmlspecialchars($purok['color']); ?>',
                weight: 2,
                fillOpacity: 0.5
            }
        }).eachLayer(function(layer) {
            drawnItems.addLayer(layer); // Add the polygon layer to the Feature Group
        });

        // Initialize Leaflet Draw controls
        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: drawnItems, // Enables editing of layers in this group
                remove: false             // Prevent deletion for safety
            },
            draw: false                  // Disable drawing of new shapes
        });
        map.addControl(drawControl);

        // Handle saving edits
        document.getElementById('save-btn').addEventListener('click', function() {
            var updatedLayer = drawnItems.getLayers()[0]; // Get the edited polygon layer
            var updatedGeoJSON = updatedLayer.toGeoJSON();

            // Send the updated data to the server
            fetch('', { // Empty string refers to the current file
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: <?php echo $purok['id']; ?>,
                    purok_name: document.getElementById('purok_name').value,
                    color: document.getElementById('color').value,
                    boundary_coordinates: updatedGeoJSON.geometry
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Boundary updated successfully!');
                } else {
                    alert('Failed to update boundary: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    })();
    </script>
</body>
</html>
