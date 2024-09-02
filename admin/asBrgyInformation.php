<?php
session_start();

include '../dbcon.php';

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] !== "System Administrator") {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/settings.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body onload="display_ct();">

    <?php include "partials/admin_sidebar.php"?>
    <!-- Sidebar -->
    <?php include "partials/header.php" ?>
    <!-- Header -->

    <div class="content-wrap">
        <div class="main">

            <div class="container-fluid">
                <section id="main-content">
                <div class="contentBg">
        
        <div class="contentBox">
            <div class="titles">
                <p>Barangay Information</p>
            </div>
            <?php if (isset($_GET["success"])): ?>
                <p style="color: green;"><?php echo $_GET["success"]; ?></p>
            <?php endif; ?>

            <?php if (isset($_GET["error"])): ?>
                <p style="color: red;"><?php echo $_GET["error"]; ?></p>
            <?php endif; ?>

            <div class="form">
                <form action="account_system.php" method="post" enctype="multipart/form-data">
                    <div class="form-group" style="width:100%;">
                        <label for="name">Barangay Health Center</label>
                        <input type="text" name="bhc" placeholder="Enter name of the Barangay Health Center" required>
                    </div>
                    <div class="photo">
                        <label for="imageInput">Barangay Logo:</label>
                        <input type="file" id="imageInput" name="image" accept="image/*"  required>
                        <div class="preview">
                            <img id="preview" src="#" alt="Preview" style="display:none; max-width:250px; max-height:250px;">
                        </div>
                    </div>
                    <div class="subBtn">
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
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
    <script src="js/preview.js"></script>
</body>

</html>