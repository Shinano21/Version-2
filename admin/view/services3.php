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
    <title>Update Family Planning Record | CareVisio</title>
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
                            <a href="../services3.php"><h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i>
                            Back to Family Planning Services Records</h7></a>
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
                        <div id="navigate" >

                        <a href="#a1" class="sda">Personal Information</a>
                        <a href="#a2" class="sda"> Follow up Visits</a>
                        <a href="#a3" class="sda">Others</a>
                        <a href="#a4" class="sda">Remarks</a>
                        </div>
                     
                        <?php

$id=$_GET["update"];
$query = "SELECT * FROM `family_planning` WHERE `id` = $id LIMIT 1";
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
            <label>DATE OF REGISTRATION<span class="req">*</span></label><br>
            <input type="date" name="date_of_registration" required value="<?php echo  $row["date_of_registration"]; ?>">
        </th>
        <th>
            <label>DATE OF BIRTH<span class="req">*</span></label><br>
            <input type="date" name="date_of_birth" required value="<?php echo  $row["date_of_birth"]; ?>">
        </th>
        <th>
            <label>FAMILY SERIAL NUMBER</label><br>
            <input type="text" name="family_serial_number" value="<?php echo  $row["family_serial_number"]; ?>">
        </th>
        <th>
            <label>SE STATUS<span class="req">*</span></label><br>
            <select name="se_status" required>
                <option value="NHTS" <?php if($row["se_status"]=="NHTS"){ echo "selected";}?>>NHTS</option>
                <option value="Non-NHTS" <?php if($row["se_status"]=="Non-NHTS"){ echo "selected";}?>>Non-NHTS</option>
            </select>
        </th>
    </tr>
    <tr>
        <th>
            <label>TYPE OF CLIENT<span class="req">*</span></label><br>
            <select name="type_of_client" required>
                <option value="NA" <?php if($row["type_of_client"]=="NA"){ echo "selected";}?>>New Acceptors</option>
                <option value="CU" <?php if($row["type_of_client"]=="CU"){ echo "selected";}?>>Current Users</option>
                <option value="OA" <?php if($row["type_of_client"]=="OA"){ echo "selected";}?>>Other Acceptors</option>
                <option value="CU-CM" <?php if($row["type_of_client"]=="CU-CM"){ echo "selected";}?>>Changing Method</option>
                <option value="CU-CC" <?php if($row["type_of_client"]=="CU-CC"){ echo "selected";}?>>Changing Clinic</option>
                <option value="CU-RS" <?php if($row["type_of_client"]=="CU-RS"){ echo "selected";}?>>Restarter</option>
            </select>
        </th>
        <th>
            <label>SOURCE<span class="req">*</span></label><br>
            <select name="source" required>
                <option value="Public"  <?php if($row["source"]=="Publice"){ echo "selected";}?> >Public</option>
                <option value="Private"  <?php if($row["source"]=="Private"){ echo "selected";}?>>Private</option>
            </select>
        </th>
        <th>
            <label>PREVIOUS METHOD<span class="req">*</span></label><br>
            <select name="previous_method" required>
                <option value="" disabled selected hidden>Select</option>
                                        <option value="FSTR/BTL" <?php if($row["previous_method"]=="FSTR/BTL"){ echo "selected";}?>>Female Sterialization/Bilateral tubal ligation</option>
                                        <option value="MSTR/NSV" <?php if($row["previous_method"]=="MSTR/NSV"){ echo "selected";}?>>Male Sterialization/No-Scalpel Vasectonomy</option>
                                        <option value="CON" <?php if($row["previous_method"]=="CON"){ echo "selected";}?>>Condom</option>
                                        <option value="Pills-POP" <?php if($row["previous_method"]=="Pills-POP"){ echo "selected";}?>>Progestin Only Pills</option>
                                        <option value="Pills-COC" <?php if($row["previous_method"]=="Pills-COC"){ echo "selected";}?>>Combined Oral Contraceptives</option>
                                        <option value="INJ" <?php if($row["previous_method"]=="INJ"){ echo "selected";}?>>DMPA or CIC</option>
                                        <option value="IMP" <?php if($row["previous_method"]=="IMP"){ echo "selected";}?>>Single rod sub-thermal Implant</option>
                                        <option value="IUD-I" <?php if($row["previous_method"]=="IUD-I"){ echo "selected";}?>>IUD Interval</option>
                                        <option value="IUD-PP" <?php if($row["previous_method"]=="IUD-PP"){ echo "selected";}?>>IUD Pospartum</option>
                                        <option value="NFP-LAM" <?php if($row["previous_method"]=="NFP-LAM"){ echo "selected";}?>>Lactational Amenorrhea Method</option>
                                        <option  value="NFP-BBT" <?php if($row["previous_method"]=="NFP-BBT"){ echo "selected";}?>>Basal Body Temperature</option>
                                        <option  value="NFP-CMM" <?php if($row["previous_method"]=="NFP-CMM"){ echo "selected";}?>>Cervival Mucos Method</option>
                                        <option  value="NFP-STM" <?php if($row["previous_method"]=="NFP-STM"){ echo "selected";}?>>Symptothermal Method</option>
                                        <option value="NFP-SDM" <?php if($row["previous_method"]=="NFP-SDM"){ echo "selected";}?>>Standard Days Method</option>
                                        <option value="NONE" <?php if($row["previous_method"]=="NONE"){ echo "selected";}?>>None or New Acceptor</option>
            </select>
        </th>
    </tr>
    <tr>
        <th>
            <label>FIRST NAME<span class="req">*</span></label><br>
            <input type="text" name="first_name" required value="<?php echo  $row["first_name"]; ?>">
        </th>
        <th>
            <label>MIDDLE NAME</label><br>
            <input type="text" name="middle_name" value="<?php echo  $row["middle_name"]; ?>">
        </th>
        <th>
            <label>LAST NAME<span class="req">*</span></label><br>
            <input type="text" name="last_name" required value="<?php echo  $row["last_name"]; ?>">
        </th>
        <th>
            <label>SUFFIX</label><br>
            <input type="text" name="suffix" value="<?php echo  $row["suffix"]; ?>">
        </th>
    </tr>
    <tr>
        <th>
            <label>ZONE<span class="req">*</span></label><br>
              <select id="purokSelect" name="zone">
            <option value="Purok 1" <?php echo ($row["zone"] == "Purok 1") ? "selected" : ""; ?>>Purok 1</option>
<option value="Purok 2" <?php echo ($row["zone"] == "Purok 2") ? "selected" : ""; ?>>Purok 2</option>
<option value="Purok 3" <?php echo ($row["zone"] == "Purok 3") ? "selected" : ""; ?>>Purok 3</option>
<option value="Purok 3A" <?php echo ($row["zone"] == "Purok 3A") ? "selected" : ""; ?>>Purok 3A</option>
<option value="Purok 3B" <?php echo ($row["zone"] == "Purok 3B") ? "selected" : ""; ?>>Purok 3B</option>
<option value="Purok 4A" <?php echo ($row["zone"] == "Purok 4A") ? "selected" : ""; ?>>Purok 4A</option>

            </select>
        </th>
        <th>
    <label>BARANGAY<span class="req">*</span></label><br>
    <input type="text" name="barangay" required value="<?php echo $row['barangay']; ?>">
</th>
<th>
    <label>CITY/MUNICIPALITY<span class="req">*</span></label><br>
    <input type="text" name="city_municipality" required value="<?php echo $row['city_municipality']; ?>">
</th>
<th>
    <label>PROVINCE<span class="req">*</span></label><br>
    <input type="text" name="province" required value="<?php echo $row['province']; ?>">
</th>

    </tr>
</table>


                        </div>




<?php
$query = "SELECT * FROM `family_planning_sched` WHERE `family_id` = $id LIMIT 1";
$result = $conn->query($query);
if ($result) {
    if ($row = $result->fetch_assoc()) {
?>

                        <div class="sectioning"  id="a2">
                        
                            <hr>
                         <h2>Follow up Visits</h2>
                         <div id="dasfol">
    <?php
    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    for ($i = 0; $i < count($months); $i++) {
        $a1 = "schedule_date_" . strtolower($months[$i]);
        $a2 = "schedule_date_" . strtolower($months[$i]);
        echo '<div class="month">';
        echo '<center><p><b>' . $months[$i] . '</b></p></center>';
        echo '<p>SCHEDULE DATE OF NEXT VISIT </p>';
        echo '<input type="date" class="datefu" name="schedule_date_' . strtolower($months[$i]) . '" value="'. $row[$a1].'">';
        echo '<br>       <br>';
        echo '<p>ACTUAL DATE OF NEXT VISIT </p>';
        echo '<input type="date" class="datefu" name="actual_date_' . strtolower($months[$i]) . '" value="'. $row[$a2].'">';
        echo '</div>';
    }
    ?>
</div>

             
</div>
<?php
    }
}
?>
<?php
$query = "SELECT * FROM `family_plan_rem` WHERE `family_id` = $id LIMIT 1";
$result = $conn->query($query);
if ($result) {
    if ($row = $result->fetch_assoc()) {
?>

                        <div class="sectioning"  id="a3">
                       <b>&nbsp;Drop Out</b>
                    
                       <table>
    <tr>
        <th colspan="2">
            REASONS
            <br>
            <select name="reason1" >
                <option value="" disabled selected hidden>Select</option>
                <option value="A" <?php if($row["reasons"]=="A"){ echo "selected";}?>>Pregnant</option>
                <option value="B" <?php if($row["reasons"]=="B"){ echo "selected";}?>>Desire to become pregnant</option>
                <option value="C" <?php if($row["reasons"]=="C"){ echo "selected";}?>>Medical complications</option>
                <option value="D" <?php if($row["reasons"]=="D"){ echo "selected";}?>>Fear of side effects</option>
                <option value="E" <?php if($row["reasons"]=="E"){ echo "selected";}?>>Changed Clinic</option>
                <option value="F" <?php if($row["reasons"]=="F"){ echo "selected";}?>>Husband disapproves</option>
                <option value="G" <?php if($row["reasons"]=="G"){ echo "selected";}?>>Menopause</option>
                <option value="H" <?php if($row["reasons"]=="H"){ echo "selected";}?>>Lost or moved out of the area or residence</option>
                <option value="I" <?php if($row["reasons"]=="I"){ echo "selected";}?>>Failed to get supply</option>
                <option value="J" <?php if($row["reasons"]=="J"){ echo "selected";}?>>Change method</option>
                <option value="K" <?php if($row["reasons"]=="K"){ echo "selected";}?>>Underwent Hysterectomy</option>
                <option value="L" <?php if($row["reasons"]=="L"){ echo "selected";}?>>Underwent Bilateral Salphingo-oophorectomy</option>
                <option value="M" <?php if($row["reasons"]=="M"){ echo "selected";}?>>No FP Commodity</option>
                <option value="N" <?php if($row["reasons"]=="N"){ echo "selected";}?>>Unknown</option>
                <option value="O" <?php if($row["reasons"]=="O"){ echo "selected";}?>>Age out for BTL</option>
                <option value="LAM: A" <?php if($row["reasons"]=="LAM: A"){ echo "selected";}?>>Mother has a menstruation or not amenorrheic within 6 months (FOR LAM)</option>
                <option value="LAM: B" <?php if($row["reasons"]=="LAM: B"){ echo "selected";}?>>No longer practicing fully/exclusively breastfeeding (FOR LAM)</option>
                <option value="LAM: C" <?php if($row["reasons"]=="LAM: C"){ echo "selected";}?>>Baby is more than six (6) months old (FOR LAM)</option>
            </select>
        </th>
        <th>
            DATE<br>
            <input type="date" name="reason_date" value="<?php echo  $row["reasons_date"]; ?>">
        </th>
    </tr>
    <tr>
        <th><b>Deworming Drugs Given to 20-49 years old WRA</b></th>
    </tr>
    <tr>
        <th>
            1ST DOSE (DATE GIVEN)   <br>
            <input type="date" name="deworming_1st_dose_date" value="<?php echo  $row["deworming_drugs_1st_dose_date"]; ?>">
        </th>
        <th>
            2ND DOSE (DATE GIVEN)   <br>
            <input type="date" name="deworming_2nd_dose_date" value="<?php echo  $row["deworming_drugs_2nd_dose_date"]; ?>">
        </th>
        <th>
            Given two (2) doses of deworming drug  <br> 
            <br>
            <input type="radio" value="Yes" name="deworming_yndwrm" <?php if($row["deworming_drugs_yndwrm"]=="Yes"){ echo "checked";}?>> &nbsp;Yes&nbsp;&nbsp;
            <input type="radio" value="No" name="deworming_yndwrm" <?php if($row["deworming_drugs_yndwrm"]=="No"){ echo "checked";}?>> &nbsp;No
        </th>
    </tr>
</table>
</div>
<!-- IF LAM -->
<div class="sectioning" id="a4">
    <h2>Remarks</h2>
    <textarea name="lam_remarks"><?php echo  $row["lam_remarks"]; ?></textarea>


                        <br>
                        <br>
                        <button type="submit" name="add_family" value="<?php echo $id;?>">Save</button>
                        <br>
                        <br>
                        <br>
                        <hr>
                        <br><br>

                        </div>


<?php
    }

}
?>


                        <div class="saving">  
                        <a href="#a1" class="sda">Personal Information</a>
                        <a href="#a2" class="sda"> Follow up Visits</a>
                        <a href="#a3" class="sda">Others</a>
                        <a href="#a4" class="sda">Remarks</a>
                        </div></div>
                    </div>  
               
                    <style>
                        .month{
                            width:32%;
                            padding:15px;
                            margin:0.5%;
                            box-shadow:0px 0px 3px gray;
                            border-radius:10px;
                            float:left;
                        }
                        #dasfol{
                            width:100%;
                            padding:10px;
                            height:auto;
                            overflow:auto;
                        }
                        button[type="submit"]{
                            padding:10px 40px;
                            border:none;
                            box-shadow:0px 0px 3px gray;
                            color:white;
                            background-color:rgb(92,84,243);
                            border-radius:10px;
                            float:right;
                            margin:0.5%;
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
                        .datefu{
                            width:100%;
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
 <?php
    }
}
?>