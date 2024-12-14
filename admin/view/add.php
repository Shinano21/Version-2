<?php
include "../dbcon.php";
if(isset($_POST["addimu"])){
    $id = $_POST["addimu"];
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
    $query = "DELETE FROM `immunization` WHERE `id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `immunization_1` WHERE `immu_id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `immunization_2` WHERE `immu_id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `immunization_3` WHERE `immu_id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `immunization_4` WHERE `immu_id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `immunization_5` WHERE `immu_id` = $id";   
    $conn->query($query);
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
    header("Location:../services1.php?updated=Success");
 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}



if(isset($_POST["add_nutrition"])){
    $id = $_POST["add_nutrition"];
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
    $query = "DELETE FROM `nutrition` WHERE `id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `nutrition_1` WHERE `nutrition_id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `nutrition_2` WHERE `nutrition_id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `nutrition_3` WHERE `nutrition_id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `nutrition_4` WHERE `nutrition_id` = $id";
    $conn->query($query);
    $query = "DELETE FROM `nutrition_5` WHERE `nutrition_id` = $id";   
    $conn->query($query);
    $mother_fname = $_POST["mother_fname"];
    $mother_mname = $_POST["mother_mname"];
    $mother_lname = $_POST["mother_lname"];
    $sql = "INSERT INTO nutrition (id,reg, bday, serial, se_status, sex, length, weight, fname, mname, lname, suffix, zone, brgy, city, province, mother_fname, mother_mname, mother_lname) 
        VALUES ('$id','$date_of_registration', '$date_of_birth', '$serial_number', '$se_status', '$sex', '$length_cm', '$weight_kg', '$first_name', '$middle_name', '$last_name', '$suffix', '$zone', '$barangay', '$city_municipality', '$province', '$mother_fname', '$mother_mname', '$mother_lname')";

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
 header("Location:../services2.php?updated=Success");
      }
}

if (isset($_POST["add_family"])) { // Use 'update_family' to differentiate
    // Retrieve form data
    $idx = $_POST["add_family"]; // ID of the family record
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

    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Update the main family planning record
        $sql = "UPDATE family_planning 
                SET date_of_registration = ?, 
                    date_of_birth = ?, 
                    family_serial_number = ?, 
                    se_status = ?, 
                    type_of_client = ?, 
                    source = ?, 
                    previous_method = ?, 
                    first_name = ?, 
                    middle_name = ?, 
                    last_name = ?, 
                    suffix = ?, 
                    zone = ?, 
                    barangay = ?, 
                    city_municipality = ?, 
                    province = ?
                WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            'sssssssssssssssi',
            $date_of_registration,
            $date_of_birth,
            $family_serial_number,
            $se_status,
            $type_of_client,
            $source,
            $previous_method,
            $first_name,
            $middle_name,
            $last_name,
            $suffix,
            $zone,
            $barangay,
            $city_municipality,
            $province,
            $idx
        );
        mysqli_stmt_execute($stmt);

        // Update family planning schedule
        $scheduleDates = [
            'schedule_date_january' => $_POST['schedule_date_january'],
            'actual_date_january' => $_POST['actual_date_january'],
            'schedule_date_february' => $_POST['schedule_date_february'],
            'actual_date_february' => $_POST['actual_date_february'],
            'schedule_date_march' => $_POST['schedule_date_march'],
            'actual_date_march' => $_POST['actual_date_march'],
            'schedule_date_april' => $_POST['schedule_date_april'],
            'actual_date_april' => $_POST['actual_date_april'],
            'schedule_date_may' => $_POST['schedule_date_may'],
            'actual_date_may' => $_POST['actual_date_may'],
            'schedule_date_june' => $_POST['schedule_date_june'],
            'actual_date_june' => $_POST['actual_date_june'],
            'schedule_date_july' => $_POST['schedule_date_july'],
            'actual_date_july' => $_POST['actual_date_july'],
            'schedule_date_august' => $_POST['schedule_date_august'],
            'actual_date_august' => $_POST['actual_date_august'],
            'schedule_date_september' => $_POST['schedule_date_september'],
            'actual_date_september' => $_POST['actual_date_september'],
            'schedule_date_october' => $_POST['schedule_date_october'],
            'actual_date_october' => $_POST['actual_date_october'],
            'schedule_date_november' => $_POST['schedule_date_november'],
            'actual_date_november' => $_POST['actual_date_november'],
            'schedule_date_december' => $_POST['schedule_date_december'],
            'actual_date_december' => $_POST['actual_date_december']
        ];

        // Prepare statement for family planning schedule update
$sql_sched = "UPDATE family_planning_sched 
SET schedule_date_january = ?, actual_date_january = ?,
    schedule_date_february = ?, actual_date_february = ?,
    schedule_date_march = ?, actual_date_march = ?,
    schedule_date_april = ?, actual_date_april = ?,
    schedule_date_may = ?, actual_date_may = ?,
    schedule_date_june = ?, actual_date_june = ?,
    schedule_date_july = ?, actual_date_july = ?,
    schedule_date_august = ?, actual_date_august = ?,
    schedule_date_september = ?, actual_date_september = ?,
    schedule_date_october = ?, actual_date_october = ?,
    schedule_date_november = ?, actual_date_november = ?,
    schedule_date_december = ?, actual_date_december = ?
WHERE family_id = ?";
$stmt_sched = mysqli_prepare($conn, $sql_sched);

// Create array of schedule values
$params = array_merge(array_values($scheduleDates), [$idx]);

// Bind parameters dynamically
mysqli_stmt_bind_param(
$stmt_sched,
str_repeat('s', count($scheduleDates)) . 'i', // 24 strings + 1 integer
...$params
);

// Execute the statement
mysqli_stmt_execute($stmt_sched);


        // Update family plan remarks
        $reasons = $_POST["reason1"];
        $reasonsDate = $_POST["reason_date"];
        $dewormingDrugs1stDoseDate = $_POST["deworming_1st_dose_date"];
        $dewormingDrugs2ndDoseDate = $_POST["deworming_2nd_dose_date"];
        $dewormingDrugsYndwrm = $_POST["deworming_yndwrm"];
        $lamRemarks = $_POST["lam_remarks"];

        $sql_rem = "UPDATE family_plan_rem 
                    SET reasons = ?, 
                        reasons_date = ?, 
                        deworming_drugs_1st_dose_date = ?, 
                        deworming_drugs_2nd_dose_date = ?, 
                        deworming_drugs_yndwrm = ?, 
                        lam_remarks = ?
                    WHERE family_id = ?";
        $stmt_rem = mysqli_prepare($conn, $sql_rem);
        mysqli_stmt_bind_param(
            $stmt_rem,
            'ssssssi',
            $reasons,
            $reasonsDate,
            $dewormingDrugs1stDoseDate,
            $dewormingDrugs2ndDoseDate,
            $dewormingDrugsYndwrm,
            $lamRemarks,
            $idx
        );
        mysqli_stmt_execute($stmt_rem);

        // Commit transaction
        mysqli_commit($conn);

        // Redirect to success page
        header("Location: ../services3.php?updated=Success");
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);

        // Log and display error
        error_log("Error updating family record: " . $e->getMessage());
        echo "Error updating family record. Please try again.";
    }
}
    

if(isset($_POST["addinflu"])){
    $idx = $_POST["addinflu"];
    $sql = "DELETE FROM influenza_vaccination WHERE id = '$idx'";
    mysqli_query($conn, $sql);
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
    $sql = "INSERT INTO influenza_vaccination (id,first_name, middle_name, last_name, suffix, zone, barangay, city_municipality, province, vaccination_date, vaccination_site, date_of_birth) VALUES ('$idx','$first_name', '$middle_name', '$last_name', '$suffix', '$zone', '$barangay', '$city_municipality', '$province', '$vaccination_date', '$vaccination_site', '$date_of_birth')";

    mysqli_query($conn, $sql);
    header("Location:../services4.php?updated=Success");
}
if(isset($_POST["addAnti"])){
    $idx = $_POST["addAnti"];
    $sql = "DELETE FROM anti_pneumonia WHERE id = '$idx'";
    mysqli_query($conn, $sql);

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
    $sql = "INSERT INTO anti_pneumonia  (id,first_name, middle_name, last_name, suffix, zone, barangay, city_municipality, province, vaccination_date, vaccination_site, date_of_birth) VALUES ('$idx','$first_name', '$middle_name', '$last_name', '$suffix', '$zone', '$barangay', '$city_municipality', '$province', '$vaccination_date', '$vaccination_site', '$date_of_birth')";
    mysqli_query($conn, $sql);
    header("Location:../services5.php?updated=Success");
}
 ?>