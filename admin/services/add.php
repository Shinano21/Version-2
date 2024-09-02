<?php
include "../dbcon.php";
if(isset($_POST["addimu"])){
   
    $reg = $_POST["date_of_registration"];
    $bday = $_POST["date_of_birth"];
    $serial = $_POST["serial_number"];
    $se = $_POST["se_status"];
    $sex = $_POST["sex"];
    $fname = $_POST["first_name"];
    $mname = $_POST["middle_name"];
    $lname = $_POST["last_name1"];
    $suffix = $_POST["suffix"];
    $bar = $_POST["barangay"];
    $zone = $_POST["zone"];
    $city = $_POST["city_municipality"];
    $province = $_POST["province"];
    $cpab = $_POST["cpab"];
    $mother_fname = $_POST["mother_fname"];
    $mother_mname = $_POST["mother_mname"];
    $mother_lname = $_POST["mother_lname"];
    $sql =  "INSERT INTO `immunization` (`id`, `reg`, `bday`, `serial`, `se_status`, `sex`, `fname`, `mname`, `lname`, `suffix`, `zone`, `brgy`, `mun`, `prov`, `cpab`,`mother_fname`,`mother_mname`,`mother_lname`) VALUES 
    (NULL, '$reg', '$bday', '$serial', '$se', '$sex', '$fname', '$mname','$lname',  '$suffix', '$zone', '$bar', '$city', '$province', '$cpab','$mother_fname','$mother_mname','$mother_lname');";
    if (mysqli_query($conn, $sql)) {
        $immuId = mysqli_insert_id($conn);
        $length = $_POST["length_at_birth"];
        $weight = $_POST["weight_at_birth"];
        $bf = isset($_POST["birth_weight_status"]) ? $_POST["birth_weight_status"] : null;
        $bcgDate = $_POST["bcg_date"];
        $hepaBBDDate = $_POST["hepa_b_bd_date"];
        $bfm = $_POST["breastfeeding_initiation_date"];
       

         $sqlInsertImm1 = "INSERT INTO `immunization_1` (`length`, `weight`, `bf`, `bcg`, `hepa`, `immu_id`, `bw`) VALUES 
         ('$length', '$weight', '$bfm' , '$bcgDate', '$hepaBBDDate', '$immuId','$bf')";
         mysqli_query($conn,  $sqlInsertImm1);


// Get data from the form
$length_at_birth = $_POST['length_at_birth'];
$weight_at_birth = $_POST['weight_at_birth'];
$birth_weight_status = $_POST['birth_weight_status'];
$breastfeeding_initiation_date = $_POST['breastfeeding_initiation_date'];
$bcg_date = $_POST['bcg_date'];
$hepa_b_bd_date = $_POST['hepa_b_bd_date'];

$age_in_months_1 = $_POST['age_in_months_1'];
$length_cm_1 = $_POST['length_cm_1'];
$date_taken_1 = $_POST['date_taken_1'];
$weight_kg_1 = $_POST['weight_kg_1'];
$date_taken_2 = $_POST['date_taken_2'];
$sst_1 = $_POST['sst_1'];
$lbw_given_iron_1 = $_POST['lbw_given_iron_1'];
$lbw_given_iron_2 = $_POST['lbw_given_iron_2'];
$lbw_given_iron_3 = $_POST['lbw_given_iron_3'];
$dpt_hib_hepb_1st_dose_2 = $_POST['dpt_hib_hepb_1st_dose_2'];
$dpt_hib_hepb_2nd_dose_2 = $_POST['dpt_hib_hepb_2nd_dose_2'];
$dpt_hib_hepb_3rd_dose_2 = $_POST['dpt_hib_hepb_3rd_dose_2'];
$opb_1st_dose_2 = $_POST['opb_1st_dose_2'];
$opb_2nd_dose_2 = $_POST['opb_2nd_dose_2'];
$opb_3rd_dose_2 = $_POST['opb_3rd_dose_2'];
$pcb_1st_dose_2 = $_POST['pcb_1st_dose_2'];
$pcb_2nd_dose_2 = $_POST['pcb_2nd_dose_2'];
$pcb_3rd_dose_2 = $_POST['pcb_3rd_dose_2'];
$ipv_3rd_dose_2 = $_POST['ipv_3rd_dose_2'];
$ebf_1_5_months_2 = $_POST['ebf_1_5_months_2'];
$date_assessed_1_5_months_2 = $_POST['date_assessed_1_5_months_2'];
$ebf_2_5_months_2 = $_POST['ebf_2_5_months_2'];
$date_assessed_2_5_months_2 = $_POST['date_assessed_2_5_months_2'];
$ebf_3_5_months_2 = $_POST['ebf_3_5_months_2'];
$date_assessed_3_5_months_2 = $_POST['date_assessed_3_5_months_2'];
$ebf_4_5_months_2 = $_POST['ebf_4_5_months_2'];
$date_assessed_4_5_months_2 = $_POST['date_assessed_4_5_months_2'];

$sql2 = "INSERT INTO immunization_2 (id, length_at_birth, weight_at_birth, birth_weight_status, breastfeeding_initiation_date, bcg_date, hepa_b_bd_date, age_in_months_1, length_cm_1, date_taken_1, weight_kg_1, date_taken_2, sst_1, lbw_given_iron_1, lbw_given_iron_2, lbw_given_iron_3, dpt_hib_hepb_1st_dose_2, dpt_hib_hepb_2nd_dose_2, dpt_hib_hepb_3rd_dose_2, opb_1st_dose_2, opb_2nd_dose_2, opb_3rd_dose_2, pcb_1st_dose_2, pcb_2nd_dose_2, pcb_3rd_dose_2, ipv_3rd_dose_2, ebf_1_5_months_2, date_assessed_1_5_months_2, ebf_2_5_months_2, date_assessed_2_5_months_2, ebf_3_5_months_2, date_assessed_3_5_months_2, ebf_4_5_months_2, date_assessed_4_5_months_2,immu_id) 
        VALUES ('NULL', '$length_at_birth', '$weight_at_birth', '$birth_weight_status', '$breastfeeding_initiation_date', '$bcg_date', '$hepa_b_bd_date', '$age_in_months_1', '$length_cm_1', '$date_taken_1', '$weight_kg_1', '$date_taken_2', '$sst_1', '$lbw_given_iron_1', '$lbw_given_iron_2', '$lbw_given_iron_3', '$dpt_hib_hepb_1st_dose_2', '$dpt_hib_hepb_2nd_dose_2', '$dpt_hib_hepb_3rd_dose_2', '$opb_1st_dose_2', '$opb_2nd_dose_2', '$opb_3rd_dose_2', '$pcb_1st_dose_2', '$pcb_2nd_dose_2', '$pcb_3rd_dose_2', '$ipv_3rd_dose_2', '$ebf_1_5_months_2', '$date_assessed_1_5_months_2', '$ebf_2_5_months_2', '$date_assessed_2_5_months_2', '$ebf_3_5_months_2', '$date_assessed_3_5_months_2', '$ebf_4_5_months_2', '$date_assessed_4_5_months_2','$immuId')";

mysqli_query($conn,  $sql2);

$ebf_6_months = $_POST['ebf_6_months'];
$date_assessed_ebf_6_months = $_POST['date_assessed_ebf_6_months'];
$complementary_feeding_6_months = $_POST['complementary_feeding_6_months'];
$bfed_6_months = $_POST['bfed_6_months'];
$vitamin_a_date = $_POST['vitamin_a_date'];
$mnp_date = $_POST['mnp_date'];
$mmr_dose1_date = $_POST['mmr_dose1_date'];

$sql3 = "INSERT INTO immunization_3 (id,ebf_6_months, date_assessed_ebf_6_months, complementary_feeding_6_months, bfed_6_months, vitamin_a_date, mnp_date, mmr_dose1_date, immu_id) 
        VALUES (NULL,'$ebf_6_months', '$date_assessed_ebf_6_months', '$complementary_feeding_6_months', '$bfed_6_months', '$vitamin_a_date', '$mnp_date', '$mmr_dose1_date', $immuId)";

mysqli_query($conn, $sql3);
$age_in_months = $_POST['age_in_months'];
$length_cm = $_POST['length_cm'];
$date_taken_length = $_POST['date_taken_length'];
$weight_kg = $_POST['weight_kg'];
$date_taken_weight = $_POST['date_taken_weight'];
$status = $_POST['sst'];
$mmr_dose2_date = $_POST['mmr_dose2_date'];
$fic_date = $_POST['fic_date'];

$sql4 = "INSERT INTO immunization_4 (age_in_months, length_cm, date_taken_length, weight_kg, date_taken_weight, status, mmr_dose2_date, fic_date,immu_id)
        VALUES ('$age_in_months', '$length_cm', '$date_taken_length', '$weight_kg', '$date_taken_weight', '$status', '$mmr_dose2_date', '$fic_date', '$immuId')";

      mysqli_query($conn, $sql4);
      
  $cicDate = $_POST['cic_date'];
    $mamStatus = $_POST['mam_status'];
    $samStatus = $_POST['sam_status'];
    $remarks = $_POST['remarks'];

    // SQL to insert data into the table
    $sql5 = "INSERT INTO immunization_5 (cic_date, mam_status, sam_status,immu_id, remarks) VALUES ('$cicDate', '$mamStatus', '$samStatus','$immuId', '$remarks')";
    mysqli_query($conn, $sql5);
    header("Location:../services1.php?added=Success");
 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}



if(isset($_POST["add_nutrition"])){
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
    $mother_fname = $_POST['mother_fname'];
    $mother_mname = $_POST['mother_mname'];
    $mother_lname = $_POST['mother_lname'];
    $sql = "INSERT INTO nutrition (reg, bday, serial, se_status, sex, length, weight, fname, mname, lname, suffix, zone, brgy, city, province, mother_fname, mother_mname, mother_lname) 
        VALUES ('$date_of_registration', '$date_of_birth', '$serial_number', '$se_status', '$sex', '$length_cm', '$weight_kg', '$first_name', '$middle_name', '$last_name', '$suffix', '$zone', '$barangay', '$city_municipality', '$province', '$mother_fname', '$mother_mname', '$mother_lname')";

      if(mysqli_query($conn, $sql)){
        $nutID = mysqli_insert_id($conn);
        $nutritional_status = $_POST['nutritional_status'];
$mnp_date = $_POST['mnp_date'];
$vitamin_a_1st_dose_date = $_POST['vitamin_a_1st_dose_date'];
$vitamin_a_2nd_dose_date = $_POST['vitamin_a_2nd_dose_date'];
$deworming_1st_dose_date = $_POST['deworming_1st_dose_date'];
$deworming_2nd_dose_date = $_POST['deworming_2nd_dose_date'];
$deworming_yn = $_POST['deworming_yn'];
$sql1 = "INSERT INTO nutrition_1 (
    nutritional_status,
    mnp_date,
    vitamin_a_1st_dose_date,
    vitamin_a_2nd_dose_date,
    deworming_1st_dose_date,
    deworming_2nd_dose_date,
    deworming_yn,
    nutrition_id
) VALUES (
    '$nutritional_status',
    '$mnp_date',
    '$vitamin_a_1st_dose_date',
    '$vitamin_a_2nd_dose_date',
    '$deworming_1st_dose_date',
    '$deworming_2nd_dose_date',
    '$deworming_yn',
    '$nutID'
)";
   mysqli_query($conn, $sql1);
   $vitamin_a_1st_dose_date2 = $_POST['vitamin_a_1st_dose_date2'];
$vitamin_a_2nd_dose_date2 = $_POST['vitamin_a_2nd_dose_date2'];
$deworming_1st_dose_date2 = $_POST['deworming_1st_dose_date2'];
$deworming_2nd_dose_date2 = $_POST['deworming_2nd_dose_date2'];
$deworming_yn2 = $_POST['deworming_yn2'];
$ns2 =$_POST["nutritional_status2"];
$sql2 = "INSERT INTO nutrition_2 (nutrition_id, vitamin_a_1st_dose_date, vitamin_a_2nd_dose_date, deworming_1st_dose_date, deworming_2nd_dose_date, deworming_yn, nutritional_status2) 
        VALUES ('$nutID', '$vitamin_a_1st_dose_date2', '$vitamin_a_2nd_dose_date2', '$deworming_1st_dose_date2', '$deworming_2nd_dose_date2', '$deworming_yn2','$ns2')";
  mysqli_query($conn, $sql2);

  $vitamin_a_1st_dose_date3 = $_POST['vitamin_a_1st_dose_date3'];
$vitamin_a_2nd_dose_date3 = $_POST['vitamin_a_2nd_dose_date3'];
$deworming_1st_dose_date3 = $_POST['deworming_1st_dose_date3'];
$deworming_2nd_dose_date3 = $_POST['deworming_2nd_dose_date3'];
$deworming_yn3 = $_POST['deworming_yn3'];
$ns3 =$_POST["nutritional_status2"];

$sql3 = "INSERT INTO nutrition_3 (nutrition_id, vitamin_a_1st_dose_date, vitamin_a_2nd_dose_date, deworming_1st_dose_date, deworming_2nd_dose_date, deworming_yn,nutritional_status3) 
       VALUES ('$nutID', '$vitamin_a_1st_dose_date3', '$vitamin_a_2nd_dose_date3', '$deworming_1st_dose_date3', '$deworming_2nd_dose_date3', '$deworming_yn3','$ns3')";
 mysqli_query($conn, $sql3);

 $vitamin_a_1st_dose_date4 = $_POST['vitamin_a_1st_dose_date4'];
 $vitamin_a_2nd_dose_date4 = $_POST['vitamin_a_2nd_dose_date4'];
 $deworming_1st_dose_date4 = $_POST['deworming_1st_dose_date4'];
 $deworming_2nd_dose_date4 = $_POST['deworming_2nd_dose_date4'];
 $deworming_yn4 = $_POST['deworming_yn4'];
 $ns4 =$_POST["nutritional_status4"];
 $sql4 = "INSERT INTO nutrition_4 (nutrition_id, vitamin_a_1st_dose_date, vitamin_a_2nd_dose_date, deworming_1st_dose_date, deworming_2nd_dose_date, deworming_yn,nutritional_status4) 
       VALUES ('$nutID', '$vitamin_a_1st_dose_date4', '$vitamin_a_2nd_dose_date4', '$deworming_1st_dose_date4', '$deworming_2nd_dose_date4', '$deworming_yn4','$ns4')";
 mysqli_query($conn, $sql4);

 $mam5 = $_POST['mam5'];
 $sam5 = $_POST['sam5'];
 $remarks5 = $_POST['remarks5'];
 $sql5 = "INSERT INTO nutrition_5 (mam_status, sam_status, remarks, nutrition_id) 
        VALUES ('$mam5', '$sam5', '$remarks5', $nutID)";
 mysqli_query($conn, $sql5);
 header("Location:../services2.php?added=Success");
      }
}

if(isset($_POST["add_family"])){
    $date_of_registration = $_POST['date_of_registration'];
    $date_of_birth = $_POST['date_of_birth'];
    $family_serial_number = $_POST['family_serial_number'];
    $se_status = $_POST['se_status'];
    $type_of_client = $_POST['type_of_client'];
    $source = $_POST['source'];
    $previous_method = $_POST['previous_method'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $suffix = $_POST['suffix'];
    $zone = $_POST['zone'];
    $barangay = $_POST['barangay'];
    $city_municipality = $_POST['city_municipality'];
    $province = $_POST['province'];

    $sql = "INSERT INTO family_planning (date_of_registration, date_of_birth, family_serial_number, se_status, type_of_client, source, previous_method, first_name, middle_name, last_name, suffix, zone, barangay, city_municipality, province)
            VALUES ('$date_of_registration', '$date_of_birth', '$family_serial_number', '$se_status', '$type_of_client', '$source', '$previous_method', '$first_name', '$middle_name', '$last_name', '$suffix', '$zone', '$barangay', '$city_municipality', '$province')";

if(mysqli_query($conn, $sql)){
    $fid = mysqli_insert_id($conn);
    $scheduleDateJanuary = $_POST['schedule_date_january'];
    $actualDateJanuary = $_POST['actual_date_january'];
    $scheduleDateFebruary = $_POST['schedule_date_february'];
    $actualDateFebruary = $_POST['actual_date_february'];
    $scheduleDateMarch = $_POST['schedule_date_march'];
    $actualDateMarch = $_POST['actual_date_march'];
    $scheduleDateApril = $_POST['schedule_date_april'];
    $actualDateApril = $_POST['actual_date_april'];
    $scheduleDateMay = $_POST['schedule_date_may'];
    $actualDateMay = $_POST['actual_date_may'];
    $scheduleDateJune = $_POST['schedule_date_june'];
    $actualDateJune = $_POST['actual_date_june'];
    $scheduleDateJuly = $_POST['schedule_date_july'];
    $actualDateJuly = $_POST['actual_date_july'];
    $scheduleDateAugust = $_POST['schedule_date_august'];
    $actualDateAugust = $_POST['actual_date_august'];
    $scheduleDateSeptember = $_POST['schedule_date_september'];
    $actualDateSeptember = $_POST['actual_date_september'];
    $scheduleDateOctober = $_POST['schedule_date_october'];
    $actualDateOctober = $_POST['actual_date_october'];
    $scheduleDateNovember = $_POST['schedule_date_november'];
    $actualDateNovember = $_POST['actual_date_november'];
    $scheduleDateDecember = $_POST['schedule_date_december'];
    $actualDateDecember = $_POST['actual_date_december'];
$sql1 = "INSERT INTO family_planning_sched (
    schedule_date_january, actual_date_january,
    schedule_date_february, actual_date_february,
    schedule_date_march, actual_date_march,
    schedule_date_april, actual_date_april,
    schedule_date_may, actual_date_may,
    schedule_date_june, actual_date_june,
    schedule_date_july, actual_date_july,
    schedule_date_august, actual_date_august,
    schedule_date_september, actual_date_september,
    schedule_date_october, actual_date_october,
    schedule_date_november, actual_date_november,
    schedule_date_december, actual_date_december,
    family_id
) VALUES (
    '$scheduleDateJanuary', '$actualDateJanuary',
    '$scheduleDateFebruary', '$actualDateFebruary',
    '$scheduleDateMarch', '$actualDateMarch',
    '$scheduleDateApril', '$actualDateApril',
    '$scheduleDateMay', '$actualDateMay',
    '$scheduleDateJune', '$actualDateJune',
    '$scheduleDateJuly', '$actualDateJuly',
    '$scheduleDateAugust', '$actualDateAugust',
    '$scheduleDateSeptember', '$actualDateSeptember',
    '$scheduleDateOctober', '$actualDateOctober',
    '$scheduleDateNovember', '$actualDateNovember',
    '$scheduleDateDecember', '$actualDateDecember',
    '$fid'
)";
mysqli_query($conn, $sql1);
$reasons = $_POST["reason1"];
$reasonsDate = $_POST["reason_date"];
$dewormingDrugs1stDoseDate = $_POST["deworming_1st_dose_date"];
$dewormingDrugs2ndDoseDate = $_POST["deworming_2nd_dose_date"];
$dewormingDrugsYndwrm =  $_POST["deworming_yndwrm"];
$lamRemarks = $_POST["lam_remarks"];
$sql2 = "INSERT INTO family_plan_rem (reasons, reasons_date, deworming_drugs_1st_dose_date, deworming_drugs_2nd_dose_date, deworming_drugs_yndwrm, lam_remarks,family_id)
VALUES ('$reasons', '$reasonsDate', '$dewormingDrugs1stDoseDate', '$dewormingDrugs2ndDoseDate', '$dewormingDrugsYndwrm', '$lamRemarks','$fid')";
mysqli_query($conn, $sql2);
header("Location:../services3.php?added=Success");
}
    
}
if(isset($_POST["addinflu"])){
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $suffix = $_POST['suffix'];
    $zone = $_POST['zone'];
    $barangay = $_POST['barangay'];
    $city_municipality = $_POST['city_municipality'];
    $province = $_POST['province'];
    $vaccination_date = $_POST['vaccination_date'];
    $vaccination_site = $_POST['vaccination_site'];
    $date_of_birth = $_POST['date_of_birth'];
    $sql = "INSERT INTO influenza_vaccination (first_name, middle_name, last_name, suffix, zone, barangay, city_municipality, province, vaccination_date, vaccination_site, date_of_birth) VALUES ('$first_name', '$middle_name', '$last_name', '$suffix', '$zone', '$barangay', '$city_municipality', '$province', '$vaccination_date', '$vaccination_site', '$date_of_birth')";

    mysqli_query($conn, $sql);
    header("Location:../services4.php?added=Success");
}
if(isset($_POST["addAnti"])){
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $suffix = $_POST['suffix'];
    $zone = $_POST['zone'];
    $barangay = $_POST['barangay'];
    $city_municipality = $_POST['city_municipality'];
    $province = $_POST['province'];
    $vaccination_date = $_POST['vaccination_date'];
    $vaccination_site = $_POST['vaccination_site'];
    $date_of_birth = $_POST['date_of_birth'];
    $sql = "INSERT INTO anti_pneumonia  (first_name, middle_name, last_name, suffix, zone, barangay, city_municipality, province, vaccination_date, vaccination_site, date_of_birth) VALUES ('$first_name', '$middle_name', '$last_name', '$suffix', '$zone', '$barangay', '$city_municipality', '$province', '$vaccination_date', '$vaccination_site', '$date_of_birth')";
    mysqli_query($conn, $sql);
    header("Location:../services5.php?added=Success");
}
 ?>