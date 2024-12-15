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
    <title>View Immunization and Nutrition Record | CareVisio</title>
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
                            <a href="../services1.php"><h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i>
                            Back to Immunization and Nutrition Services Records</h7></a>
                                <h1>View Record</h1>

                         
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
                    <form method="post" action="add.php">
                    <div class="row" position="relative;" id="a1">
                        <div id="navigate" >

                        <a href="#a1" class="sda">Personal Information</a>
                        <a href="#a2" class="sda"> 0-28 days old</a>
                        <a href="#a3" class="sda">1-3 months old</a>
                        <a href="#a4" class="sda">6-11 months old</a>
                        <a href="#a5" class="sda">12 months old</a>
                        <a href="#a6" class="sda">0-11 months old</a>
                        <a href="#a7" class="sda">Remarks</a>
                        </div>
                     
<?php

$id=$_GET["view"];
$query = "SELECT * FROM `immunization` WHERE `id` = $id LIMIT 1";
$result = $conn->query($query);
if ($result) {
    if ($row = $result->fetch_assoc()) {
?>
                        <div class="sectioning">
                        <br>
                            
                            <hr>
                            <table>
    <tr>
        <th>
            <label>DATE OF REGISTRATION<span class="req">*</span></label><br>
            <input type="date" name="date_of_registration" required value=<?php echo $row["reg"];?>>
        </th>
        <th>
            <label>DATE OF BIRTH<span class="req">*</span></label><br>
            <input type="date" name="date_of_birth" required value=<?php echo $row["bday"];?>>
        </th>
        <th>
            <label>SERIAL NUMBER</label><br>
            <input type="text" name="serial_number" value=<?php echo $row["serial"];?>>
        </th>
        <th>
            <label>SE STATUS<span class="req">*</span></label><br>
            <select name="se_status" required >
                <option value="NHTS"<?php if($row["se_status"]=="NHTS"){echo "selected";}?>>NHTS</option>
                <option value="Non-NHTS"<?php if($row["se_status"]=="Non-NHTS"){echo "selected";}?>>Non-NHTS</option>
            </select>
        </th>
    </tr>
    <tr>
        <th>
            <label>Sex<span class="req">*</span></label><br>
            <select name="sex" required>
                <option value="Male"  <?php if($row["sex"]=="Male"){echo "selected";}?>>Male</option>
                <option value="Female"  <?php if($row["sex"]=="Female"){echo "selected";}?>>Female</option>
            </select>
        </th>
    </tr>
    <tr>
        <th>
            <label>FIRST NAME<span class="req">*</span></label><br>
            <input type="text" name="first_name" value=<?php echo $row["fname"];?> required>
        </th>
        <th>
            <label>MIDDLE NAME<span class="req">*</span></label><br>
            <input type="text" name="middle_name" required value=<?php echo $row["mname"];?> >
        </th>
        <th>
            <label>LAST NAME<span class="req">*</span></label><br>
            <input type="text" name="last_name1" required value=<?php echo $row["lname"];?> >
        </th>
        <th>
            <label>SUFFIX</label><br>
            <input type="text" name="suffix" value=<?php echo $row["suffix"];?> >
        </th>
    </tr>
    <tr>
        <th>
            <b>Complete Name of Mother</b>
            <br>
            <label>FIRST NAME<span class="req">*</span></label><br>
            <input type="text" name="mother_fname" value="<?php echo $row["mother_fname"];?>" required>
        </th>
        <th>
            <br>
            <label>MIDDLE NAME</label><br>
            <input type="text" name="mother_mname" value="<?php echo $row["mother_mname"];?>">
        </th>
        <th>
            <br>
            <label>LAST NAME<span class="req">*</span></label><br>
            <input type="text" name="mother_lname" value="<?php echo $row["mother_lname"];?>" required>
        </th>
        <th></th>
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
    <label>BARANGAY<span class="req">*</span></label><br>
    <input type="text" name="barangay" required value="<?php echo $row['brgy']; ?>">
</th>
<th>
    <label>CITY/MUNICIPALITY<span class="req">*</span></label><br>
    <input type="text" name="municipality" required value="<?php echo $row['mun']; ?>">
</th>
<th>
    <label>PROVINCE<span class="req">*</span></label><br>
    <input type="text" name="province" required value="<?php echo $row['prov']; ?>">
</th>
    </tr>
    <tr>
        <th>Child Protected at Birth (CPAB) <br>(counts should be consistent with Maternal TCL livebirths) </th>
    </tr>
    <tr>
        <th colspan="2">
            <div class="www"><input type="radio" name="cpab" value="TT2/Td2" <?php if($row["cpab"]=="TT2/Td2"){echo "checked";}?>>
            TT2/Td2 given to the mother a month prior to delivery (for mothers pregnant for the first time)
            </div>
        </th>   
        <th colspan="2">
            <div class="www"><input type="radio" name="cpab" value="TT3/Td3 to TT5/Td5" <?php if($row["cpab"]=="TT3/Td3 to TT5/Td5"){echo "checked";}?>>
            TT3/Td3 to TT5/Td5 (or TT1/Td1 to TT5/Td5) given to the mother anytime prior to delivery
            </div>
        </th> 
    </tr>
</table>


                        </div>




<?php 
$query = "SELECT * FROM `immunization_1` WHERE `immu_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>

                        <div class="sectioning"  id="a2">
                        
                            <hr>
                         <h2>0-28 days old</h2>
                         <table>
    <tr>
        <th>
            <label>LENGTH AT BIRTH(cm)<span class="req">*</span></label><br>
            <input type="number" name="length_at_birth" required value=<?php echo $row1["length"];?>>
        </th>
        <th>
            <label>WEIGHT AT BIRTH(KG)<span class="req">*</span></label><br>
            <input type="number" name="weight_at_birth" required value=<?php echo $row1["weight"];?>>
        </th>
    </tr>
    <tr>
        <th colspan="3">
            <label>Status (Birth Weight)<span class="req">*</span></label><br>
            <div class="op"><input type="radio" name="birth_weight_status" value="L" <?php if($row1["bw"]=='L'){echo "checked";}?>>&nbsp;&nbsp;<b>L:</b> low: < 2,500 grams</div>
            <div class="op"><input type="radio" name="birth_weight_status" value="N" <?php if($row1["bw"]=='N'){echo "checked";}?>>&nbsp;&nbsp;<b>N:</b> low: > 2,500 grams</div>
            <div class="op"><input type="radio" name="birth_weight_status" value="U" <?php if($row1["bw"]=='U'){echo "checked";}?>>&nbsp;&nbsp;<b>U:</b> Unknown</div>
        </th>
    </tr>
    <tr>
        <th colspan="3">
            <b>Initiated breast feeding immediately after birth lasting for 90 minutes</b><br>
            <label>Date</label><br>
            <input type="date" name="breastfeeding_initiation_date" class="onew" value=<?php echo $row1["bf"];?>>
        </th>
    </tr>
    <tr>
        <th>
            <b>Immunization</b><br>
        </th>
    </tr>
    <tr>
        <th>
            <label>BCG Date</label><br>
            <input type="date" name="bcg_date" value=<?php echo $row1["bcg"];?>>
        </th>
        <th>
            <label>Hepa B-BD Date</label><br>
            <input type="date" name="hepa_b_bd_date" value=<?php echo $row1["hepa"];?>>
        </th>
    </tr>
</table>
<?php
    }
}
?>
                        </div>
                        <?php 
$query = "SELECT * FROM `immunization_2` WHERE `immu_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>

                        <div class="sectioning"  id="a3">
                        <!---->
                            <hr>
                            <h2>1-3 months old</h2>
<b>Nutritional Status Assessment</b>
<table>
    <tr>
        <th>
            <label>AGE IN MONTHS</label><br>
            <input type="number" name="age_in_months_1" value=<?php echo $row1["age_in_months_1"];?>>
        </th>
        <th>
            <label>LENGTH (CM)</label><br>
            <input type="number" name="length_cm_1" value=<?php echo $row1["length_cm_1"];?>>
        </th>
        <th>
            <label>DATE TAKEN</label><br>
            <input type="date" name="date_taken_1" value=<?php echo $row1["date_taken_1"];?>>
        </th>
        <th>
            <label>WEIGHT (KG)</label><br>
            <input type="number" name="weight_kg_1" value=<?php echo $row1["weight_kg_1"];?>>
        </th>
        <th>
            <label>DATE TAKEN</label><br>
            <input type="date" name="date_taken_2" value=<?php echo $row1["date_taken_2"];?>>
        </th>
    </tr>
    <tr>
        <th>
            <label>STATUS</label>
        </th>
    </tr>
    <tr>
        <th> 
            <div class="opp"><input type="radio" name="sst_1" value="N" <?php if($row1["sst_1"]=="N"){echo "checked";}?>>&nbsp;&nbsp;<b>N:</b> Normal</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sst_1" value="S" <?php if($row1["sst_1"]=="S"){echo "checked";}?>>&nbsp;&nbsp;<b>S:</b> Stunted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sst_1" value="W-MAM" <?php if($row1["sst_1"]=="W-MAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sst_1" value="W-SAM" <?php if($row1["sst_1"]=="W-SAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sst_1" value="O" <?php if($row1["sst_1"]=="O"){echo "checked";}?>>&nbsp;&nbsp;<b>O:</b> Obese/overweight</div>
        </th>
    </tr>
    <tr>
        <th><b>Low Birth weight given iron</b></th>
    </tr>
    <tr>
        <th>
            <label>1 month</label><br>
            <input type="date" name="lbw_given_iron_1" value=<?php echo $row1["lbw_given_iron_1"];?>>
        </th>
        <th>
            <label>2 months</label><br>
            <input type="date" name="lbw_given_iron_2" value=<?php echo $row1["lbw_given_iron_2"];?>>
        </th>
        <th>
            <label>3 months</label><br>
            <input type="date" name="lbw_given_iron_3" value=<?php echo $row1["lbw_given_iron_3"];?>>
        </th>
    </tr>
    <tr>
        <th>Immunization</th>
    </tr>
    <!-- Add immunization input fields with unique names here -->
</table>

<table class="bod">
    <tr>
        <th><b>DPT-HIB-HepB</b></th>
    </tr>
    <tr>
        <th>
            1st dose (1 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="dpt_hib_hepb_1st_dose_2" value=<?php echo $row1["dpt_hib_hepb_1st_dose_2"];?>>
        </th>
        <th>
            2nd dose (2 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="dpt_hib_hepb_2nd_dose_2" value=<?php echo $row1["dpt_hib_hepb_2nd_dose_2"];?>>
        </th>
        <th>
            3rd dose (3 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="dpt_hib_hepb_3rd_dose_2" value=<?php echo $row1["dpt_hib_hepb_3rd_dose_2"];?>>
        </th>
    </tr>
</table>
<br>

<table class="bod">
    <tr>
        <th><b>OPB</b></th>
    </tr>
    <tr>
        <th>
            1st dose (1 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="opb_1st_dose_2" value=<?php echo $row1["opb_1st_dose_2"];?>>
        </th>
        <th>
            2nd dose (2 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="opb_2nd_dose_2" value=<?php echo $row1["opb_2nd_dose_2"];?>>
        </th>
        <th>
            3rd dose (3 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="opb_3rd_dose_2" value=<?php echo $row1["opb_3rd_dose_2"];?>>
        </th>
    </tr>
</table>
<br>

<table class="bod">
    <tr>
        <th><b>PCB</b></th>
    </tr>
    <tr>
        <th>
            1st dose (1 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="pcb_1st_dose_2" value=<?php echo $row1["pcb_1st_dose_2"];?>>
        </th>
        <th>
            2nd dose (2 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="pcb_2nd_dose_2" value=<?php echo $row1["pcb_2nd_dose_2"];?>>
        </th>
        <th>
            3rd dose (3 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="pcb_3rd_dose_2" value=<?php echo $row1["pcb_3rd_dose_2"];?>>
        </th>
    </tr>
</table>
<br>

<table class="bod bo1">
    <tr>
        <th><b>IPV</b></th>
    </tr>
    <tr>
        <th>
            3rd dose (3 1/2 mos)<br>DATE TAKEN<br>
            <input type="date" name="ipv_3rd_dose_2" value=<?php echo $row1["ipv_3rd_dose_2"];?>>
        </th>
    </tr>
</table>

                    <br>
                   <b>  Exclusive Breastfeeding</b>
                   <i>During the following immunization visits of the child at 11/2, 21/2, and 31/2 months old (or 4-5 mos.), ask the mother if the child continues to be exclusively breastfed. Select Y if still EBF or N if no longer EBF then put the date when the infant was assessed. </i>
                   <br>  
                   <table class="as2">
    <tr>
        <th colspan="2">1 1/2 months</th>
    </tr>
    <tr>
        <th>
            EBF
            <select name="ebf_1_5_months_2">
                <option value="">Select an option</option>
                <option value="Yes" <?php if($row1["ebf_1_5_months_2"]=="Yes"){echo "selected";}?>>Yes</option>
                <option value="No" <?php if($row1["ebf_1_5_months_2"]=="No"){echo "selected";}?>>No</option>
            </select>
        </th>
        <th>
            DATE ASSESSED<br><input type="date" name="date_assessed_1_5_months_2" value=<?php echo $row1["date_assessed_1_5_months_2"];?>>
        </th>
    </tr>
</table>

<table class="as2">
    <tr>
        <th colspan="2">2 1/2 months</th>
    </tr>
    <tr>
        <th>
            EBF
            <select name="ebf_2_5_months_2">
                <option value="">Select an option</option>
                <option value="Yes" <?php if($row1["ebf_2_5_months_2"]=="Yes"){echo "selected";}?>>Yes</option>
                <option value="No" <?php if($row1["ebf_2_5_months_2"]=="No"){echo "selected";}?>>No</option>
            </select>
        </th>
        <th>
            DATE ASSESSED<br><input type="date" name="date_assessed_2_5_months_2"  value=<?php echo $row1["date_assessed_2_5_months_2"];?>>
        </th>
    </tr>
</table>

<table class="as2">
    <tr>
        <th colspan="2">3 1/2 months</th>
    </tr>
    <tr>
        <th>
            EBF
            <select name="ebf_3_5_months_2">
                <option value="">Select an option</option>
                <option value="Yes" <?php if($row1["ebf_3_5_months_2"]=="Yes"){echo "selected";}?>>Yes</option>
                <option value="No" <?php if($row1["ebf_3_5_months_2"]=="No"){echo "selected";}?>>No</option>
            </select>
        </th>
        <th>
            DATE ASSESSED<br><input type="date" name="date_assessed_3_5_months_2" value=<?php echo $row1["date_assessed_3_5_months_2"];?>>
        </th>
    </tr>
</table>

<table class="as2">
    <tr>
        <th colspan="2">4-5 months</th>
    </tr>
    <tr>
        <th>
            EBF
            <select name="ebf_4_5_months_2">
                <option value="">Select an option</option>
                <option value="Yes" <?php if($row1["ebf_4_5_months_2"]=="Yes"){echo "selected";}?>>Yes</option>
                <option value="No" <?php if($row1["ebf_4_5_months_2"]=="No"){echo "selected";}?> >No</option>
            </select>
        </th>
        <th>
            DATE ASSESSED<br><input type="date" name="date_assessed_4_5_months_2" value=<?php echo $row1["date_assessed_4_5_months_2"];?> >
        </th>
    </tr>
</table>

                </div>
<?php
    }
}
?>
              <?php 
$query = "SELECT * FROM `immunization_3` WHERE `immu_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>

                        <div class="sectioning"  id="a4">
                     <!--   -->
                            <hr>
                         <h2>6-11 months old</h2>
                         <b>Exclusively Breastfed up to 6 months</b></br>
<i>Select  <b>Y</b> if YES or <b>N</b> if NO; then put the date when the infant was assessed. </i>
<br></br>
<table class="as2">
    <tr>
        <th>
            EBF
            <select name="ebf_6_months">
                <option value="">Select an option</option>
                <option value="Yes" <?php if($row1["ebf_6_months"]=="Yes"){echo "selected";}?>>Yes</option>
                <option value="No" <?php if($row1["ebf_6_months"]=="No"){echo "selected";}?>>No</option>
            </select>
        </th>
        <th>
            DATE ASSESSED<br><input type="date" name="date_assessed_ebf_6_months" value=<?php echo $row1["date_assessed_ebf_6_months"];?>>
        </th>
    </tr>
</table>
<br>
<br><br>
<br>
<b>Introduction of Complementary Feeding at 6 months old</b>
<br>
<table>
    <tr>
        <th>
            COMPLEMENTARY FEEDING (Y OR N) <br>
            <select name="complementary_feeding_6_months">
                <option value="">Select an option</option>
                <option value="Yes"  <?php if($row1["complementary_feeding_6_months"]=="Yes"){echo "selected";}?>>Yes</option>
                <option value="No"  <?php if($row1["complementary_feeding_6_months"]=="No"){echo "selected";}?>>No</option>
            </select>
        </th>
        <th><div class="opp"><input type="radio" value="1" name="bfed_6_months"  <?php if($row1["bfed_6_months"]=="1"){echo "checked";}?> > 1: with continuous breastfeeding</div></th>
        <th><div class="opp"><input type="radio" value="2" name="bfed_6_months"  <?php if($row1["bfed_6_months"]=="2"){echo "checked";}?>> 2: no longer breastfeeding or never breastfed</div></th>
    </tr>
</table>
<br>
<b>Vitamin A</b><br>
<label>DATE GIVEN</label><br>
<input type="date" name="vitamin_a_date"  class="onew" value=<?php echo $row1["vitamin_a_date"];?>>
<br>
</table>
<br>
<b>MNP</b><br>
<label>DATE GIVEN</label><br>
<input type="date" name="mnp_date"  class="onew" value=<?php echo $row1["mnp_date"];?>>
<br>
</table>
<br>
<b>MMR Dose 1 at 9th month</b><br>
<label>DATE GIVEN</label><br>
<input type="date" name="mmr_dose1_date"  class="onew" value=<?php echo $row1["mmr_dose1_date"];?>>
<br>

                        </div>
                        <?php
    }
}
?>
           <?php 
$query = "SELECT * FROM `immunization_4` WHERE `immu_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>


                        <div class="sectioning"  id="a5">
                       <!-- -->
                            <hr>
                            <h2>12 months old</h2>
<b>Nutritional Status Assessment</b>
<table>
    <tr>
        <th>
            <label>AGE IN MONTHS</label><br>
            <input type="number" name="age_in_months" value=<?php echo $row1["age_in_months"];?>>
        </th>
        <th>
            <label>LENGTH (CM)</label><br>
            <input type="number" name="length_cm" value=<?php echo $row1["length_cm"];?>>
        </th>
        <th>
            <label>DATE TAKEN</label><br>
            <input type="date" name="date_taken_length" value=<?php echo $row1["date_taken_length"];?>>
        </th>
        <th>
            <label>WEIGHT (KG)</label><br>
            <input type="number" name="weight_kg" value=<?php echo $row1["weight_kg"];?>>
        </th>
        <th>
            <label>DATE TAKEN</label><br>
            <input type="date" name="date_taken_weight" value=<?php echo $row1["date_taken_weight"];?> >
        </th>
    </tr>
    <tr>
        <th><label>STATUS</label></th>
    </tr>
    <tr>
        <th>
            <div class="opp"><input type="radio" name="sst" value="N"  <?php if($row1["status"]=="N"){echo "checked";}?>>&nbsp;&nbsp;<b>N:</b> Normal</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sst" value="S"  <?php if($row1["status"]=="S"){echo "checked";}?>>&nbsp;&nbsp;<b>S:</b> Stunted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sst" value="W-MAM"  <?php if($row1["status"]=="W-MAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sst" value="W-SAM"  <?php if($row1["status"]=="W-SAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sst" value="O"  <?php if($row1["status"]=="O"){echo "checked";}?>>&nbsp;&nbsp;<b>O:</b> Obese/overweight</div>
        </th>
    </tr>
    <tr>
        <th><b>MMR Dose 2 of 12th Month</b></th>
    </tr>
    <tr>
        <th>DATE GIVEN<br> <input type="date" name="mmr_dose2_date"  value=<?php echo $row1["mmr_dose2_date"];?>></th>
    </tr>
    <tr>
        <th><b>FIC***</b></th>
    </tr>
    <tr>
        <th>DATE<br> <input type="date" name="fic_date"  value=<?php echo $row1["fic_date"];?>></th>
    </tr>
    <!--
    <tr>
        <th></th>
    </tr>
    -->
</table>
<?php
    }
}
?>
                
                        </div>
                        <?php 
$query = "SELECT * FROM `immunization_5` WHERE `immu_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>
                        <div class="sectioning"  id="a6">
                      <!--  -->
                            <hr>
                         <h2>0-11 months old</h2>
                         <table id="tas">
    <tr>
        <th><b>CIC</b><br>DATE<br><input type="date" name="cic_date"  value=<?php echo $row1["cic_date"];?>></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th><b>MAM<b></th>
    </tr>
    <tr>
        <th>
            <div class="opp"><input type="radio" name="mam_status" value="Admitted in SFP" <?php if($row1["mam_status"]=="Admitted in SFP"){echo "checked";}?>>&nbsp;&nbsp;Admitted in SFP</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="mam_status" value="Cured" <?php if($row1["mam_status"]=="Cured"){echo "checked";}?>>&nbsp;&nbsp;Cured</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="mam_status" value="Defaulted" <?php if($row1["mam_status"]=="Defaulted"){echo "checked";}?>>&nbsp;&nbsp;Defaulted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="mam_status" value="Died" <?php if($row1["mam_status"]=="Died"){echo "checked";}?>>&nbsp;&nbsp;Died</div>
        </th>
    </tr>
    <tr>
        <th><b>SAM Without complication<b></th>
    </tr>
    <tr>
        <th>
            <div class="opp"><input type="radio" name="sam_status" value="Admitted in SFP" <?php if($row1["sam_status"]=="Admitted in SFP"){echo "checked";}?>>&nbsp;&nbsp;Admitted in SFP</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sam_status" value="Cured" <?php if($row1["sam_status"]=="Cured"){echo "checked";}?>>&nbsp;&nbsp;Cured</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sam_status" value="Defaulted" <?php if($row1["sam_status"]=="Defaulted"){echo "checked";}?>>&nbsp;&nbsp;Defaulted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sam_status" value="Died" <?php if($row1["sam_status"]=="Died"){echo "checked";}?>>&nbsp;&nbsp;Died</div>
        </th>
    </tr>
</table>
<br>
</div>
<div class="sectioning"  id="a7">
    <h2>Remarks</h2>
    <textarea name="remarks" ><?php echo $row1["remarks"];?></textarea>
    <br>
                        <br>
                      <!--  <button type="submit" name="addimu" value='<?php echo $id;?>'>Save</button>-->
                        <br>
                        <br>
                        <br>
                        <hr>
                        <br><br>

                        </div>





                        <div class="saving">  





                         <a href="#a1" class="sda">Personal Information</a>
                        <a href="#a2" class="sda"> 0-28 days old</a>
                        <a href="#a3" class="sda">1-3 months old</a>
                        <a href="#a4" class="sda">6-11 months old</a>
                        <a href="#a5" class="sda">12 months old</a>
                        <a href="#a6" class="sda">0-11 months old</a>
                        <a href="#a7" class="sda">Remarks</a>
                        </div></div>
                    </div>  
               <?php
    }
}
               ?>
                    <style>
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
                            float:left;
                            
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
           </form>
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