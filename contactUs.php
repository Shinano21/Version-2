<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - CareVisio</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/contactUs.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" href="src/favicon.png" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- PHP Block for Fetching Data -->
    <?php
    include 'db_connection.php';
    
    // Fetch data from the contact_us table
    $query = "SELECT short_mess, email, contact, address, fb_name, fb_link, latitude, longitude FROM contact_us WHERE id = 1";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $shortMess = $row['short_mess'];
        $email = $row['email'];
        $contact = $row['contact'];
        $address = $row['address'];
        $fbAcc = $row['fb_name'];
        $fbLink = $row['fb_link'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
    } else {
        $latitude = null;
        $longitude = null;
    }
    $conn->close();
    ?>

    <!-- Form -->
    <div class="formCont">
        <h1>Contact Us</h1>
        <p>Any questions or remarks? Just write us a message!</p>
        <div class="formDits">
            <div class="contactInfo">
                <h2>Contact Information</h2>
                <p><?php echo $shortMess; ?></p>
                <div class="wIcons">
                    <i class='bx bxs-phone-call'></i>
                    <a href="tel:<?php echo str_replace([' ', '-', '(', ')'], '', $contact); ?>" style="text-decoration:none;color:white;"><?php echo $contact; ?></a>
                </div>
                <div class="wIcons">
                    <i class='bx bxs-envelope'></i>
                    <a href="mailto:<?php echo $email; ?>" style="text-decoration:none;color:white;"><?php echo $email; ?></a>
                </div>
                <div class="wIcons">
                    <i class='bx bxs-location-plus'></i>
                    <a href="http://maps.google.com/?q=<?php echo $address; ?>" target="_blank" style="text-decoration:none;color:white;"><?php echo $address; ?></a>
                </div>
                <div class="wIcons">
                    <i class='bx bxl-facebook-circle'></i>
                    <a href="<?php echo $fbLink; ?>" target="_blank" style="text-decoration:none;color:white;"><?php echo $fbAcc; ?></a>
                </div>
            </div>

            <!-- Map Section -->
            <div id="map" style="height: 400px;"></div>
            <p id="noLocationMessage" style="display:none; color: red; text-align: center;">Location data not available.</p>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Map Script -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var latitude = <?php echo json_encode($latitude); ?>;
        var longitude = <?php echo json_encode($longitude); ?>;

        if (latitude && longitude) {
            // Initialize the map centered on the database coordinates
            var map = L.map('map').setView([latitude, longitude], 15);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add a draggable marker at the location
            var marker = L.marker([latitude, longitude], { draggable: true }).addTo(map);
            marker.bindPopup("<b>Barangay Hall Location</b><br>Latitude: " + latitude + "<br>Longitude: " + longitude).openPopup();

            // Update popup on marker drag
            marker.on('dragend', function (e) {
                var newLatLng = e.target.getLatLng();
                marker.setLatLng(newLatLng).bindPopup("<b>New Location</b><br>Latitude: " + newLatLng.lat.toFixed(6) + "<br>Longitude: " + newLatLng.lng.toFixed(6)).openPopup();
            });
        } else {
            // Hide the map and show message if coordinates are unavailable
            document.getElementById('map').style.display = 'none';
            document.getElementById('noLocationMessage').style.display = 'block';
        }
    </script>
</body>
</html>
