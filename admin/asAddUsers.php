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
    <title>Add Admin Users | CareVisio</title>
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
                <p>Create Admin User</p>
            </div>
            <?php if (isset($_GET["success"])): ?>
                <p style="color: green;"><?php echo $_GET["success"]; ?></p>
            <?php endif; ?>

            <?php if (isset($_GET["error"])): ?>
                <p style="color: red;"><?php echo $_GET["error"]; ?></p>
            <?php endif; ?>

            <div class="form">
                <form action="account_system.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="status" value="Active">
                    <input type="text" name="type" value="Health Personnel" style="display: none;">
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" name="fname" placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Middle Name</label>
                        <input type="text" name="mname" placeholder="Enter middle name">
                    </div>
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" name="lname" placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Number</label>
                        <input type="tel" name="contact" placeholder="Enter contact number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Enter email address" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="position">
                        <label for="position">Position:</label>
                        <select name="position" id="position" required>
                            <option value="">Select a position</option>
                            <option value="System Administrator">System Admin</option>
                            <option value="Barangay Nurse">Barangay Nurse</option>
                            <option value="Barangay Health Worker">Barangay Health Worker</option>
                        </select>
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
