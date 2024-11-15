<?php
session_start();
include "dbcon.php";

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Initialize variables with default values
$shortMess = '';
$email = '';
$contact = '';
$address = '';
$fbAcc = '';
$fbLink = '';
$latitude = '';
$longitude = '';

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shortMess = mysqli_real_escape_string($conn, $_POST['short_mess']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $fbAcc = mysqli_real_escape_string($conn, $_POST['fb_acc']);
    $fbLink = mysqli_real_escape_string($conn, $_POST['fb_link']);
    $latitude = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($conn, $_POST['longitude']);

    $query = "
        UPDATE contact_us 
        SET 
            short_mess = '$shortMess',
            email = '$email',
            contact = '$contact',
            address = '$address',
            fb_name = '$fbAcc',
            fb_link = '$fbLink',
            latitude = '$latitude',
            longitude = '$longitude'
        WHERE id = 1"; // Assuming the record ID is 1

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Contact Us settings updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch data from the database
$query = "SELECT * FROM contact_us LIMIT 1";
$result = mysqli_query($conn, $query);
if ($row = mysqli_fetch_assoc($result)) {
    $shortMess = $row['short_mess'];
    $email = $row['email'];
    $contact = $row['contact'];
    $address = $row['address'];
    $fbAcc = $row['fb_name'];
    $fbLink = $row['fb_link'];
    $latitude = $row['latitude'];
    $longitude = $row['longitude'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us Settings | TechCare</title>
    <?php include "../user/data/contact_us.php"; ?>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/wsHome.css">
    <link href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" rel="stylesheet" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body onload="display_ct();">

    <?php include "partials/sidebar.php" ?>
    <?php include "partials/header.php" ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <h5 style="padding: 25px 30px 0;">Contact Us Page</h5>
                <section id="main-content">
                    <div class="tabcontent show">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Contact Us</h5>
                                <div class="formInput" style="width: 100%;">
                                    <label>Short Message</label>
                                    <textarea name="short_mess" placeholder="Enter data" required><?php echo $shortMess ?></textarea>
                                </div>
                                <div class="formInput">
                                    <label>Email</label>
                                    <input type="text" value="<?php echo $email ?>" name="email" placeholder="Enter data" required>
                                </div>
                                <div class="formInput">
                                    <label>Contact Number</label>
                                    <input type="text" value="<?php echo $contact ?>" name="contact" placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Address</label>
                                    <input type="text" value="<?php echo $address ?>" name="address" placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Facebook Account Name</label>
                                    <input type="text" value="<?php echo $fbAcc ?>" name="fb_acc" placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Facebook Account Link</label>
                                    <input type="text" value="<?php echo $fbLink ?>" name="fb_link" placeholder="Enter data (put 'https://' at the start)" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Latitude</label>
                                    <input type="text" id="latitude" value="<?php echo $latitude ?>" name="latitude" placeholder="Enter latitude" required readonly>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Longitude</label>
                                    <input type="text" id="longitude" value="<?php echo $longitude ?>" name="longitude" placeholder="Enter longitude" required readonly>
                                </div>
                                <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                    <button type="submit" name="submit">Save</button>
                                </div>
                            </div>
                        </form>

                        <div id="map" style="height: 400px; width: 100%; margin-top: 20px;"></div>

                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        function display_ct() {
            var x = new Date();
            var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var timeString = x.toLocaleTimeString('en-US', options);
            var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });
            var x1 = datePart + ' - ' + timeString;
            document.getElementById('ct').innerHTML = x1;
        }
        display_ct();

        var latitude = "<?php echo $latitude; ?>" || 13.1399;
        var longitude = "<?php echo $longitude; ?>" || 123.7438;

        var map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([latitude, longitude], { draggable: true }).addTo(map);
        marker.bindPopup("<b>Drag this marker to pinpoint location</b>").openPopup();

        marker.on('dragend', function (e) {
            var newLatLng = marker.getLatLng();
            document.getElementById('latitude').value = newLatLng.lat.toFixed(6);
            document.getElementById('longitude').value = newLatLng.lng.toFixed(6);
        });
    </script>

    <?php include "partials/scripts.php"; ?>
    <script src="js/preview.js"></script>
</body>
</html>
