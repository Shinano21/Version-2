<?php
session_start();

include "dbcon.php";
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}
?>
<?php
$navbarLogo = null; // Define a default value for $navbarLogo
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Logo and Footer Settings | TechCare</title>
    <?php include "../user/data/logo.php"; ?>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/wsHome.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body onload="display_ct();">

    <?php include "partials/sidebar.php"?>
    <!-- Sidebar -->
    <?php include "partials/header.php" ?>
    <!-- Header -->

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <section id="main-content">
                    <div class="tab">
                        <button class="tablinks active" onclick="openTab(event, 'Tab1')">Logo</button>
                        <button class="tablinks" onclick="openTab(event, 'Tab2')">Footer</button>
                    </div>
                    <div id="Tab1" class="tabcontent">
                        <form action="cms/edit_logo.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Navigation Bar Logo</h5>
                                <input type="hidden" name="header" value="Navbar Logo">
                                <div class="photo">
                                    <label for="imageInput">Logo Image:</label>
                                    <input type="file" id="imageInput" name="navbar_logo" accept="image/*" required>
                                    <div class="preview">
                                        <?php
                                        if ($navbarLogo !== null) {
                                            $imageType = strpos($navbarLogo, '/png') !== false ? 'png' : 'jpeg';
                                            echo "<img id='preview' src='data:image/{$imageType};base64," . base64_encode($navbarLogo) . "' alt='Preview' style='max-width:250px; max-height:250px;'>";
                                        } else {
                                            echo "<img id='preview' src='#' alt='Preview' style='display:none; max-width:250px; max-height:250px;'>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                    <button type="submit" name="submit">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div id="Tab2" class="tabcontent">
                        <form action="cms/edit_logo.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Footer</h5>
                                <input type="hidden" name="header" value="Footer">
                                <div class="formInput" style="width: 100%;">
                                    <label>Barangay Health Center</label>
                                    <input type="text" name="center_name" value="<?php echo $centerName ?>"
                                        placeholder="Enter Name(ex. Barangay Bagumbayan Health Center)" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Short Description</label>
                                    <textarea placeholder="Enter a short description for the barangay health center"
                                        name="short_desc" required> <?php echo $shortDesc ?></textarea>
                                </div>
                                <div class="formInput">
                                    <label>Email</label>
                                    <input type="text" name="email" value="<?php echo $email ?>"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="formInput">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact" value="<?php echo $contact ?>"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?php echo $address ?>"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="photo">
                                    <label for="imageInput">Barangay Health Center Logo:</label>
                                    <input type="file" id="imageInput" name="center_logo" accept="image/*" required>
<div class="preview">
    <?php
    if (isset($footerLogo)) {
        $imageType = strpos($footerLogo, '/png') !== false ? 'png' : 'jpeg';
        echo "<img id='preview' src='data:image/{$imageType};base64," . base64_encode($footerLogo) . "' alt='Preview' style='max-width:250px; max-height:250px;'>";
    }
    ?>
</div>


                                </div>
                                <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                    <button type="submit" name="submit">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </section>
            </div>
        </div>
    </div>
    <script>
        function display_c() {
            var refresh = 1000; // Refresh rate in milliseconds
            mytime = setTimeout('display_ct()', refresh);
        }

        function display_ct() {
            var x = new Date();
            
            // Set the time zone to Philippine Time (PHT)
            var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var timeString = x.toLocaleTimeString('en-US', options);

            // Extract the date part in the format "Day, DD Mon YYYY"
            var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });

            // Combine date and time in the desired format
            var x1 = datePart + ' - ' + timeString;

            document.getElementById('ct').innerHTML = x1;
            tt = display_c();
        }

        // Initial call to start displaying time
        display_c();
    </script>
    <?php include "partials/scripts.php"; ?>
    <script>
    window.onload = function() {
        document.getElementById('Tab1').classList.add("show");
        document.querySelector('.tablinks.active').classList.remove('active');
        document.querySelector('.tablinks').classList.add('active');
    };

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.remove("show");
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        document.getElementById(tabName).classList.add("show");
        evt.currentTarget.classList.add("active");
    }
    </script>
    <script src="js/preview.js"></script>
</body>

</html>