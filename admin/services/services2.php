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
    <title>Add Nutrition and Deworming Record | TechCare</title>
    <?php include "head.php"?>
</head>

<body onload="display_ct();">

    <?php include "sidebar.php"?>
    <?php include "header.php"?>
    
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <a href="../services2.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i>
                                        Back to Nutrition and Deworming Services Records</h7>
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
                                <a href="#a2" class="sda"> 12-23 months old</a>
                                <a href="#a3" class="sda">24-35 months old</a>
                                <a href="#a4" class="sda">36-47 months old</a>
                                <a href="#a5" class="sda">48-59 months old</a>
                                <a href="#a6" class="sda">12-59 months old</a>
                                <a href="#a7" class="sda">Remarks</a>
                            </div>


                            <div class="sectioning">
                                <br>
                                <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>
                                <hr>
                                <table>
                                    <tr>
                                        <th>
                                            <label>DATE OF REGISTRATION<span class="req"> *</span></label><br>
                                            <input type="date" name="date_of_registration" required>
                                        </th>
                                        <th>
                                            <label>DATE OF BIRTH<span class="req"> *</span></label><br>
                                            <input type="date" name="date_of_birth" required>
                                        </th>
                                        <th>
                                            <label>SERIAL NUMBER</label><br>
                                            <input type="text" name="serial_number">
                                        </th>
                                        <th>
                                            <label>SE STATUS<span class="req"> *</span></label><br>
                                            <select name="se_status" required>
                                                <option value="NHTS">NHTS</option>
                                                <option value="Non-NHTS">Non-NHTS</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>Sex<span class="req"> *</span></label><br>
                                            <select name="sex" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>LENGTH(CM)<span class="req"> *</span></label><br>
                                            <input type="number" name="length_cm" required>
                                        </th>
                                        <th>
                                            <label>WEIGHT(KG)<span class="req"> *</span></label><br>
                                            <input type="number" name="weight_kg" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>FIRST NAME<span class="req"> *</span></label><br>
                                            <input type="text" name="first_name" required>
                                        </th>
                                        <th>
                                            <label>MIDDLE NAME</label><br>
                                            <input type="text" name="middle_name">
                                        </th>
                                        <th>
                                            <label>LAST NAME<span class="req"> *</span></label><br>
                                            <input type="text" name="last_name" required>
                                        </th>
                                        <th>
                                            <label>SUFFIX</label><br>
                                            <input type="text" name="suffix">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <b>Complete Name of Mother</b>
                                            <br>
                                            <label>FIRST NAME<span class="req">*</span></label><br>
                                            <input type="text" name="mother_fname" required>
                                        </th>
                                        <th>
                                            <br>
                                            <label>MIDDLE NAME</label><br>
                                            <input type="text" name="mother_mname">
                                        </th>
                                        <th>
                                            <br>
                                            <label>LAST NAME<span class="req">*</span></label><br>
                                            <input type="text" name="mother_lname" required>
                                        </th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>ZONE<span class="req"> *</span></label><br>
                                            <select id="purokSelect" name="zone">
                                                <option value="Purok 1">Purok 1</option>
                                                <option value="Purok 2">Purok 2</option>
                                                <option value="Purok 3">Purok 3</option>
                                                <option value="Purok 4">Purok 4</option>
                                                <option value="Purok 5">Purok 5</option>
                                                <option value="Purok 6">Purok 6</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>BARANGAY<span class="req"> *</span></label><br>
                                            <input type="text" name="barangay" required value="Bagumbayan">
                                        </th>
                                        <th>
                                            <label>CITY/MUNICIPALITY<span class="req"> *</span></label><br>
                                            <input type="text" name="city_municipality" required value="Daraga">
                                        </th>
                                        <th>
                                            <label>PROVINCE<span class="req"> *</span></label><br>
                                            <input type="text" name="province" required value="Albay">
                                        </th>
                                    </tr>
                                </table>

                            </div>

                            <div class="sectioning" id="a2">
                                <hr>
                                <h2>12-23 months old</h2>
                                <table>
                                    <tr>
                                        <th><b>Nutritional Status</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" value="N" name="nutritional_status"
                                                    >&nbsp;&nbsp;<b>N:</b> Normal</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="S"
                                                    name="nutritional_status">&nbsp;&nbsp;<b>S:</b> Stunted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="W-MAM"
                                                    name="nutritional_status">&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="W-SAM"
                                                    name="nutritional_status">&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="O"
                                                    name="nutritional_status">&nbsp;&nbsp;<b>O:</b> Obese/overweight
                                            </div>
                                        </th>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <th><b>Nutrition Services</b></th>
                                    </tr>
                                    <tr>
                                        <th>Micronutrient Supplement</th>
                                    </tr>
                                    <tr>
                                        <th><b>MNP</b></th>
                                        <th><b>Vitamin A</b></th>
                                    </tr>
                                    <tr>
                                        <th>DATE WHEN 180 SACHETS GIVEN<br><input type="date" name="mnp_date"></th>
                                        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_1st_dose_date">
                                        </th>
                                        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_2nd_dose_date">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>Deworming Services</b></th>
                                    </tr>
                                    <tr>
                                        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="deworming_1st_dose_date">
                                        </th>
                                        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="deworming_2nd_dose_date">
                                        </th>
                                        <th>Child given 2 doses of deworming drug<br>
                                            <input type="radio" value="Yes" name="deworming_yn"
                                                >&nbsp;Yes&nbsp;&nbsp;&nbsp;
                                            <input type="radio" value="No" name="deworming_yn">&nbsp;No
                                        </th>
                                    </tr>
                                </table>

                            </div>
                            <div class="sectioning" id="a3">
                                <hr>
                                <h2>24-35 months old</h2>
                                <table>
                                    <tr>
                                        <th><b>Nutritional Status</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" name="nutritional_status2" value="N"
                                                    > &nbsp;&nbsp;<b>N:</b> Normal</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="nutritional_status2"
                                                    value="S">&nbsp;&nbsp;<b>S:</b> Stunted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="nutritional_status2"
                                                    value="W-MAM">&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="nutritional_status2"
                                                    value="W-SAM">&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="nutritional_status2"
                                                    value="O">&nbsp;&nbsp;<b>O:</b> Obese/overweight</div>
                                        </th>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <th><b>Nutrition Services</b></th>
                                    </tr>
                                    <tr>
                                        <th>Micronutrient Supplement</th>
                                    </tr>
                                    <tr>
                                        <th><b>Vitamin A</b></th>
                                    </tr>
                                    <tr>
                                        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_1st_dose_date2">
                                        </th>
                                        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_2nd_dose_date2">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>Deworming Services</b></th>
                                    </tr>
                                    <tr>
                                        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="deworming_1st_dose_date2">
                                        </th>
                                        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="deworming_2nd_dose_date2">
                                        </th>
                                        <th>Child given 2 doses of deworming drug<br>
                                            <input type="radio" value="Yes" name="deworming_yn2"
                                                >&nbsp;Yes&nbsp;&nbsp;&nbsp;
                                            <input type="radio" value="No" name="deworming_yn2">&nbsp;No
                                        </th>
                                    </tr>
                                </table>

                            </div>


                            <div class="sectioning" id="a4">
                                <hr>
                                <h2>36-47 months old</h2>
                                <table>
                                    <tr>
                                        <th><b>Nutritional Status</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" value="N"
                                                    name="nutritional_status3">&nbsp;&nbsp;<b>N:</b> Normal</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="S"
                                                    name="nutritional_status3">&nbsp;&nbsp;<b>S:</b> Stunted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="W-MAM"
                                                    name="nutritional_status3">&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM
                                            </div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="W-SAM"
                                                    name="nutritional_status3">&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM
                                            </div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="O"
                                                    name="nutritional_status3">&nbsp;&nbsp;<b>O:</b> Obese/overweight
                                            </div>
                                        </th>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <th><b>Nutrition Services</b></th>
                                    </tr>
                                    <tr>
                                        <th>Micronutrient Supplement</th>
                                    </tr>
                                    <tr>
                                        <th><b>Vitamin A</b></th>
                                    </tr>
                                    <tr>
                                        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_1st_dose_date3">
                                        </th>
                                        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_2nd_dose_date3">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>Deworming Services</b></th>
                                    </tr>
                                    <tr>
                                        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="deworming_1st_dose_date3">
                                        </th>
                                        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="deworming_2nd_dose_date3">
                                        </th>
                                        <th>Child given 2 doses of deworming drug<br>
                                            <input type="radio" value="Yes" name="deworming_yn3"
                                                >&nbsp;Yes&nbsp;&nbsp;&nbsp;
                                            <input type="radio" value="No" name="deworming_yn3">&nbsp;No
                                        </th>
                                    </tr>
                                </table>


                            </div>

                            <div class="sectioning" id="a5">
                                <hr>
                                <h2>48-59 months old</h2>
                                <table>
                                    <tr>
                                        <th><b>Nutritional Status</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" value="N" name="nutritional_status4"
                                                    >&nbsp;&nbsp;<b>N:</b> Normal</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="S"
                                                    name="nutritional_status4">&nbsp;&nbsp;<b>S:</b> Stunted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="W-MAM"
                                                    name="nutritional_status4">&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM
                                            </div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="W-SAM"
                                                    name="nutritional_status4">&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM
                                            </div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="O"
                                                    name="nutritional_status4">&nbsp;&nbsp;<b>O:</b> Obese/overweight
                                            </div>
                                        </th>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <th><b>Nutrition Services</b></th>
                                    </tr>
                                    <tr>
                                        <th>Micronutrient Supplement</th>
                                    </tr>
                                    <tr>
                                        <th><b>Vitamin A</b></th>
                                    </tr>
                                    <tr>
                                        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_1st_dose_date4">
                                        </th>
                                        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_2nd_dose_date4">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>Deworming Services</b></th>
                                    </tr>
                                    <tr>
                                        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="deworming_1st_dose_date4">
                                        </th>
                                        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="deworming_2nd_dose_date4">
                                        </th>
                                        <th>Child given 2 doses of deworming drug<br>
                                            <input type="radio" value="Yes" name="deworming_yn4"
                                                >&nbsp;Yes&nbsp;&nbsp;&nbsp;
                                            <input type="radio" value="No" name="deworming_yn4">&nbsp;No
                                        </th>
                                    </tr>
                                </table>

                            </div>
                            <div class="sectioning" id="a6">
                                <hr>
                                <h2>12-50 months old</h2>
                                <table id="tas">


                                    <tr>
                                        <th><b>MAM<b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" name="mam5"
                                                    value="Admitted in SFP">&nbsp;&nbsp;Admitted in SFP</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="mam5"
                                                    value="Cured">&nbsp;&nbsp;Cured</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="mam5"
                                                    value="Defaulted">&nbsp;&nbsp;Defaulted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="mam5"
                                                    value="Died">&nbsp;&nbsp;Died</div>
                                        </th>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <th><b>SAM Without complication<b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" name="sam5"
                                                    value="Admitted in SFP">&nbsp;&nbsp;Admitted in SFP</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sam5"
                                                    value="Cured">&nbsp;&nbsp;Cured</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sam5"
                                                    value="Defaulted">&nbsp;&nbsp;Defaulted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sam5"
                                                    value="Died">&nbsp;&nbsp;Died</div>
                                        </th>
                                    </tr>
                                </table>
                                <br>
                            </div>
                            <div class="sectioning" id="a7">

                                <h2>Remarks</h2>
                                <textarea name="remarks5"></textarea>
                                <br>
                                <br>
                                <button type="submit" name="add_nutrition">Save</button>
                                <br>
                                <br>
                                <br>
                                <hr>
                                <br><br>

                            </div>





                            <div class="saving">
                                <a href="#a1" class="sda">Personal Information</a>
                                <a href="#a2" class="sda"> 12-23 months old</a>
                                <a href="#a3" class="sda">24-35 months old</a>
                                <a href="#a4" class="sda">36-47 months old</a>
                                <a href="#a5" class="sda">48-59 months old</a>
                                <a href="#a6" class="sda">12-59 months old</a>
                                <a href="#a7" class="sda">Remarks</a>
                            </div>
                        </div>
            </div>

            <style>
                 body{
               background-color: #CDE8E5;
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
            </style>
            </form>
            </section>
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