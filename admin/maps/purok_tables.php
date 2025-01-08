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
    <title>Purok Boundaries Table | TechCare</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/techcareLogo2.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #CDE8E5;}
        table { width: 80%; border-collapse: collapse; margin: 20px auto; background-color: white; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .action-btn { padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
        .edit-btn { background-color: #007bff; color: white; }
        .edit-btn:hover { background-color: #0056b3; }
        .delete-btn { background-color: red; color: white; }
        .delete-btn:hover { background-color: darkred; }
        .add-btn { background-color: #4D869C; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 10px; }
        .add-btn:hover { background-color: blue; }
        /* #map { 
            width: 80%; height: 500px; margin:auto; 
            border: 2px solid #000; background-color: #eaeaea; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); border-radius: 8px;
        } */
        #map { width: 80%; height: 500px; margin: 50px auto; border: 3px solid #2c3e50; border-radius: 15px; background: linear-gradient(135deg, #74ebd5 0%, #acb6e5 100%); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); position: relative; overflow: hidden; animation: fadeIn 1.5s ease-in-out; } 
        #map::before { content: ''; position: absolute; top: 0; right: 0; bottom: 0; left: 0; background: rgba(255, 255, 255, 0.2); pointer-events: none; } 
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } } 
        @media (max-width: 768px) { #map { width: 95%; height: 400px; } }
    .link-container { position: relative; margin-top: 50px; /* Adjust this value as needed */ } 
.back-link { margin-left: 80px; color: grey; text-decoration: none; /* Underline by default */ } 
.back-link:hover { text-decoration: underline; /* Remove underline on hover */ } 
.back-link i { margin-right: 8px; /* Space between icon and text */ }

    .btn-action {
        background-color: #4D869C;
        border-color: #4D869C;
        color: white;
    }
    .btn-action:hover {
        background-color: #3A6A78; /* Slightly darker shade for hover */
        border-color: #3A6A78;
    }


    </style>
</head>
<body>
<div class="link-container">
     <a href="../home.php" class="back-link"> <i class="fa fa-long-arrow-left"></i> <span>Back to Home</span> </a> 
    </div>
    <h2 style="text-align: center; font-weight:bold;">Purok Boundaries</h2>
    
    
    <!-- Add Purok Button -->
    <div style="text-align: end; margin-right:120px;">
        <a href="add_purok.php" class="add-btn">Add New Purok</a>
    </div>

    <!-- Map Container -->
    <div id="map"></div>

    <!-- Purok Table -->
    <table>
    <thead>
        <tr>
            <th>Purok Name</th>
            <th>Boundary Color</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($puroks) > 0): ?>
            <?php foreach ($puroks as $purok): ?>
            <tr>
                <td><?php echo htmlspecialchars($purok['purok_name']); ?></td>
                <td>
                    <div style="width: 20px; height: 20px; background-color: <?php echo htmlspecialchars($purok['color']); ?>; margin: auto;"></div>
                </td>
                <td>
                    <!-- Dropdown for Actions -->
                    <div class="dropdown">
                        <button class="btn btn-action dropdown-toggle" type="button" id="dropdownMenuButton<?php echo htmlspecialchars($purok['id']); ?>" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo htmlspecialchars($purok['id']); ?>">
                          
                            <li>
                                <form action="edit_purok.php" method="GET">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($purok['id']); ?>">
                                    <button type="submit" class="dropdown-item">Update</button>
                                </form>
                            </li>
                            <li>
                                <form action="delete_purok.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($purok['id']); ?>">
                                    <button type="submit" class="dropdown-item">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No Puroks found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


    <script>
        // Initialize the map
        // var map = L.map('map').setView([13.1387, 123.7353], 15);
        const map = L.map('map').setView([13.142307, 123.71827], 12); // Set the initial view and zoom level


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
    <!-- Bootstrap JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
