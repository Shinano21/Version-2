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
    <title>Edit Purok Boundary | TechCare</title>
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
        .back-link-container {
            margin: 50px 90px;
            text-align: left;
        }
        .back-link {
            color: grey;
            text-decoration: none;
        }
        .back-link i {
            margin-right: 8px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .map-container {
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
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #4D869C;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="back-link-container">
        <a href="purok_tables.php" class="back-link">
            <i class="fa fa-long-arrow-left"></i>Back to Maps
        </a>
    </div>
    <h1>Edit Purok: <?php echo htmlspecialchars($purok['purok_name']); ?></h1>
    
    <div class="map-container" id="map"></div>

    <div class="form-container">
        <div class="form-group">
            <label for="purok_name">Purok Name:</label>
            <input type="text" id="purok_name" value="<?php echo htmlspecialchars($purok['purok_name']); ?>">
        </div>
        <div class="form-group">
            <label for="color">Boundary Color:</label>
            <input type="color" id="color" value="<?php echo htmlspecialchars($purok['color']); ?>">
        </div>
        <div class="form-actions">
            <button type="button" id="save-btn">Save Changes</button>
        </div>
    </div>

   

    <script>
    (function() {
        var map = L.map('map').setView([13.1387, 123.7353], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var boundaryCoordinates = <?php echo $purok['boundary_coordinates']; ?>;

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var polygon = L.geoJSON(boundaryCoordinates, {
            style: {
                color: '<?php echo htmlspecialchars($purok['color']); ?>',
                weight: 2,
                fillOpacity: 0.5
            }
        }).eachLayer(function(layer) {
            drawnItems.addLayer(layer);
        });

        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: drawnItems,
                remove: false
            },
            draw: false
        });
        map.addControl(drawControl);

        document.getElementById('save-btn').addEventListener('click', function() {
            var updatedLayer = drawnItems.getLayers()[0];
            var updatedGeoJSON = updatedLayer.toGeoJSON();

            fetch('', {
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
