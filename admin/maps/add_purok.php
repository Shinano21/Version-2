<?php
// Include the database connection
include '../dbcon.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $purokName = $_POST['purokName'] ?? null;
    $purokColor = $_POST['purokColor'] ?? null;
    $boundaryCoordinates = $_POST['boundaryCoordinates'] ?? null;

    if ($purokName && $purokColor && $boundaryCoordinates) {
        $sql = "INSERT INTO purok_boundaries (barangay_name, purok_name, boundary_coordinates, color) 
                VALUES ('Barangay 1', ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $purokName, $boundaryCoordinates, $purokColor);

        if ($stmt->execute()) {
            echo "Purok added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
        exit;
    } else {
        echo "All fields are required.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Purok Boundary</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <style>
        #map { width: 100%; height: 600px; margin-top: 20px; }
        .form-group { margin-bottom: 10px; }
        .form-container { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Add Purok Boundary</h1>
    <div id="map"></div>
    <div class="form-container">
        <form id="addPurokForm">
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

    <script>
        var map = L.map('map').setView([13.1387, 123.7353], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var drawLayer = L.featureGroup().addTo(map);
        var drawControl = new L.Control.Draw({
            edit: { featureGroup: drawLayer },
            draw: { polyline: false, rectangle: false, circle: false, marker: false, circlemarker: false }
        });
        map.addControl(drawControl);

        var currentLayer = null;

        map.on('draw:created', function (e) {
            currentLayer = e.layer;
            drawLayer.addLayer(currentLayer);
        });

        function savePurok() {
            if (!currentLayer) {
                alert("Please draw a boundary on the map.");
                return;
            }

            var purokName = document.getElementById("purokName").value.trim();
            var purokColor = document.getElementById("purokColor").value;
            var boundaryCoordinates = JSON.stringify(currentLayer.toGeoJSON().geometry);

            if (!purokName) {
                alert("Purok Name is required.");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Purok added successfully!");
                    location.reload();
                }
            };
            xhr.send(`purokName=${purokName}&purokColor=${purokColor}&boundaryCoordinates=${boundaryCoordinates}`);
        }
    </script>
</body>
</html>
