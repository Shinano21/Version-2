<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - TechCare</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="../css/contactUs.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="shortcut icon" href="images/techcareLogo2.png" type="image/x-icon">
    <style>
        #map {
            height: 400px; /* Ensure the map container has a height */
            width: 100%;
        }

        #noLocationMessage {
            display: none;
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- PHP Block for Fetching Data -->
    <?php
    include 'dbcon.php';

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
            <div id="map"></div>
            <p id="noLocationMessage">Location data not available.</p>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Leaflet Map Script -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // PHP values passed to JavaScript
        var latitude = <?php echo json_encode($latitude); ?>;
        var longitude = <?php echo json_encode($longitude); ?>;

        console.log("Latitude:", latitude, "Longitude:", longitude); // Debugging coordinates

        if (latitude && longitude) {
            // Initialize map
            var map = L.map('map').setView([latitude, longitude], 15);
            console.log("Map initialized:", map); // Debugging map initialization

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add marker
            var marker = L.marker([latitude, longitude], { draggable: true }).addTo(map);
            marker.bindPopup("<b>Location</b><br>Latitude: " + latitude + "<br>Longitude: " + longitude).openPopup();

            // Update popup on marker drag
            marker.on('dragend', function (e) {
                var newLatLng = e.target.getLatLng();
                marker.setLatLng(newLatLng).bindPopup("<b>New Location</b><br>Latitude: " + newLatLng.lat.toFixed(6) + "<br>Longitude: " + newLatLng.lng.toFixed(6)).openPopup();
            });
        } else {
            // Hide map and show error message if no coordinates
            document.getElementById('map').style.display = 'none';
            document.getElementById('noLocationMessage').style.display = 'block';
        }
    </script>
</body>

</html>
