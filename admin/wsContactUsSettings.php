<?php
session_start();

include "dbcon.php";
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact Us Settings | CareVisio</title>
    <?php include "../user/data/contact_us.php"; ?>
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
                <h5 style="padding: 25px 30px 0;">Contact Us Page</h5>
                <section id="main-content">
                    <div class="tabcontent show">
                        <form action="cms/edit_contact.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Contact Us</h5>
                                <div class="formInput" style="width: 100%;">
                                    <label>Short Message</label>
                                    <textarea name="short_mess" placeholder="Enter data"
                                        required><?php echo $shortMess ?></textarea>
                                </div>
                                <div class="formInput">
                                    <label>Email</label>
                                    <input type="text" value="<?php echo $email ?>" name="email"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="formInput">
                                    <label>Contact Number</label>
                                    <input type="text" value="<?php echo $contact ?>" name="contact"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Address</label>
                                    <input type="text" value="<?php echo $address ?>" name="address"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Facebook Account Name</label>
                                    <input type="text" value="<?php echo $fbAcc ?>" name="fb_acc"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Facebook Account Link</label>
                                    <input type="text" value="<?php echo $fbLink ?>" name="fb_link"
                                        placeholder="Enter data (put 'https://' at the start)" required>
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
    <script src="js/preview.js"></script>
</body>

</html>