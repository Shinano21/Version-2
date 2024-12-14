<?php


session_start();

include "../dbcon.php";
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>View Anti-pneumonia Vaccination Record | CareVisio</title>
    <?php include "../services/head.php"; ?>
</head>

<body onload="display_ct();">

    <?php include "../services/header.php"?>
    <?php include "../services/sidebar.php"?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                            <a href="../services5.php"><h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i>
                          Back to Anti-pneumonia Vaccination Records</h7></a>
                                <h1>Update Record</h1>

                         
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../home.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Services</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                <form action="add.php" method="post">
                    <div class="row" position="relative;" id="a1">
                    
                    <?php

$id=$_GET["update"];
$query = "SELECT * FROM `anti_pneumonia` WHERE `id` = $id LIMIT 1";
$result = $conn->query($query);
if ($result) {
    if ($row = $result->fetch_assoc()) {
?>
                        <div class="sectioning">
                        <br>
                            <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>
                            <hr>
                            <table>
        <tr>
            <th>
                <b>Complete Name</b>
            </th>
        </tr>
        <tr>
            <th>
                <label>FIRST NAME<span class="req">*</span></label><br>
                <input type="text" name="first_name" required value="<?php echo $row["first_name"];?>">
            </th>
            <th>
                <label>MIDDLE NAME</label><br>
                <input type="text" name="middle_name" value="<?php echo $row["middle_name"];?>">
            </th>
            <th>
                <label>LAST NAME<span class="req">*</span></label><br>
                <input type="text" name="last_name" required  value="<?php echo $row["last_name"];?>">
            </th>
            <th>
                <label>SUFFIX</label><br>
                <input type="text" name="suffix"  value="<?php echo $row["suffix"];?>">
            </th>
        </tr>
        <tr>
            <th>
                <b>Complete Address</b>
            </th>
        </tr>
        <tr>
            <th>
                <label>ZONE<span class="req">*</span></label><br>
                <select id="purokSelect" name="zone">
                    <option value="Purok 1" <?php echo ($row["zone"] == "Purok 1") ? "selected" : ""; ?>>Purok 1</option>
                    <option value="Purok 2" <?php echo ($row["zone"] == "Purok 2") ? "selected" : ""; ?>>Purok 2</option>
                    <option value="Purok 3" <?php echo ($row["zone"] == "Purok 3") ? "selected" : ""; ?>>Purok 3</option>
                    <option value="Purok 4" <?php echo ($row["zone"] == "Purok 4") ? "selected" : ""; ?>>Purok 4</option>
                    <option value="Purok 5" <?php echo ($row["zone"] == "Purok 5") ? "selected" : ""; ?>>Purok 5</option>
                    <option value="Purok 6" <?php echo ($row["zone"] == "Purok 6") ? "selected" : ""; ?>>Purok 6</option>
                </select>
            </th>
            <th>
        <label for="barangay">BARANGAY <span class="req">*</span></label><br>
        <input 
            type="text" 
            id="barangay" 
            name="barangay" 
            value="<?php echo $row['barangay']; ?>"
        >
    </th>
    <th>
        <label for="city_municipality">CITY/MUNICIPALITY <span class="req">*</span></label><br>
        <input 
            type="text" 
            id="city_municipality" 
            name="city_municipality" 
            value="<?php echo $row['city_municipality']; ?>"
        >
    </th>
    <th>
        <label for="province">PROVINCE <span class="req">*</span></label><br>
        <input 
            type="text" 
            id="province" 
            name="province" 
            value="<?php echo $row['province']; ?>"
        >
    </th>
        </tr>
        <tr>
            <th>
                DATE OF VACCINATION<span class="req">*</span><br><input type="date" name="vaccination_date" value="<?php echo $row["vaccination_date"];?>">
            </th>
            <th>
                SITE<span class="req">*</span><br>
                <select name="vaccination_site" required>
                    <option value="Left"  <?php if($row["vaccination_site"]=="Left"){ echo "selected";}?>>Left</option>
                    <option value="Right" <?php if($row["vaccination_site"]=="Right"){ echo "selected";}?>>Right</option>
                </select>
            </th>
            <th>
                DATE OF BIRTH<span class="req">*</span><br><input type="date" name="date_of_birth" required value="<?php echo $row["date_of_birth"];?>">
            </th>
        </tr>
    </table>
                            <br>
                        <br>
                        <button type="submit" name="addAnti" value="<?php echo $id;?>">Save</button>
                        <br>
                        <br>
                        <br>
                        <hr>
                        </div>








      
                    </div>  
                    <style>
                        button[type="submit"]{
                            padding:10px 40px;
                            border:none;
                            box-shadow:0px 0px 3px gray;
                            color:white;
                            background-color:rgb(92,84,243);
                            border-radius:10px;
                            float:right;
                            margin:1%;
                        }
                        textarea{
                            border:none;
                            box-shadow:0px 0px 2px gray;
                            border-radius:10px;
                            width:100%;
                            height:180px;
                            padding:10px;
                            resize:none;
                        }
                      
                        .bod{
                            box-shadow:0px 0px 2px gray;
                        }
                        .bo1{
                            width:30%;
                        }
                        .onew{
                            width:30%;
                        }
                        .op{
                            width:31.2%;
                            margin:1%;
                           box-shadow:0px 0px 1px black;
                            padding:30px;
                            float:left;
                            border-radius:10px;
                        }
                        .as2{
                            width:24%;
                            margin:0.5%;
                           box-shadow:0px 0px 1px black;
                            padding:30px;
                            float:left;
                            border-radius:10px;
                        }
                        .opp{
                            width:90%;
                            margin:1%;
                           box-shadow:0px 0px 1px black;
                            padding:20px;
                            float:left;
                            border-radius:10px;
                        }
                        .www{
                            padding:20px;
                            background:white;
                            box-shadow:0px 0px 2px gray;
                            border-radius:10px;
                        }
                        table{
                            width:100%;
                        }
                        th{
                            padding:4px;
                        }
                        input,select{
                            width:90%;
                            border-radius:6px;
                            border:none;
                            background-color:white;
                            box-shadow:0px 0px 2px gray;
                            padding:7px;
                        }
                        .req{
                            color:red;
                        }
                        .row{
                          
                            position:relative;
                            scroll-behavior: smooth;
                        }
                        #navigate{
                            width:100%;
                             
                            box-shadow:0px 0px 2px gray;
                            margin:0.2%;
                            
                        }
                        .sda{
                            padding:1px;
                            display:block;
                            float:left;
                            margin:1%;
                        }
                        .sectioning{
                            width:100%;
                            height:auto;
                            
                            background-color:rgb(249,249,253);
                            padding:10px;
                        }
                        .saving{
                            width:100%;
                            position:fixed;
                            height:50px;
                          
                            bottom:0;
                            background:white;
                            z-index:1;
                            box-shadow:0px 0px 2px gray;
                        }
                        input[type="radio"]{
                            width:auto;
                        }
                       *{
                            scroll-behavior:smooth;
                        }
                        body{
                            overflow-x:hidden;
                        }
                        input[type="radio"]{
                            box-shadow:none;
                        }
                        </style>
        
                </section>
            </div>
        </div>
    </div>
    <script>
        // Get all input and select elements
        var inputs = document.querySelectorAll('input');
        var selects = document.querySelectorAll('select');

        // Set the readonly attribute for each input element
        inputs.forEach(function(input) {
            input.setAttribute('readonly', true);
        });

        // Set the readonly attribute for each select element
        selects.forEach(function(select) {
            select.setAttribute('disabled', true);
        });
        document.querySelectorAll("textarea").forEach(function(textarea) {
            textarea.disabled = true;
        });
        document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
                radio.disabled = true;
            });
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
    <!-- jquery vendor -->
    <script src="../js/lib/jquery.min.js"></script>
    <script src="../js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../js/lib/menubar/sidebar.js"></script>
    <script src="../js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="../js/lib/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
    <!-- bootstrap -->

    <script src="../js/lib/calendar-2/moment.latest.min.js"></script>
    <script src="../js/lib/calendar-2/pignose.calendar.min.js"></script>
    <script src="../js/lib/calendar-2/pignose.init.js"></script>


    <script src="../js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="../js/lib/weather/weather-init.js"></script>
    <script src="../js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="../js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="../js/lib/chartist/chartist.min.js"></script>
    <script src="../js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="../js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="../js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="../js/lib/owl-carousel/owl.carousel-init.js"></script>
    <!-- scripit init-->
    <script src="../js/dashboard2.js"></script>
</body>

</html>
 <?php
    }
}
 ?>