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
    <title>Add Family Planning Record | CareVisio</title>
    <?php include "head.php"; ?>
</head>

<body onload="display_ct();">

    <?php include "header.php"?>
    <?php include "sidebar.php"?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <a href="../services3.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i>
                                        Back to Family Planning Services Records</h7>
                                </a>
                                <h1>New Record</h1>


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
                            <div id="navigate">

                                <a href="#a1" class="sda">Personal Information</a>
                                <a href="#a2" class="sda"> Follow up Visits</a>
                                <a href="#a3" class="sda">Others</a>
                                <a href="#a4" class="sda">Remarks</a>
                            </div>


                            <div class="sectioning">
                                <br>
                                <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>
                                <hr>
                                <table>
                                    <tr>
                                        <th>
                                            <label>DATE OF REGISTRATION<span class="req">*</span></label><br>
                                            <input type="date" name="date_of_registration" required>
                                        </th>
                                        <th>
                                            <label>DATE OF BIRTH<span class="req">*</span></label><br>
                                            <input type="date" name="date_of_birth" required>
                                        </th>
                                        <th>
                                            <label>FAMILY SERIAL NUMBER</label><br>
                                            <input type="text" name="family_serial_number">
                                        </th>
                                        <th>
                                            <label>SE STATUS<span class="req">*</span></label><br>
                                            <select name="se_status" required>
                                                <option>NHTS</option>
                                                <option>Non-NHTS</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>TYPE OF CLIENT<span class="req">*</span></label><br>
                                            <select name="type_of_client" required>
                                                <option value="NA">New Acceptors</option>
                                                <option value="CU">Current Users</option>
                                                <option value="OA">Other Acceptors</option>
                                                <option value="CU-CM">Changing Method</option>
                                                <option value="CU-CC">Changing Clinic</option>
                                                <option value="CU-RS">Restarter</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>SOURCE<span class="req">*</span></label><br>
                                            <select name="source" required>
                                                <option value="Public">Public</option>
                                                <option value="Private" selected>Private</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>PREVIOUS METHOD<span class="req">*</span></label><br>
                                            <select name="previous_method" required>
                                                <option value="" disabled selected hidden>Select</option>
                                                <option value="FSTR/BTL">Female Sterialization/Bilateral tubal ligation
                                                </option>
                                                <option value="MSTR/NSV">Male Sterialization/No-Scalpel Vasectonomy
                                                </option>
                                                <option value="CON">Condom</option>
                                                <option value="Pills-POP">Progestin Only Pills</option>
                                                <option value="Pills-COC">Combined Oral Contraceptives</option>
                                                <option value="INJ">DMPA or CIC</option>
                                                <option value="IMP">Single rod sub-thermal Implant</option>
                                                <option value="IUD-I">IUD Interval</option>
                                                <option value="IUD-PP">IUD Pospartum</option>
                                                <option value="NFP-LAM">Lactational Amenorrhea Method</option>
                                                <option value="NFP-BBT">Basal Body Temperature</option>
                                                <option value="NFP-STM">Cervival Mucos Method</option>
                                                <option value="NFP-STM">Symptothermal Method</option>
                                                <option value="NFP-SDM">Standard Days Method</option>
                                                <option value="NONE">None or New Acceptor</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>FIRST NAME<span class="req">*</span></label><br>
                                            <input type="text" name="first_name" required>
                                        </th>
                                        <th>
                                            <label>MIDDLE NAME</label><br>
                                            <input type="text" name="middle_name">
                                        </th>
                                        <th>
                                            <label>LAST NAME<span class="req">*</span></label><br>
                                            <input type="text" name="last_name" required>
                                        </th>
                                        <th>
                                            <label>SUFFIX</label><br>
                                            <input type="text" name="suffix">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>ZONE<span class="req">*</span></label><br>
                                            <select id="purokSelect" name="zone" required>
                                                <option value="Purok 1">Purok 1</option>
                                                <option value="Purok 2">Purok 2</option>
                                                <option value="Purok 3">Purok 3</option>
                                                <option value="Purok 4">Purok 4</option>
                                                <option value="Purok 5">Purok 5</option>
                                                <option value="Purok 6">Purok 6</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>BARANGAY<span class="req">*</span></label><br>
                                            <input type="text" name="barangay" required value="Bagumbayan">
                                        </th>
                                        <th>
                                            <label>CITY/MUNICIPALITY<span class="req">*</span></label><br>
                                            <input type="text" name="city_municipality" required value="Daraga">
                                        </th>
                                        <th>
                                            <label>PROVINCE<span class="req">*</span></label><br>
                                            <input type="text" name="province" required value="Albay">
                                        </th>
                                    </tr>
                                </table>


                            </div>






                            <div class="sectioning" id="a2">
                                
                                <hr>
                                <h2>Follow up Visits</h2>
                                <div id="dasfol">
                                    <?php
    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    for ($i = 0; $i < count($months); $i++) {
        echo '<div class="month">';
        echo '<center><p><b>' . $months[$i] . '</b></p></center>';
        echo '<p>SCHEDULE DATE OF NEXT VISIT </p>';
        echo '<input type="date" class="datefu" name="schedule_date_' . strtolower($months[$i]) . '">';
        echo '<br>       <br>';
        echo '<p>ACTUAL DATE OF NEXT VISIT </p>';
        echo '<input type="date" class="datefu" name="actual_date_' . strtolower($months[$i]) . '">';
        echo '</div>';
    }
    ?>
                                </div>


                            </div>


                            <div class="sectioning" id="a3">
                                <b>&nbsp;Drop Out</b>

                                <table>
                                    <tr>
                                        <th colspan="2">
                                            REASONS
                                            <br>
                                            <select name="reason1">
                                                <option value="" disabled selected hidden>Select</option>
                                                <option value="A">Pregnant</option>
                                                <option value="B">Desire to become pregnant
                                                </option>
                                                <option value="C">Medical complications</option>
                                                <option value="D">Fear of side effects</option>
                                                <option value="E">Changed Clinic</option>
                                                <option value="F">Husband disapproves</option>
                                                <option value="G">Menopause</option>
                                                <option value="H">Lost or moved
                                                    out of the area or residence</option>
                                                <option value="I">Failed to get supply</option>
                                                <option value="J">Change method</option>
                                                <option value="K">Underwent Hysterectomy</option>
                                                <option value="L">Underwent
                                                    Bilateral Salphingo-oophorectomy</option>
                                                <option value="M">No FP Commodity</option>
                                                <option value="N">Unknown</option>
                                                <option value="O">Age out for BTL</option>
                                                <option
                                                    value="LAM: A">
                                                    Mother has a menstruation or not amenorrheic within 6 months (FOR LAM)
                                                </option>
                                                <option value="LAM: B">No
                                                    longer practicing fully/exclusively breastfeeding (FOR LAM)</option>
                                                <option value="LAM: C">Baby is more than
                                                    six (6) months old (FOR LAM)</option>
                                            </select>
                                        </th>
                                        <th>
                                            DATE<br>
                                            <input type="date" name="reason_date">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>Deworming Drugs Given to 20-49 years old WRA</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            1ST DOSE (DATE GIVEN) <br>
                                            <input type="date" name="deworming_1st_dose_date">
                                        </th>
                                        <th>
                                            2ND DOSE (DATE GIVEN) <br>
                                            <input type="date" name="deworming_2nd_dose_date">
                                        </th>
                                        <th>
                                            Given two (2) doses of deworming drug <br>
                                            <br>
                                            <input type="radio" value="Yes" name="deworming_yndwrm">
                                            &nbsp;Yes&nbsp;&nbsp;
                                            <input type="radio" value="No" name="deworming_yndwrm"> &nbsp;No
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            <!-- IF LAM -->
                            <div class="sectioning" id="a4">
                                <h2>Remarks</h2>
                                <textarea name="lam_remarks"></textarea>


                                <br>
                                <br>
                                <button type="submit" name="add_family">Save</button>
                                <br>
                                <br>
                                <br>
                                <hr>
                                <br><br>

                            </div>





                            <div class="saving">
                                <a href="#a1" class="sda">Personal Information</a>
                                <a href="#a2" class="sda"> Follow up Visits</a>
                                <a href="#a3" class="sda">Others</a>
                                <a href="#a4" class="sda">Remarks</a>
                            </div>
                        </div>
            </div>

            <style>
            .month {
                width: 32%;
                padding: 15px;
                margin: 0.5%;
                box-shadow: 0px 0px 3px gray;
                border-radius: 10px;
                float: left;
            }

            #dasfol {
                width: 100%;
                padding: 10px;
                height: auto;
                overflow: auto;
            }

            button[type="submit"] {
                padding: 10px 40px;
                border: none;
                box-shadow: 0px 0px 3px gray;
                color: white;
                background-color: rgb(92, 84, 243);
                border-radius: 10px;
                float: right;
                margin: 0.5%;
            }

            textarea {
                border: none;
                box-shadow: 0px 0px 2px gray;
                border-radius: 10px;
                width: 100%;
                height: 180px;
                padding: 10px;
                resize: none;
            }

            .bod {
                box-shadow: 0px 0px 2px gray;
            }

            .bo1 {
                width: 30%;
            }

            .onew {
                width: 30%;
            }

            .op {
                width: 31.2%;
                margin: 1%;
                box-shadow: 0px 0px 1px black;
                padding: 30px;
                float: left;
                border-radius: 10px;
            }

            .as2 {
                width: 24%;
                margin: 0.5%;
                box-shadow: 0px 0px 1px black;
                padding: 30px;
                float: left;
                border-radius: 10px;
            }

            .opp {
                width: 90%;
                margin: 1%;
                box-shadow: 0px 0px 1px black;
                padding: 20px;
                float: left;
                border-radius: 10px;
            }

            .www {
                padding: 20px;
                background: white;
                box-shadow: 0px 0px 2px gray;
                border-radius: 10px;
            }

            table {
                width: 100%;
            }

            th {
                padding: 4px;
            }

            input,
            select {
                width: 90%;
                border-radius: 6px;
                border: none;
                background-color: white;
                box-shadow: 0px 0px 2px gray;
                padding: 7px;
            }

            .req {
                color: red;
            }

            .row {

                position: relative;
                scroll-behavior: smooth;
            }

            #navigate {
                width: 100%;

                box-shadow: 0px 0px 2px gray;
                margin: 0.2%;

            }

            .sda {
                padding: 1px;
                display: block;
                float: left;
                margin: 1%;
            }

            .sectioning {
                width: 100%;
                height: auto;

                background-color: rgb(249, 249, 253);
                padding: 10px;
            }

            .saving {
                width: 100%;
                position: fixed;
                height: 50px;

                bottom: 0;
                background: white;
                z-index: 1;
                box-shadow: 0px 0px 2px gray;
            }

            input[type="radio"] {
                width: auto;
            }

            * {
                scroll-behavior: smooth;
            }

            body {
                overflow-x: hidden;
            }

            input[type="radio"] {
                box-shadow: none;
            }

            .datefu {
                width: 100%;
            }
            </style>
            </form>
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