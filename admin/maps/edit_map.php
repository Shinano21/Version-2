<?php
// Include the database connection
include '../dbcon.php';

// Handle form submission (saving puroks)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['purokName'])) {
        // Save purok
        $purokName = $_POST['purokName'];
        $purokColor = $_POST['purokColor'];
        $boundaryCoordinates = $_POST['boundaryCoordinates'];

        $sql = "INSERT INTO purok_boundaries (barangay_name, purok_name, boundary_coordinates, color) 
                VALUES ('Barangay 1', ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $purokName, $boundaryCoordinates, $purokColor);

        if ($stmt->execute()) {
            echo "Purok saved successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        exit;
    } elseif (isset($_POST['deletePurok'])) {
        // Delete purok
        $purokId = $_POST['deletePurok'];

        $sql = "DELETE FROM purok_boundaries WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $purokId);

        if ($stmt->execute()) {
            echo "Purok deleted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        exit;
    }
}

// Fetch existing puroks to display on the map and in the table
$sql = "SELECT id, purok_name, boundary_coordinates, color FROM purok_boundaries";
$result = $conn->query($sql);

$puroks = [];
while ($row = $result->fetch_assoc()) {
    $puroks[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editable Barangay Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <style>
        #map { width: 100%; height: 600px; }
        #form-container, #table-container { margin-top: 20px; }
        .form-group { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        .delete-btn { color: white; background-color: red; border: none; padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Editable Barangay Map - Legazpi City</h1>
    <div id="map"></div>

    <div id="form-container">
        <form id="purokForm">
            <div class="form-group">
                <label for="purokName">Purok Name:</label>
                <input type="text" id="purokName" required>
            </div>
            <div class="form-group">
                <label for="purokColor">Purok Color:</label>
                <input type="color" id="purokColor" value="#ff5733" required>
            </div>
            <button type="button" onclick="savePurok()">Save Purok</button>
        </form>
    </div>

    <div id="table-container">
        <h2>Existing Puroks</h2>
        <table>
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Color</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="purokTableBody">
                <?php foreach ($puroks as $purok): ?>
                <tr>
                    
                    <td><?php echo $purok['purok_name']; ?></td>
                    <td><div style="width: 20px; height: 20px; background-color: <?php echo $purok['color']; ?>;"></div></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="deletePurok" value="<?php echo $purok['id']; ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Initialize the map centered on Legazpi City
        var map = L.map('map').setView([13.1387, 123.7353], 15);

        // Add a tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Feature group to hold drawn items
        var drawLayer = L.featureGroup().addTo(map);

        // Load existing puroks
        var puroks = <?php echo json_encode($puroks); ?>;
        puroks.forEach(purok => {
            var boundary = L.geoJSON(JSON.parse(purok.boundary_coordinates), {
                style: { color: purok.color, fillOpacity: 0.5 }
            }).addTo(drawLayer).bindPopup(`<b>${purok.purok_name}</b>`);
        });

        // Add draw controls
        var drawControl = new L.Control.Draw({
            edit: { featureGroup: drawLayer },
            draw: { polyline: false, rectangle: false, circle: false, marker: false, circlemarker: false }
        });
        map.addControl(drawControl);

        var currentLayer = null;

        // Capture the created polygon
        map.on('draw:created', function (e) {
            currentLayer = e.layer;
            drawLayer.addLayer(currentLayer);
        });

        // Handle save purok
        function savePurok() {
            if (!currentLayer) {
                alert("Please draw an area on the map first.");
                return;
            }

            var purokName = document.getElementById("purokName").value;
            var purokColor = document.getElementById("purokColor").value;
            var boundaryCoordinates = JSON.stringify(currentLayer.toGeoJSON().geometry);

            // Send data to the server
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Purok saved successfully!");
                    location.reload(); // Refresh to load the new purok
                }
            };
            xhr.send(`purokName=${purokName}&purokColor=${purokColor}&boundaryCoordinates=${boundaryCoordinates}`);
        }
    </script>
</body>
</html>
