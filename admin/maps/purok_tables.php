<?php
// Include the database connection
include '../dbcon.php';

// Fetch existing Puroks
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
    <title>Purok Boundaries Table</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .action-btn { padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
        .edit-btn { background-color: #007bff; color: white; }
        .edit-btn:hover { background-color: #0056b3; }
        .delete-btn { background-color: red; color: white; }
        .delete-btn:hover { background-color: darkred; }
        .add-btn { background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px; }
        .add-btn:hover { background-color: #218838; }
        #map { width: 100%; height: 500px; margin: 20px 0; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Purok Boundaries</h1>
    
    <!-- Add Purok Button -->
    <div style="text-align: center;">
        <a href="add_purok.php" class="add-btn">Add New Purok</a>
    </div>

    <!-- Map Container -->
    <div id="map"></div>

    <!-- Purok Table -->
    <table>
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>Purok Name</th>
                <th>Boundary Color</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($puroks) > 0): ?>
                <?php foreach ($puroks as $purok): ?>
                <tr>
                    <!-- <td><?php echo htmlspecialchars($purok['id']); ?></td> -->
                    <td><?php echo htmlspecialchars($purok['purok_name']); ?></td>
                    <td>
                        <div style="width: 20px; height: 20px; background-color: <?php echo htmlspecialchars($purok['color']); ?>; margin: auto;"></div>
                    </td>
                    <td>
                        <form action="edit_purok.php" method="GET" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($purok['id']); ?>">
                            <button type="submit" class="action-btn edit-btn">Edit</button>
                        </form>
                        <form action="delete_purok.php" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($purok['id']); ?>">
                            <button type="submit" class="action-btn delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No Puroks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        // Initialize the map
        var map = L.map('map').setView([13.1387, 123.7353], 15);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add Purok boundaries
        <?php foreach ($puroks as $purok): ?>
        (function() {
            var boundaryCoordinates = <?php echo $purok['boundary_coordinates']; ?>; // GeoJSON format
            var color = "<?php echo htmlspecialchars($purok['color']); ?>";

            // Add the polygon to the map
            L.geoJSON(boundaryCoordinates, {
                style: {
                    color: color,
                    weight: 2,
                    fillOpacity: 0.5
                }
            }).bindPopup("<strong><?php echo htmlspecialchars($purok['purok_name']); ?></strong>").addTo(map);
        })();
        <?php endforeach; ?>
    </script>
</body>
</html>
