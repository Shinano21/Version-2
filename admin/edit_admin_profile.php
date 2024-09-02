<?php

session_start();

include "../dbcon.php";
if(!isset($_SESSION["user"])){
    header("../Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile | CareVisio</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/editProfile.css">
</head>
<body onload="display_ct();">
    <?php
    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "System Administrator") {
        include "partials/admin_sidebar.php";
    } else {
        include "partials/sidebar.php";
    }
    ?>
    <!-- /# sidebar -->
    <?php include "partials/header.php"?>
    
   
<div class="content-wrap">
    <?php 
        $sql = mysqli_query($conn, "SELECT * FROM administrator WHERE unique_id = {$_SESSION['unique_id']}");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
        }
    ?>

    <!-- Content -->
    <div class="editForm">
        <div class="password" id="profile">
            <h3>Update Profile</h3>
            <form action="updateProfile.php" method="post" enctype="multipart/form-data">
                <div class="form">
                    <div class="formInput">
                        <p>First Name</p>
                        <input type="text" name="fname" value="<?php echo $row['fname']; ?>" placeholder="Your first name here"
                        >
                    </div>
                    <div class="formInput">
                        <p>Middle Name</p>
                        <input type="text" name="mname" value="<?php echo $row['mname']; ?>"
                        placeholder="Your middle name here">
                    </div>
                    <div class="formInput">
                        <p>Last Name</p>
                        <input type="text" name="lname" value="<?php echo $row['lname']; ?>" placeholder="Your last name here"
                        >
                    </div>
                    <div class="formInput">
                        <p>Email</p>
                        <input type="text" name="email" value="<?php echo $row['email']; ?>" placeholder="Your email here"
                        >
                    </div>
                </div>
                <button type="submit" name="submit">Update Profile</button>
            </form>
        </div>

        <div class="password">
            <h3>Change Password</h3>
            <form action="updatePassword.php" method="post" enctype="multipart/form-data"
                onsubmit="return validateForm()">
                <div class="form">
                    <div class="formInput">
                        <p>Old Password</p>
                        <input type="password" name="old_password" placeholder="Enter previous password" required>
                    </div>
                    <div class="formInput">
                        <p>New Password</p>
                        <input type="password" name="new_password" id="new_password" placeholder="Enter new password"
                            required>
                    </div>
                    <div class="formInput">
                        <p>Confirm Password</p>
                        <input type="password" name="confirm_password" id="confirm_password"
                            placeholder="Confirm new password" required>
                        <span id="passwordMismatch" style="color: red; display: none;">Passwords do not match</span>
                    </div>
                </div>
                <button type="submit" name="submit">Update Password</button>
            </form>
        </div>
    </div>
</div>
    <script>
    function validateForm() {
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (newPassword !== confirmPassword) {
            document.getElementById('passwordMismatch').style.display = 'block';
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
    </script>
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

    <!-- ===============================scripts================================== -->

    <!-- jquery vendor -->
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <!-- bootstrap -->




    <script src="js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="js/lib/weather/weather-init.js"></script>
    <script src="js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="js/lib/chartist/chartist.min.js"></script>
    <script src="js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/lib/owl-carousel/owl.carousel-init.js"></script>
    <!-- scripit init-->
    <script src="js/dashboard2.js"></script>
</body>

</html>