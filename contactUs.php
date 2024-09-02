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
    <?php include 'navbar.php' ?>
    <?php include "user/data/contact_us.php" ?>
    <!-- Form -->
    <div class="formCont">
        <h1>Contact Us</h1>
        <p>Any questions or remarks? Just write us a message!</p>
        <div class="formDits">
            <div class="contactInfo">
                <h2>Contact Information</h2>
                <p><?php echo $shortMess ?></p>
                <div class="wIcons">
                    <i class='bx bxs-phone-call'></i>
                    <a href="tel:<?php echo str_replace([' ', '-', '(', ')'], '', $contact); ?>" style="text-decoration:none;color:white;"><?php echo $contact; ?></a>
                </div>
                <div class="wIcons">
                    <i class='bx bxs-envelope'></i>
                    <a href="mailto:<?php echo $email; ?>" style="text-decoration:none;color:white;"> <?php echo $email; ?></a>
                </div>
                <div class="wIcons">
                    <i class='bx bxs-location-plus'></i>
                    <a href=" http://maps.google.com/?q=<?php echo $address; ?>" target="_blank" style="text-decoration:none;color:white;"><?php echo $address; ?></a>
                </div>
                <div class="wIcons">
                    <i class='bx bxl-facebook-circle'></i>
                    <a href="<?php echo $fbLink ?>" target="_blank"
                        style="text-decoration: none; color: white;"><?php echo $fbAcc ?></a>
                </div>
            </div>

            <div id="map"></div>

        </div>
    </div>



    <!-- Footer -->
    <?php include 'footer.php' ?>

    <!-- ===============================scripts================================== -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
    var map = L.map('map').setView([13.141909480943658, 123.71758288219154],
        15); // Set initial coordinates and zoom level

    // Add the OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Add a marker to the map
    var marker = L.marker([13.141235069278213, 123.71517097995822]).addTo(map);
    marker.bindPopup("<b>Bagumbayan Multipurpose Hall</b>").openPopup();

    // GeoJSON data outlining the boundary of Bagumbayan, Daraga, Albay area
    var bagumbayanBoundary = {
        "type": "Feature",
        "properties": {},
        "geometry": {
            "type": "Polygon",
            "coordinates": [
                [
                    [123.716251, 13.138571],
                    [123.720586, 13.138696],
                    [123.722741, 13.142676],
                    [123.720640, 13.142652],
                    [123.719682, 13.142426],
                    [123.719445, 13.142840],
                    [123.718300, 13.143890],
                    [123.717792, 13.144026],
                    [123.717770, 13.144667],
                    [123.717070, 13.144698],
                    [123.716765, 13.145426],
                    [123.716555, 13.145357],
                    [123.716251, 13.145879],
                    [123.715603, 13.145648],
                    [123.715436, 13.146055],
                    [123.713790, 13.145453],
                    [123.714999, 13.141329]
                ]
            ]
        }
    };

    // Create a Leaflet GeoJSON object from the GeoJSON data
    L.geoJSON(bagumbayanBoundary).addTo(map);
    </script>
</body>

</html>