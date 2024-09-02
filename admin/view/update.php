<?php
include "../dbcon.php";

/* Update Immunization */

if (isset($_POST["updateImmu"])) {
    $id = $_POST["updateImmu"];
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

    $sql = "UPDATE `immunization` SET
        `reg` = '$reg',
        `bday` = '$bday',
        `serial` = '$serial',
        `se_status` = '$se',
        `sex` = '$sex',
        `fname` = '$fname',
        `mname` = '$mname',
        `lname` = '$lname',
        `suffix` = '$suffix',
        `zone` = '$zone',
        `brgy` = '$bar',
        `mun` = '$city',
        `prov` = '$province',
        `cpab` = '$cpab',
        `mother_fname` = '$mother_fname',
        `mother_mname` = '$mother_mname',
        `mother_lname` = '$mother_lname'
    WHERE `id` = $id;";
   
    if (mysqli_query($conn, $sql)) {
        $length = $_POST["length_at_birth"];
        $weight = $_POST["weight_at_birth"];
        $bf = isset($_POST["birth_weight_status"]) ? $_POST["birth_weight_status"] : null;
        $bcgDate = $_POST["bcg_date"];
        $hepaBBDDate = $_POST["hepa_b_bd_date"];
        $bfm = $_POST["breastfeeding_initiation_date"];
        $sqlUpdateImm1 = "UPDATE `immunization_1` SET
            `length` = '$length',
            `weight` = '$weight',
            `bf` = '$bfm',
            `bcg` = '$bcgDate',
            `hepa` = '$hepaBBDDate',
            `bw` = '$bf'
        WHERE `immu_id` = $id;";
        mysqli_query($conn, $sqlUpdateImm1);

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
        $sqlUpdateImm2 = "UPDATE immunization_2 
            SET 
                `length_at_birth` = '$length_at_birth',
            `weight_at_birth` = '$weight_at_birth',
                `birth_weight_status` = '$birth_weight_status',
                `breastfeeding_initiation_date` = '$breastfeeding_initiation_date',
                `bcg_date` = '$bcg_date',
                `hepa_b_bd_date` = '$hepa_b_bd_date',
                `age_in_months_1` = '$age_in_months_1',
                `length_cm_1` = '$length_cm_1',
                `date_taken_1` = '$date_taken_1',
                `weight_kg_1` = '$weight_kg_1',
                `date_taken_2` = '$date_taken_2',
                `sst_1` = '$sst_1',
                `lbw_given_iron_1` = '$lbw_given_iron_1',
                `lbw_given_iron_2` = '$lbw_given_iron_2',
                `lbw_given_iron_3` = '$lbw_given_iron_3',
                `dpt_hib_hepb_1st_dose_2` = '$dpt_hib_hepb_1st_dose_2',
                `dpt_hib_hepb_2nd_dose_2` = '$dpt_hib_hepb_2nd_dose_2',
                `dpt_hib_hepb_3rd_dose_2` = '$dpt_hib_hepb_3rd_dose_2',
                `opb_1st_dose_2` = '$opb_1st_dose_2',
                `opb_2nd_dose_2` = '$opb_2nd_dose_2',
                `opb_3rd_dose_2` = '$opb_3rd_dose_2',
                `pcb_1st_dose_2` = '$pcb_1st_dose_2',
                `pcb_2nd_dose_2` = '$pcb_2nd_dose_2',
                `pcb_3rd_dose_2` = '$pcb_3rd_dose_2',
                `ipv_3rd_dose_2` = '$ipv_3rd_dose_2',
                `ebf_1_5_months_2` = '$ebf_1_5_months_2',
                `date_assessed_1_5_months_2` = '$date_assessed_1_5_months_2',
                `ebf_2_5_months_2` = '$ebf_2_5_months_2',
                `date_assessed_2_5_months_2` = '$date_assessed_2_5_months_2',
                `ebf_3_5_months_2` = '$ebf_3_5_months_2',
                `date_assessed_3_5_months_2` = '$date_assessed_3_5_months_2',
                `ebf_4_5_months_2` = '$ebf_4_5_months_2',
                `date_assessed_4_5_months_2` = '$date_assessed_4_5_months_2'
            WHERE `immu_id` = $id";
        mysqli_query($conn, $sqlUpdateImm2);

        $ebf_6_months = $_POST['ebf_6_months'];
        $date_assessed_ebf_6_months = $_POST['date_assessed_ebf_6_months'];
        $complementary_feeding_6_months = $_POST['complementary_feeding_6_months'];
        $bfed_6_months = $_POST['bfed_6_months'];
        $vitamin_a_date = $_POST['vitamin_a_date'];
        $mnp_date = $_POST['mnp_date'];
        $mmr_dose1_date = $_POST['mmr_dose1_date'];
        $sqlUpdateImm3 = "UPDATE immunization_3 
            SET 
                `ebf_6_months` = '$ebf_6_months',
                `date_assessed_ebf_6_months` = '$date_assessed_ebf_6_months',
                `complementary_feeding_6_months` = '$complementary_feeding_6_months',
                `bfed_6_months` = '$bfed_6_months',
                `vitamin_a_date` = '$vitamin_a_date',
                `mnp_date` = '$mnp_date',
                `mmr_dose1_date` = '$mmr_dose1_date'
            WHERE `immu_id` = $id";
        mysqli_query($conn, $sqlUpdateImm3);

        $age_in_months = $_POST['age_in_months'];
        $length_cm = $_POST['length_cm'];
        $date_taken_length = $_POST['date_taken_length'];
        $weight_kg = $_POST['weight_kg'];
        $date_taken_weight = $_POST['date_taken_weight'];
        $status = $_POST['sst'];
        $mmr_dose2_date = $_POST['mmr_dose2_date'];
        $fic_date = $_POST['fic_date'];
        $sqlUpdateImm4 = "UPDATE immunization_4 
            SET 
                `age_in_months` = '$age_in_months',
                `length_cm` = '$length_cm',
                `date_taken_length` = '$date_taken_length',
                `weight_kg` = '$weight_kg',
                `date_taken_weight` = '$date_taken_weight',
                `status` = '$status',
                `mmr_dose2_date` = '$mmr_dose2_date',
                `fic_date` = '$fic_date'
            WHERE `immu_id` = $id";
        mysqli_query($conn, $sqlUpdateImm4);
        
        $cicDate = $_POST['cic_date'];
        $mamStatus = $_POST['mam_status'];
        $samStatus = $_POST['sam_status'];
        $remarks = $_POST['remarks'];
        $sqlUpdateImm5 = "UPDATE immunization_5 
            SET 
            `cic_date` = '$cicDate',
            `mam_status` = '$mamStatus',
            `sam_status` = '$samStatus',
            `remarks` = '$remarks'
            WHERE `immu_id` = $id";
        mysqli_query($conn, $sqlUpdateImm5);

        header("Location:../services1.php?updated=Success");
 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>