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
    <title>Add Purok Boundary | TechCare</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/techcareLogo2.png" type="image/x-icon">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #CDE8E5;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-top: 20px;
        }
        .back-link-container { margin: 50px 90px; } 
        .back-link { color: grey; text-decoration: none; text-align: center; } 
        .back-link:hover { text-decoration: underline; }
    .back-link i { margin-right: 8px; /* Add space between icon and text */ }
        #map { 
            width: 80%; 
            height: 600px; 
            margin: 20px auto; 
            border-radius: 15px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }
        .form-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #2c3e50;
        }
        input[type="text"],
        input[type="color"] {
            width: 98%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            border: none;
            background-color: #4D869C;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: blue;
        }
    .form-actions { display: flex; justify-content: flex-end; /* Aligns the button to the end */ }
    </style>
</head>
<body>
<div class="back-link-container">
     <a href="purok_tables.php" class="back-link"> <i class="fa fa-long-arrow-left"></i>Back to Maps</a> 
</div>
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
            <div class="form-actions"> 
                <button type="button" onclick="savePurok()">Save Purok</button> 
        </div>
        </form>
    </div>

    <script>
        var map = L.map('map').setView([13.1387, 123.7353], 12);

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
