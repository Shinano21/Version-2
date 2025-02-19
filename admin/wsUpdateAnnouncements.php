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
    <title>Update Announcement | TechCare</title>
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
    <?php
    if(isset($_GET["id"])){
        $idx = $_GET["id"];
        $sql = "SELECT * FROM announcements WHERE id = $idx";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
   
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $announceType = $row["announce_type"];
                $announceHeading = $row["announce_heading"];
                $announceBody = $row["announce_body"];
                $announcePic = $row["announce_pic"];
            }
        }
    }
    ?>
    <div class="content-wrap">
        <div class="main">

            <div class="container-fluid">
                <h5 style="padding: 25px 30px 0;">Announcements / Update Announcement</h5>
                <section id="main-content">
                    <div class="tabcontent show">
                        <form action="cms/update_announcements.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Program</h5>
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <div class="formInput" style="width: 100%;">
                                    <label for="announce_type">Type of Announcement</label>
                                    <select name="announce_type" id="announceType">
                                        <?php echo "<option value='" . $announceType . "' selected>" . $announceType . "</option>"; ?>
                                        <option value="Basic Healthcare">Basic Healthcare</option>
                                        <option value="Pre & Post Natal Care">Pre & Post Natal Care</option>
                                        <option value="Family Planning">Family Planning</option>
                                        <option value="Immunization">Immunization</option>
                                        <option value="Vaccination">Vaccination</option>
                                        <option value="Nutrition Program">Nutrition Program</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Heading</label>
                                    <input type="text" value="<?php echo $announceHeading ?>" name="announce_heading"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Body</label>
                                    <textarea placeholder="Enter data" name="announce_body"
                                        required><?php echo $announceBody ?></textarea>
                                </div>
                                <div class="photo">
                                    <label for="imageInput">Program Image:</label>
                                    <input type="file" id="imageInput" name="announce_pic" accept="image/*" required>
                                    <div class="preview">
                                        <?php
                                        if ($announcePic !== null) {
                                            $imageType = strpos($announcePic, '/png') !== false ? 'png' : 'jpeg';
                                            echo "<img id='preview' src='data:image/{$imageType};base64," . base64_encode($announcePic) . "' alt='Preview' style='max-width:250px; max-height:250px;'>";
                                        } else {
                                            echo "<img id='preview' src='#' alt='Preview' style='display:none; max-width:250px; max-height:250px;'>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                    <button type="submit" name="submit">Update</button>
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