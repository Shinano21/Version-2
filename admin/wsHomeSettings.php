<?php
session_start();

include "dbcon.php";
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}
?>
<?php
// Define variables with default empty values
$centerName = '';
$address = '';
$email = '';
$contact = '';
$openHours = '';
$shortDesc = '';
$mission = '';
$vision = '';
$goal = '';
$chairman = '';
$chairmanComm = '';
$contactMess = '';
$officeHrs = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Settings | TechCare</title>
    <?php include "../user/data/home.php"; ?>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/wsHome.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
          body{
    background-color: #CDE8E5;
  }
    </style>
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
                        <button class="tablinks active" onclick="openTab(event, 'Tab1')">Hero Section</button>
                        <button class="tablinks" onclick="openTab(event, 'Tab2')">About Us</button>
                        <button class="tablinks" onclick="openTab(event, 'Tab3')">Contact Us</button>
                    </div>

                    <div id="Tab1" class="tabcontent">
                        <form action="cms/edit_home.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Hero Section</h5>
                                <input type="hidden" name="header" value="Hero Section">
                                <div class="formInput">
                                    <label>Barangay Health Center</label>
                                    <input type="text" name="center_name" value="<?php echo $centerName ?>"
                                        placeholder="Enter Name(ex. Barangay Bagumbayan Health Center)" required>
                                </div>
                                <div class="formInput">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?php echo $address ?>"
                                        placeholder="Enter complete address" required>
                                </div>
                                <div class="formInput">
                                    <label>Email</label>
                                    <input type="text" name="email" value="<?php echo $email ?>"
                                        placeholder="Enter email" required>
                                </div>
                                <div class="formInput">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact" value="<?php echo $contact?>"
                                        placeholder="Enter contact number" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Open Hours</label>
                                    <input type="text" name="open_hours" value="<?php echo $openHours?>"
                                        placeholder="Enter Open Hours(ex. Monday to Friday(8:00am - 5:00pm) )" required>
                                </div>
                                <div class="photo">
                                    <label for="imageInput">Hero/ Background Image:</label>
                                    <input type="file" name="bg_img" id="imageInput" accept="image/*" required>
                                    <div class="preview">
                                        <img id="preview" src="#" alt="Preview"
                                            style="display:none; max-width:250px; max-height:250px;">
                                    </div>
                                </div>
                                <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                    <button type="submit" name="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="Tab2" class="tabcontent">
                        <form action="cms/edit_home.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>About Us</h5>
                                <input type="hidden" name="header" value="About Us">
                                <div class="formInput" style="width: 100%;">
                                    <label>Short Description</label>
                                    <textarea name="short_desc"
                                        placeholder="Enter a short description for the barangay health center"
                                        required><?php echo $shortDesc ?></textarea>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Mission</label>
                                    <textarea name="mission"
                                        placeholder="Enter the mission for the barangay health center"
                                        required><?php echo $mission ?></textarea>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Vision</label>
                                    <textarea name="vision"
                                        placeholder="Enter the vision for the barangay health center"
                                        required><?php echo $vision ?></textarea>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Goal</label>
                                    <textarea name="goal" placeholder="Enter the goal for the barangay health center"
                                        required><?php echo $goal ?></textarea>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Chairman</label>
                                    <input type="text" name="chairman" value="<?php echo $chairman?>"
                                        placeholder="Enter name of the chairman" required>
                                </div>
                                <div class="photo">
                                    <label for="imageInput">Chairman Image:</label>
                                    <input type="file" id="imageInput" name="chairman_pic" accept="image/*" >
                                    <div class="preview">
                                        <img id="preview" src="#" alt="Preview"
                                            style="display:none; max-width:250px; max-height:250px;">
                                    </div>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Chairman Committee on Health</label>
                                    <input type="text" name="chairman_comm" value="<?php echo $chairmanComm?>"
                                        placeholder="Enter name of the chairman" required>
                                </div>
                                <div class="photo">
                                    <label for="imageInput">Chairman Committee Image:</label>
                                    <input type="file" id="imageInput" name="chairman_comm_pic" accept="image/*"
                                        required>
                                    <div class="preview">
                                        <img id="preview" src="#" alt="Preview"
                                            style="display:none; max-width:250px; max-height:250px;">
                                    </div>
                                </div>
                                <div class="photo">
                                    <label for="imageInput">Section/ Supporting Image:</label>
                                    <input type="file" id="imageInput" name="section_pic" accept="image/*" required>
                                    <div class="preview">
                                        <img id="preview" src="#" alt="Preview"
                                            style="display:none; max-width:250px; max-height:250px;">
                                    </div>
                                </div>
                                <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                    <button type="submit" name="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="Tab3" class="tabcontent">
                        <form action="cms/edit_home.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Contact Us</h5>
                                <input type="hidden" name="header" value="Contact Us">
                                <div class="formInput" style="width: 100%;">
                                    <label>Short Message</label>
                                    <textarea name="contact_mess" placeholder="Enter a short message"
                                        required><?php echo $contactMess ?></textarea>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Office Hours</label>
                                    <input type="text" name="office_hrs" value="<?php echo $officeHrs ?>"
                                        placeholder="Enter Open Hours(ex. Monday to Friday(8:00am - 5:00pm) )" required>
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
        const header = document.getElementById('Tab1').querySelector('h5').textContent;
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
        console.log(document.getElementById(tabName));
    }
    </script>
    <script>
        document.getElementById('imageInput').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block'; // Show the preview image
    }
};

    </script>
    <!-- <script src="js/preview.js"></script> -->
</body>

</html>