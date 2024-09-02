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
    <title>Add Immunization and Nutrition Record | CareVisio</title>
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
                                <a href="../services1.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i>
                                        Back to Immunization and Nutrition Services Records</h7>
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
                    <form method="post" action="add.php">
                        <div class="row" position="relative;" id="a1">
                            <div id="navigate">

                                <a href="#a1" class="sda">Personal Information</a>
                                <a href="#a2" class="sda"> 0-28 days old</a>
                                <a href="#a3" class="sda">1-3 months old</a>
                                <a href="#a4" class="sda">6-11 months old</a>
                                <a href="#a5" class="sda">12 months old</a>
                                <a href="#a6" class="sda">0-11 months old</a>
                                <a href="#a7" class="sda">Remarks</a>
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
                                            <label>SERIAL NUMBER</label><br>
                                            <input type="text" name="serial_number">
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
                                            <label>Sex<span class="req">*</span></label><br>
                                            <select name="sex" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <b>Complete Name of Child</b>
                                            <br>
                                            <label>FIRST NAME<span class="req">*</span></label><br>
                                            <input type="text" name="first_name" required>
                                        </th>
                                        <th>
                                            <br>
                                            <label>MIDDLE NAME</label><br>
                                            <input type="text" name="middle_name">
                                        </th>
                                        <th>
                                            <br>
                                            <label>LAST NAME<span class="req">*</span></label><br>
                                            <input type="text" name="last_name1" required>
                                        </th>
                                        <th>
                                            <br>
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
                                            <b>Complete Address</b><br>
                                            <label>ZONE<span class="req">*</span></label><br>
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
                                            <br>
                                            <label>BARANGAY<span class="req">*</span></label><br>
                                            <input type="text" name="barangay" required value="Bagumbayan">
                                        </th>
                                        <th>
                                            <br>
                                            <label>CITY/MUNICIPALITY<span class="req">*</span></label><br>
                                            <input type="text" name="city_municipality" required value="Daraga">
                                        </th>
                                        <th>
                                            <br>
                                            <label>PROVINCE<span class="req">*</span></label><br>
                                            <input type="text" name="province" required value="Albay">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Child Protected at Birth (CPAB) <br>(counts should be consistent with
                                            Maternal TCL livebirths) </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">
                                            <div class="www"><input type="radio" name="cpab" value="TT2/Td2" >
                                                TT2/Td2 given to the mother a month prior to delivery (for mothers
                                                pregnant for the first time)
                                            </div>
                                        </th>
                                        <th colspan="2">
                                            <div class="www"><input type="radio" name="cpab" value="TT3/Td3 to TT5/Td5">
                                                TT3/Td3 to TT5/Td5 (or TT1/Td1 to TT5/Td5) given to the mother anytime
                                                prior to delivery
                                            </div>
                                        </th>
                                    </tr>
                                </table>


                            </div>






                            <div class="sectioning" id="a2">
                                <hr>
                                <h2>0-28 days old</h2>
                                <table>
                                    <tr>
                                        <th>
                                            <label>LENGTH AT BIRTH(cm)<span class="req">*</span></label><br>
                                            <input type="number" name="length_at_birth" required>
                                        </th>
                                        <th>
                                            <label>WEIGHT AT BIRTH(KG)<span class="req">*</span></label><br>
                                            <input type="number" name="weight_at_birth" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <label>Status (Birth Weight)<span class="req">*</span></label><br>
                                            <div class="op"><input type="radio" name="birth_weight_status"
                                                    value="L">&nbsp;&nbsp;<b>L:</b> low: < 2,500 grams</div>
                                                    <div class="op"><input type="radio" name="birth_weight_status"
                                                            value="N" >&nbsp;&nbsp;<b>N:</b> low: > 2,500 grams
                                                    </div>
                                                    <div class="op"><input type="radio" name="birth_weight_status"
                                                            value="U">&nbsp;&nbsp;<b>U:</b> Unknown</div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <b>Initiated breast feeding immediately after birth lasting for 90
                                                minutes</b><br>
                                            <label>Date</label><br>
                                            <input type="date" name="breastfeeding_initiation_date" class="onew">
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
                                            <input type="date" name="bcg_date">
                                        </th>
                                        <th>
                                            <label>Hepa B-BD Date</label><br>
                                            <input type="date" name="hepa_b_bd_date">
                                        </th>
                                    </tr>
                                </table>

                            </div>
                            <div class="sectioning" id="a3">
                                <!--<p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>-->
                                <hr>
                                <h2>1-3 months old</h2>
                                <b>Nutritional Status Assessment</b>
                                <table>
                                    <tr>
                                        <th>
                                            <label>AGE IN MONTHS</label><br>
                                            <input type="number" name="age_in_months_1">
                                        </th>
                                        <th>
                                            <label>LENGTH (CM)</label><br>
                                            <input type="number" name="length_cm_1">
                                        </th>
                                        <th>
                                            <label>DATE TAKEN</label><br>
                                            <input type="date" name="date_taken_1">
                                        </th>
                                        <th>
                                            <label>WEIGHT (KG)</label><br>
                                            <input type="number" name="weight_kg_1">
                                        </th>
                                        <th>
                                            <label>DATE TAKEN</label><br>
                                            <input type="date" name="date_taken_2">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>STATUS</label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst_1" value="N"
                                                    >&nbsp;&nbsp;<b>N:</b> Normal</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst_1"
                                                    value="S">&nbsp;&nbsp;<b>S:</b> Stunted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst_1"
                                                    value="W-MAM">&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst_1"
                                                    value="W-SAM">&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst_1"
                                                    value="O">&nbsp;&nbsp;<b>O:</b> Obese/overweight</div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>Low Birth weight given iron</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>1 month</label><br>
                                            <input type="date" name="lbw_given_iron_1">
                                        </th>
                                        <th>
                                            <label>2 months</label><br>
                                            <input type="date" name="lbw_given_iron_2">
                                        </th>
                                        <th>
                                            <label>3 months</label><br>
                                            <input type="date" name="lbw_given_iron_3">
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
                                            <input type="date" name="dpt_hib_hepb_1st_dose_2">
                                        </th>
                                        <th>
                                            2nd dose (2 1/2 mos)<br>DATE TAKEN<br>
                                            <input type="date" name="dpt_hib_hepb_2nd_dose_2">
                                        </th>
                                        <th>
                                            3rd dose (3 1/2 mos)<br>DATE TAKEN<br>
                                            <input type="date" name="dpt_hib_hepb_3rd_dose_2">
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
                                            <input type="date" name="opb_1st_dose_2">
                                        </th>
                                        <th>
                                            2nd dose (2 1/2 mos)<br>DATE TAKEN<br>
                                            <input type="date" name="opb_2nd_dose_2">
                                        </th>
                                        <th>
                                            3rd dose (3 1/2 mos)<br>DATE TAKEN<br>
                                            <input type="date" name="opb_3rd_dose_2">
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
                                            <input type="date" name="pcb_1st_dose_2">
                                        </th>
                                        <th>
                                            2nd dose (2 1/2 mos)<br>DATE TAKEN<br>
                                            <input type="date" name="pcb_2nd_dose_2">
                                        </th>
                                        <th>
                                            3rd dose (3 1/2 mos)<br>DATE TAKEN<br>
                                            <input type="date" name="pcb_3rd_dose_2">
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
                                            <input type="date" name="ipv_3rd_dose_2">
                                        </th>
                                    </tr>
                                </table>

                                <br>
                                <b> Exclusive Breastfeeding</b>
                                <i>During the following immunization visits of the child at 11/2, 21/2, and 31/2 months
                                    old (or 4-5 mos.), ask the mother if the child continues to be exclusively
                                    breastfed. Select Y if still EBF or N if no longer EBF then put the date when the
                                    infant was assessed. </i>
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </th>
                                        <th>
                                            DATE ASSESSED<br><input type="date" name="date_assessed_1_5_months_2">
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </th>
                                        <th>
                                            DATE ASSESSED<br><input type="date" name="date_assessed_2_5_months_2">
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </th>
                                        <th>
                                            DATE ASSESSED<br><input type="date" name="date_assessed_3_5_months_2">
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
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </th>
                                        <th>
                                            DATE ASSESSED<br><input type="date" name="date_assessed_4_5_months_2">
                                        </th>
                                    </tr>
                                </table>

                            </div>


                            <div class="sectioning" id="a4">
                                <!--   <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>-->
                                <hr>
                                <h2>6-11 months old</h2>
                                <b>Exclusively Breastfed up to 6 months</b></br>
                                <i>Select <b>Y</b> if YES or <b>N</b> if NO; then put the date when the infant was
                                    assessed. </i>
                                <br></br>
                                <table class="as2">
                                    <tr>
                                        <th>
                                            EBF
                                            <select name="ebf_6_months">
                                                <option value="">Select an option</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </th>
                                        <th>
                                            DATE ASSESSED<br><input type="date" name="date_assessed_ebf_6_months">
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
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="1" name="bfed_6_months"> 1: with
                                                continuous breastfeeding</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" value="2" name="bfed_6_months">
                                                2: no longer breastfeeding or never breastfed</div>
                                        </th>
                                    </tr>
                                </table>
                                <br>
                                <b>Vitamin A</b><br>
                                <label>DATE GIVEN</label><br>
                                <input type="date" name="vitamin_a_date" class="onew">
                                <br>
                                </table>
                                <br>
                                <b>MNP</b><br>
                                <label>DATE GIVEN</label><br>
                                <input type="date" name="mnp_date" class="onew">
                                <br>
                                </table>
                                <br>
                                <b>MMR Dose 1 at 9th month</b><br>
                                <label>DATE GIVEN</label><br>
                                <input type="date" name="mmr_dose1_date" class="onew">
                                <br>

                            </div>

                            <div class="sectioning" id="a5">
                                <!-- <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>-->
                                <hr>
                                <h2>12 months old</h2>
                                <b>Nutritional Status Assessment</b>
                                <table>
                                    <tr>
                                        <th>
                                            <label>AGE IN MONTHS</label><br>
                                            <input type="number" name="age_in_months">
                                        </th>
                                        <th>
                                            <label>LENGTH (CM)</label><br>
                                            <input type="number" name="length_cm">
                                        </th>
                                        <th>
                                            <label>DATE TAKEN</label><br>
                                            <input type="date" name="date_taken_length">
                                        </th>
                                        <th>
                                            <label>WEIGHT (KG)</label><br>
                                            <input type="number" name="weight_kg">
                                        </th>
                                        <th>
                                            <label>DATE TAKEN</label><br>
                                            <input type="date" name="date_taken_weight">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><label>STATUS</label></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst" value="N"
                                                    >&nbsp;&nbsp;<b>N:</b> Normal</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst"
                                                    value="S">&nbsp;&nbsp;<b>S:</b> Stunted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst"
                                                    value="W-MAM">&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst"
                                                    value="W-SAM">&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sst"
                                                    value="O">&nbsp;&nbsp;<b>O:</b> Obese/overweight</div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>MMR Dose 2 of 12th Month</b></th>
                                    </tr>
                                    <tr>
                                        <th>DATE GIVEN<br> <input type="date" name="mmr_dose2_date"></th>
                                    </tr>
                                    <tr>
                                        <th><b>FIC***</b></th>
                                    </tr>
                                    <tr>
                                        <th>DATE<br> <input type="date" name="fic_date"></th>
                                    </tr>
                                    <!--
    <tr>
        <th></th>
    </tr>
    -->
                                </table>


                            </div>
                            <div class="sectioning" id="a6">
                                <!--  <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>-->
                                <hr>
                                <h2>0-11 months old</h2>
                                <table id="tas">
                                    <tr>
                                        <th><b>CIC</b><br>DATE<br><input type="date" name="cic_date"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th><b>MAM<b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" name="mam_status"
                                                    value="Admitted in SFP">&nbsp;&nbsp;Admitted in SFP</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="mam_status"
                                                    value="Cured">&nbsp;&nbsp;Cured</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="mam_status"
                                                    value="Defaulted">&nbsp;&nbsp;Defaulted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="mam_status"
                                                    value="Died">&nbsp;&nbsp;Died</div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><b>SAM Without complication<b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="opp"><input type="radio" name="sam_status"
                                                    value="Admitted in SFP">&nbsp;&nbsp;Admitted in SFP</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sam_status"
                                                    value="Cured">&nbsp;&nbsp;Cured</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sam_status"
                                                    value="Defaulted">&nbsp;&nbsp;Defaulted</div>
                                        </th>
                                        <th>
                                            <div class="opp"><input type="radio" name="sam_status"
                                                    value="Died">&nbsp;&nbsp;Died</div>
                                        </th>
                                    </tr>
                                </table>
                                <br>
                            </div>
                            <div class="sectioning" id="a7">
                                <h2>Remarks</h2>
                                <textarea name="remarks"></textarea>
                                <br>
                                <br>
                                <button type="submit" name="addimu">Save</button>
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
                            </div>
                        </div>
            </div>

            <style>
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
                margin: 0.2% 2%;

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
                float: left;

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