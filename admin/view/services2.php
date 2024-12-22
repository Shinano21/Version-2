<?php

session_start();

include "../dbcon.php";
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}
?>

<?php 

if(isset($_POST["updateNutrition"])){
    $id = $_POST["id"];
    $date_of_registration = $_POST['date_of_registration'];
    $date_of_birth = $_POST['date_of_birth'];
    $serial_number = $_POST['serial_number'];
    $se_status = $_POST['se_status'];
    $sex = $_POST['sex'];
    $length_cm = $_POST['length_cm'];
    $weight_kg = $_POST['weight_kg'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $suffix = $_POST['suffix'];
    $zone = $_POST['zone'];
    $barangay = $_POST['barangay'];
    $city_municipality = $_POST['city_municipality'];
    $province = $_POST['province'];
    $mother_fname = $_POST["mother_fname"];
    $mother_mname = $_POST["mother_mname"];
    $mother_lname = $_POST["mother_lname"];
    
    $sql = "UPDATE nutrition 
        SET 
        `reg` = '$date_of_registration',
        `bday` = '$date_of_birth',
        `serial` = '$serial_number',
        `se_status` = '$se_status',
        `sex` = '$sex',
        `length` = '$length_cm',
        `weight` = '$weight_kg',
        `fname` = '$first_name',
        `mname` = '$middle_name',
        `lname` = '$last_name',
        `suffix` = '$suffix',
        `zone` = '$zone',
        `brgy` = '$barangay',
        `city` = '$city_municipality',
        `province` = '$province',
        `mother_fname` = '$mother_fname',
        `mother_mname` = '$mother_mname',
        `mother_lname` = '$mother_lname'
        WHERE `id` = $id";
    mysqli_query($conn, $sql);


        $nutritional_status = isset($_POST['nutritional_status']) ? $_POST['nutritional_status'] : null;
        $mnp_date = $_POST['mnp_date'];
        $vitamin_a_1st_dose_date = $_POST['vitamin_a_1st_dose_date'];
        $vitamin_a_2nd_dose_date = $_POST['vitamin_a_2nd_dose_date'];
        $deworming_1st_dose_date = $_POST['deworming_1st_dose_date'];
        $deworming_2nd_dose_date = $_POST['deworming_2nd_dose_date'];
        $deworming_yn = isset($_POST['deworming_yn']) ? $_POST['deworming_yn'] : null;
        $sqlUpdateNutri1 = "UPDATE nutrition_1 
            SET 
                `nutritional_status` = '$nutritional_status',
                `mnp_date` = '$mnp_date',
                `vitamin_a_1st_dose_date` = '$vitamin_a_1st_dose_date',
                `vitamin_a_2nd_dose_date` = '$vitamin_a_2nd_dose_date',
                `deworming_1st_dose_date` = '$deworming_1st_dose_date',
                `deworming_2nd_dose_date` = '$deworming_2nd_dose_date',
                `deworming_yn` = '$deworming_yn'
            WHERE `nutrition_id` = $id";
        mysqli_query($conn, $sqlUpdateNutri1);

        $vitamin_a_1st_dose_date2 = $_POST['vitamin_a_1st_dose_date2'];
        $vitamin_a_2nd_dose_date2 = $_POST['vitamin_a_2nd_dose_date2'];
        $deworming_1st_dose_date2 = $_POST['deworming_1st_dose_date2'];
        $deworming_2nd_dose_date2 = $_POST['deworming_2nd_dose_date2'];
        $deworming_yn2 = $_POST['deworming_yn2'];
        $ns2 =$_POST["nutritional_status2"];
        $sqlUpdateNutri2 = "UPDATE nutrition_2 
            SET 
                `vitamin_a_1st_dose_date` = '$vitamin_a_1st_dose_date2',
                `vitamin_a_2nd_dose_date` = '$vitamin_a_2nd_dose_date2',
                `deworming_1st_dose_date` = '$deworming_1st_dose_date2',
                `deworming_2nd_dose_date` = '$deworming_2nd_dose_date2',
                `deworming_yn` = '$deworming_yn2',
                `nutritional_status2` = '$ns2'
            WHERE `nutrition_id` = $id";
        mysqli_query($conn, $sqlUpdateNutri2);

        $vitamin_a_1st_dose_date3 = $_POST['vitamin_a_1st_dose_date3'];
        $vitamin_a_2nd_dose_date3 = $_POST['vitamin_a_2nd_dose_date3'];
        $deworming_1st_dose_date3 = $_POST['deworming_1st_dose_date3'];
        $deworming_2nd_dose_date3 = $_POST['deworming_2nd_dose_date3'];
        $deworming_yn3 = $_POST['deworming_yn3'];
        $ns3 =$_POST["nutritional_status3"];
        $sqlUpdateNutri3 = "UPDATE nutrition_3 
            SET 
                `vitamin_a_1st_dose_date` = '$vitamin_a_1st_dose_date3',
                `vitamin_a_2nd_dose_date` = '$vitamin_a_2nd_dose_date3',
                `deworming_1st_dose_date` = '$deworming_1st_dose_date3',
                `deworming_2nd_dose_date` = '$deworming_2nd_dose_date3',
                `deworming_yn` = '$deworming_yn3',
                `nutritional_status3` = '$ns3'
            WHERE `nutrition_id` = $id";
        mysqli_query($conn, $sqlUpdateNutri3);

        $vitamin_a_1st_dose_date4 = $_POST['vitamin_a_1st_dose_date4'];
        $vitamin_a_2nd_dose_date4 = $_POST['vitamin_a_2nd_dose_date4'];
        $deworming_1st_dose_date4 = $_POST['deworming_1st_dose_date4'];
        $deworming_2nd_dose_date4 = $_POST['deworming_2nd_dose_date4'];
        $deworming_yn4 = $_POST['deworming_yn4'];
        $ns4 =$_POST["nutritional_status4"];
        $sqlUpdateNutri4 = "UPDATE nutrition_4 
            SET 
                `vitamin_a_1st_dose_date` = '$vitamin_a_1st_dose_date4',
                `vitamin_a_2nd_dose_date` = '$vitamin_a_2nd_dose_date4',
                `deworming_1st_dose_date` = '$deworming_1st_dose_date4',
                `deworming_2nd_dose_date` = '$deworming_2nd_dose_date4',
                `deworming_yn` = '$deworming_yn4',
                `nutritional_status4` = '$ns4'
            WHERE `nutrition_id` = $id";
        mysqli_query($conn, $sqlUpdateNutri4);

        $mam5 = $_POST['mam5'];
        $sam5 = $_POST['sam5'];
        $remarks5 = $_POST['remarks5'];
        $sqlUpdateNutri5 = "UPDATE nutrition_5 
            SET 
                `mam_status` = '$mam5',
                `sam_status` = '$sam5',
                `remarks` = '$remarks5'
            WHERE `nutrition_id` = $id";
        mysqli_query($conn, $sqlUpdateNutri5);

        header("Location:../services2.php?updated=Success");
} else {
    echo "Error updating nutrition table: " . mysqli_error($conn);
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
    <title>Update Nutrition and Deworming Record | CareVisio</title>
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
                            <a href="../services2.php"><h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i>
                            Back to Nutrition and Deworming Services Records</h7></a>
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
                    <form method="post" action="" enctype="multipart/form-data">
                    <div class="row" position="relative;" id="a1">
                        <div id="navigate" >

                        <a href="#a1" class="sda">Personal Information</a>
                        <a href="#a2" class="sda"> 12-23 months old</a>
                        <a href="#a3" class="sda">24-35 months old</a>
                        <a href="#a4" class="sda">36-47 months old</a>
                        <a href="#a5" class="sda">48-59 months old</a>
                        <a href="#a6" class="sda">12-59 months old</a>
                        <a href="#a7" class="sda">Remarks</a>
                        </div>
                     
                     
                        <?php

                        $id=$_GET["update"];
                        $query = "SELECT * FROM `nutrition` WHERE `id` = $id LIMIT 1";
                        $result = $conn->query($query);
                        if ($result) {
                            if ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="sectioning">
                        <br>
                            <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>
                            <hr>
                            <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                            <table>
    <tr>
        <th>
            <label>DATE OF REGISTRATION<span class="req">*</span></label><br>
            <input type="date" name="date_of_registration" required value="<?php echo $row["reg"];?>">
        </th>
        <th>
            <label>DATE OF BIRTH<span class="req">*</span></label><br>
            <input type="date" name="date_of_birth" required value="<?php echo $row["bday"];?>">
        </th>
        <th>
            <label>SERIAL NUMBER</label><br>
            <input type="text" name="serial_number" value="<?php echo $row["serial"];?>">
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
            <label>Sex<span class="req">*</span></label><br>
            <select name="sex" required>
                <option value="Male" <?php if($row["sex"]=="Male"){ echo "selected";}?>>Male</option>
                <option value="Female" <?php if($row["sex"]=="Female"){ echo "selected";}?>>Female</option>
            </select>
        </th>
        <th>
            <label>LENGTH(CM)<span class="req">*</span></label><br>
            <input type="number" name="length_cm" required  value="<?php echo $row["length"];?>">
        </th>
        <th>
            <label>WEIGHT(KG)<span class="req">*</span></label><br>
            <input type="number" name="weight_kg" required  value="<?php echo $row["weight"];?>">
        </th>
    </tr>
    <tr>
        <th>
            <label>FIRST NAME<span class="req">*</span></label><br>
            <input type="text" name="first_name" required  value="<?php echo $row["fname"];?>">
        </th>
        <th>
            <label>MIDDLE NAME<span class="req">*</span></label><br>
            <input type="text" name="middle_name" required  value="<?php echo $row["mname"];?>">
        </th>
        <th>
            <label>LAST NAME<span class="req">*</span></label><br>
            <input type="text" name="last_name" required  value="<?php echo $row["lname"];?>">
        </th>
        <th>
            <label>SUFFIX</label><br>
            <input type="text" name="suffix"  value="<?php echo $row["suffix"];?>">
        </th>
    </tr>
    <tr>
        <th>
            <b>Complete Name of Mother</b>
            <br>
            <label>FIRST NAME<span class="req">*</span></label><br>
            <input type="text" name="mother_fname" required value="<?php echo $row["mother_fname"];?>">
        </th>
        <th>
            <br>
            <label>MIDDLE NAME</label><br>
            <input type="text" name="mother_mname" value="<?php echo $row["mother_mname"];?>">
        </th>
        <th>
            <br>
            <label>LAST NAME<span class="req">*</span></label><br>
            <input type="text" name="mother_lname" required value="<?php echo $row["mother_lname"];?>">
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
    <input type="text" name="city_municipality" required value="<?php echo $row['city']; ?>">
</th>
<th>
    <label>PROVINCE<span class="req">*</span></label><br>
    <input type="text" name="province" required value="<?php echo $row['province']; ?>">
</th>

    </tr>
</table>


                        </div>



                        <?php 
$query = "SELECT * FROM `nutrition_1` WHERE `nutrition_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>


                        <div class="sectioning"  id="a2">
                            <hr>
                         <h2>12-23 months old</h2>
                         <table>
    <tr>
        <th><b>Nutritional Status</b></th>
    </tr>
    <tr>
        <th>
            <div class="opp"><input type="radio" value="N" name="nutritional_status" <?php if($row1["nutritional_status"]=="N"){echo "checked";}?>>&nbsp;&nbsp;<b>N:</b> Normal</div>
        </th>
        <th>
            <div class="opp"><input type="radio" value="S" name="nutritional_status" <?php if($row1["nutritional_status"]=="S"){echo "checked";}?>>&nbsp;&nbsp;<b>S:</b> Stunted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" value="W-MAM" name="nutritional_status" <?php if($row1["nutritional_status"]=="W-MAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" value="W-SAM" name="nutritional_status" <?php if($row1["nutritional_status"]=="W-SAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" value="O" name="nutritional_status" <?php if($row1["nutritional_status"]=="O"){echo "checked";}?>>&nbsp;&nbsp;<b>O:</b> Obese/overweight</div>
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
        <th>DATE WHEN 180 SACHETS GIVEN<br><input type="date" name="mnp_date"  value="<?php echo $row1["mnp_date"];?>"></th>
        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_1st_dose_date" value="<?php echo $row1["vitamin_a_1st_dose_date"];?>"></th>
        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_2nd_dose_date" value="<?php echo $row1["vitamin_a_1st_dose_date"];?>"></th>
    </tr>
    <tr>
        <th><b>Deworming Services</b></th>
    </tr>
    <tr>
        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="deworming_1st_dose_date" value="<?php echo $row1["deworming_1st_dose_date"];?>"></th>
        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="deworming_2nd_dose_date" value="<?php echo $row1["deworming_2nd_dose_date"];?>"></th>
        <th>Child given 2 doses of deworming drug<br>
            <input type="radio" value="Yes" name="deworming_yn" <?php if($row1["deworming_yn"]=="Yes"){echo "checked";}?>>&nbsp;Yes&nbsp;&nbsp;&nbsp;
            <input type="radio" value="No" name="deworming_yn" <?php if($row1["deworming_yn"]=="No"){echo "checked";}?>>&nbsp;No
        </th>
    </tr>
</table>
<?php
}
}
?>

                        </div>
                        <?php 
$query = "SELECT * FROM `nutrition_2` WHERE `nutrition_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>
                        <div class="sectioning"  id="a3">
                        
                            <hr>
                         <h2>24-35 months old</h2>
                         <table>
    <tr>
        <th><b>Nutritional Status</b></th>
    </tr>
    <tr>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status2" value="N" <?php if($row1["nutritional_status2"]=="N"){echo "checked";}?>> &nbsp;&nbsp;<b>N:</b> Normal</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status2" value="S" <?php if($row1["nutritional_status2"]=="S"){echo "checked";}?>>&nbsp;&nbsp;<b>S:</b> Stunted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status2" value="W-MAM" <?php if($row1["nutritional_status2"]=="W-MAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status2" value="W-SAM" <?php if($row1["nutritional_status2"]=="W-SAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status2" value="O" <?php if($row1["nutritional_status2"]=="O"){echo "checked";}?>>&nbsp;&nbsp;<b>O:</b> Obese/overweight</div>
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
        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_1st_dose_date2" value="<?php echo $row1["vitamin_a_1st_dose_date"];?>"></th>
        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_2nd_dose_date2" value="<?php echo $row1["vitamin_a_2nd_dose_date"];?>"></th>
    </tr>
    <tr>
        <th><b>Deworming Services</b></th>
    </tr>
    <tr>
        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="deworming_1st_dose_date2" value="<?php echo $row1["deworming_1st_dose_date"];?>"></th>
        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="deworming_2nd_dose_date2" value="<?php echo $row1["deworming_2nd_dose_date"];?>"></th>
        <th>Child given 2 doses of deworming drug<br>
            <input type="radio" value="Yes" name="deworming_yn2" <?php if($row1["deworming_yn"]=="Yes"){echo "checked";}?>>&nbsp;Yes&nbsp;&nbsp;&nbsp;
            <input type="radio" value="No" name="deworming_yn2" <?php if($row1["deworming_yn"]=="No"){echo "checked";}?>>&nbsp;No
        </th>
    </tr>
</table>

                </div>
<?php
    }
}
?>
    <?php 
$query = "SELECT * FROM `nutrition_3` WHERE `nutrition_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>
                        <div class="sectioning"  id="a4">
                        
                            <hr>
                         <h2>36-47 months old</h2>
                         <table>
    <tr>
        <th><b>Nutritional Status</b></th>
    </tr>
    <tr>
    <th>
            <div class="opp"><input type="radio" name="nutritional_status3" value="N" <?php if($row1["nutritional_status3"]=="N"){echo "checked";}?>> &nbsp;&nbsp;<b>N:</b> Normal</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status3" value="S" <?php if($row1["nutritional_status3"]=="S"){echo "checked";}?>>&nbsp;&nbsp;<b>S:</b> Stunted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status3" value="W-MAM" <?php if($row1["nutritional_status3"]=="W-MAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status3" value="W-SAM" <?php if($row1["nutritional_status3"]=="W-SAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status3" value="O" <?php if($row1["nutritional_status3"]=="O"){echo "checked";}?>>&nbsp;&nbsp;<b>O:</b> Obese/overweight</div>
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
        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_1st_dose_date3" value="<?php echo $row1["vitamin_a_1st_dose_date"];?>"></th>
        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_2nd_dose_date3" value="<?php echo $row1["vitamin_a_2nd_dose_date"];?>"></th>
    </tr>
    <tr>
        <th><b>Deworming Services</b></th>
    </tr>
    <tr>
        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="deworming_1st_dose_date3" value="<?php echo $row1["deworming_1st_dose_date"];?>"></th>
        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="deworming_2nd_dose_date3" value="<?php echo $row1["deworming_2nd_dose_date"];?>"></th>
        <th>Child given 2 doses of deworming drug<br>
            <input type="radio" value="Yes" name="deworming_yn3"  <?php if($row1["deworming_yn"]=="Yes"){echo "checked";}?>>&nbsp;Yes&nbsp;&nbsp;&nbsp;
            <input type="radio" value="No" name="deworming_yn3"  <?php if($row1["deworming_yn"]=="No"){echo "checked";}?>>&nbsp;No
        </th>
    </tr>
</table>

                 
</div>
<?php
    }
}?>
    <?php 
$query = "SELECT * FROM `nutrition_4` WHERE `nutrition_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>

                        <div class="sectioning"  id="a5">
                        
                            <hr>
                         <h2>48-59 months old</h2>
                         <table>
    <tr>
        <th><b>Nutritional Status</b></th>
    </tr>
    <tr>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status4" value="N"  <?php if($row1["nutritional_status4"]=="N"){echo "checked";}?>> &nbsp;&nbsp;<b>N:</b> Normal</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status4" value="S" <?php if($row1["nutritional_status4"]=="S"){echo "checked";}?>>&nbsp;&nbsp;<b>S:</b> Stunted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status4" value="W-MAM" <?php if($row1["nutritional_status4"]=="W-MAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-MAM:</b> Wasted-MAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status4" value="W-SAM" <?php if($row1["nutritional_status4"]=="W-SAM"){echo "checked";}?>>&nbsp;&nbsp;<b>W-SAM:</b> Wasted-SAM</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="nutritional_status4" value="O" <?php if($row1["nutritional_status4"]=="O"){echo "checked";}?>>&nbsp;&nbsp;<b>O:</b> Obese/overweight</div>
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
        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_1st_dose_date4" value="<?php echo $row1["vitamin_a_1st_dose_date"];?>"></th>
        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="vitamin_a_2nd_dose_date4" value="<?php echo $row1["vitamin_a_2nd_dose_date"];?>"></th>
    </tr>
    <tr>
        <th><b>Deworming Services</b></th>
    </tr>
    <tr>
        <th>1st DOSE (DATE GIVEN)<br><input type="date" name="deworming_1st_dose_date4" value="<?php echo $row1["deworming_1st_dose_date"];?>"></th>
        <th>2nd DOSE (DATE GIVEN)<br><input type="date" name="deworming_2nd_dose_date4" value="<?php echo $row1["deworming_2nd_dose_date"];?>"></th>
        <th>Child given 2 doses of deworming drug<br>
            <input type="radio" value="Yes" name="deworming_yn4">&nbsp;Yes&nbsp;&nbsp;&nbsp;
            <input type="radio" value="No" name="deworming_yn4">&nbsp;No
        </th>
    </tr>
</table>

                        </div>
                        <?php
    }
}
?>
   <?php 
$query = "SELECT * FROM `nutrition_5` WHERE `nutrition_id` = $id LIMIT 1";
$result1 = $conn->query($query);
if ($result1) {
    if ($row1 = $result1->fetch_assoc()) {
?>
                        <div class="sectioning"  id="a6">
                        
                            <hr>
                         <h2>12-50 months old</h2>
                         <table id="tas">
                           
                        
                            <tr>
                                <th><b>MAM<b></th>
                            </tr>
                            <tr>
        <th>
            <div class="opp"><input type="radio" name="mam5" value="Admitted in SFP" <?php if($row1["mam_status"]=="Admitted in SFP"){echo "checked";}?> >&nbsp;&nbsp;Admitted in SFP</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="mam5" value="Cured" <?php if($row1["mam_status"]=="Cured"){echo "checked";}?> >&nbsp;&nbsp;Cured</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="mam5" value="Defaulted" <?php if($row1["mam_status"]=="Defaulted"){echo "checked";}?> >&nbsp;&nbsp;Defaulted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="mam5" value="Died" <?php if($row1["mam_status"]=="Died"){echo "checked";}?> >&nbsp;&nbsp;Died</div>
        </th>
    </tr>
                        
                            <tr>
                                <th><b>SAM Without complication<b></th>
                            </tr>
                            <tr>
        <th>
            <div class="opp"><input type="radio" name="sam5" value="Admitted in SFP" <?php if($row1["sam_status"]=="Admitted in SFP"){echo "checked";}?>>&nbsp;&nbsp;Admitted in SFP</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sam5" value="Cured"  <?php if($row1["sam_status"]=="Cured"){echo "checked";}?>>&nbsp;&nbsp;Cured</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sam5" value="Defaulted"  <?php if($row1["sam_status"]=="Defaulted"){echo "checked";}?>>&nbsp;&nbsp;Defaulted</div>
        </th>
        <th>
            <div class="opp"><input type="radio" name="sam5" value="Died"  <?php if($row1["sam_status"]=="Died"){echo "checked";}?>>&nbsp;&nbsp;Died</div>
        </th>
                        </tr>
                        </table>
                        <br>
                        </div>
                        <div class="sectioning"  id="a7">
                        
                        <h2>Remarks</h2>
                        <textarea name="remarks5"><?php echo $row1["remarks"]; ?></textarea>
                        <br>
                        <br>
                        <button type="submit" name="updateNutrition" value="<?php echo $row1["id"];?>">Save</button>
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
                        <a href="#a2" class="sda"> 12-23 months old</a>
                        <a href="#a3" class="sda">24-35 months old</a>
                        <a href="#a4" class="sda">36-47 months old</a>
                        <a href="#a5" class="sda">48-59 months old</a>
                        <a href="#a6" class="sda">12-59 months old</a>
                        <a href="#a7" class="sda">Remarks</a>
                        </div></div>
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
    <script>
    // Function to make fields readonly if they have pre-filled values
    function makeFieldsReadonlyIfNotEmpty() {
        const inputs = document.querySelectorAll("input[type='text'], input[type='date']");
        inputs.forEach(input => {
            if (input.value.trim() !== "") {
                input.setAttribute("readonly", "readonly");
            } else {
                input.removeAttribute("readonly");
            }
        });
    }

    // Run the function when the page loads
    window.onload = makeFieldsReadonlyIfNotEmpty;

    // Optional: Make all fields editable again if needed
    function enableFields() {
        const inputs = document.querySelectorAll("input[readonly]");
        inputs.forEach(input => {
            input.removeAttribute("readonly");
        });
    }
</script>

</body>

</html>
 <?php
    }
}

?>