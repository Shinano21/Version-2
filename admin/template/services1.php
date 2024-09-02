<?php 

include "../dbcon.php";

$selectedYear = isset($_GET['year']) ? intval($_GET['year']) : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table_style.css">
    <title>Print File</title>
    <!-- Include html2pdf.js library -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</head>

<body>
    <!-- Your HTML content to be converted to PDF -->
    <div id="contentsContainer">
        <?php include "header.php" ?>
        <div class="table-container" id="content">
            <center>
                <h3>PART 1. IMMUNIZATION AND NUTRITION SERVICES FOR INFANTS AGE 0-11 MONTHS & CHILDREN 12 MONTHS OLD
                    (1/4)
                </h3>
            </center>
            <table>
                <tr>
                    <th class="top-text" rowspan="2">No.</th>
                    <th class="top-text" rowspan="2">Date of Registration<br>(mm/dd/yy)</th>
                    <th class="top-text" rowspan="2">Date of Birth<br>(mm/dd/yy)</th>
                    <th class="top-text" rowspan="2">Family Serial Number</th>
                    <th class="top-text" rowspan="2">SE Status<br> 1. NHTS<br>2. Non-NHTS</th>
                    <th class="top-text" rowspan="2">Name of Child<br>(Family name, First name, Middle initial)</th>
                    <th class="top-text" rowspan="2">Sex<br>(M or F)</th>
                    <th class="top-text" rowspan="2">Complete name of Mother<br>(Family name, First name, Middle
                        initial)</th>
                    <th class="top-text" rowspan="2">Complete Address</th>
                    <th class="top-text" colspan="2">Child Protected at Birth<br>(CPAB)</th>
                </tr>
                <tr>
                    <th>TT2/Td2 given to<br>the mother a<br> month prior to <br>delivery (for mothers <br>pregnant for
                        the<br>first time)</th>
                    <th>TT3/Td3 to <br>TT5/Td5 (or<br>TT1/Td1 to<br>the mother<br>anytime prior to<br>delivery</th>
                </tr>
                <?php
                $sql = "SELECT * FROM immunization WHERE 1";

                if ($selectedYear !== null) {
                    $sql .= " AND YEAR(reg) = $selectedYear";
                }
                $sql .= " ORDER BY reg";

                $i = 1;
                $result = mysqli_query($conn, $sql);
                $even = 0;
                // Check if there are results
                if (mysqli_num_rows($result) > 0) {
                
                    while ($row = mysqli_fetch_assoc($result)) {
                        $orderdate = explode('-', $row["reg"]);
                        $year = $orderdate[0];
                        $month   = $orderdate[1];
                        $day = $orderdate[2];
                        $orderdate1 = explode('-', $row["bday"]);
                        $year1 = $orderdate[0];
                        $month1   = $orderdate[1];
                        $day1 = $orderdate[2];
                        echo "<tr>";
                        echo "<td>". $i ."</td>";
                        echo "<td>". $month . "-" . $day."-".$year."</td>";
                        echo "<td>".$month1 . "-" . $day1."-".$year1."</td>";
                        echo "<td>". $row["serial"] ."</td>";
                        echo "<td>". $row["se_status"] ."</td>";
                        echo "<td>". $row["lname"] .", ". $row["fname"]." ". substr($row["mname"], 0, 1)."</td>";
                        echo "<td>". $row["sex"] ."</td>";
                        echo "<td>". $row["mother_lname"] .", ". $row["mother_fname"]." ".  substr($row["mother_mname"], 0, 1)."</td>";
                        echo "<td>". $row["zone"] .", ". $row["brgy"] .", ". $row["mun"].", ".  $row["prov"]."</td>";
                        if($row["cpab"]=="TT2/Td2"){
                        echo "<td>". "&#x2713;"."</td>";
                        echo "<td>". " "  ."</td>";
                        }else if($row["cpab"]=="TT3/Td3"){
                            echo "<td>". " "."</td>";
                            echo "<td>". "&#x2713;"  ."</td>";
                        } else {
                            echo "<td>". " "."</td>";
                            echo "<td>". " "."</td>";
                        }
                        echo "</tr>";
                        $i++;
                    }
                }
                if($i<=15){
                    while($i!=15){
                    echo "<tr>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "</tr>";
                    $i++;
                    }
                }
                ?>

            </table>
        </div>
        <div class="table-container" id="content2">
            <center>
                <h3>PART 1. IMMUNIZATION AND NUTRITION SERVICES FOR INFANTS AGE 0-11 MONTHS & CHILDREN 12 MONTHS OLD
                    (2/4)
                </h3>
            </center>
            <table>
                <tr>
                    <th class="top-text" rowspan="3">No.</th>
                    <th colspan="6">Newborn (0-28 days old)<br>(10)</th>
                    <th colspan="7">1-3 months old<br>(11)</th>

                </tr>
                <tr>
                    <th class="top-text" rowspan="2">Length at<br>Birth<br>(cm)
                    </th>
                    <th class="top-text" rowspan="2">Weight at<br>Birth<br>(kg)
                    </th>
                    <th colspan="1">Status<br>(Birth Weight)</th>
                    <th class="top-text" rowspan="2">Initiated breast<br>feeding<br>immediately<br>after
                        birth<br>lasting for
                        90<br>minutes
                        <br>(Date)
                    </th>
                    <th colspan="2">Immunization</th>
                    <th colspan="4">Nutritional Status Assessment</th>
                    <th colspan="3">Low birth weight given iron <br>Write the date</th>
                </tr>
                <tr>
                    <td class="top-text" style="text-align: left;"><b>L:</b>low:
                        <2,500gms<br />
                        <b>N:</b>normal:>/2,500gms<br /><b>U:</b>unknown
                    </td>
                    <td class="top-text"><b>BCG</b><br>(Date)</td>
                    <td class="top-text"><b>Hepa B-BD</b><br>(Date)</td>
                    <th class="top-text">Age in Months</th>
                    <td class="top-text"><b>Length</b><br>(cm)<br><b>& Date Taken</td>
                    <td class="top-text"><b>Weight</b><br>(kg)<br><b>& Date Taken</td>
                    <td class="top-text"><b>Status</b><br><b>S:</b>stunted<br />
                        <b>W-MAM:</b>wasted-WAM<br /><b>W-SAM:</b>wasted-SAM<br /><b>O:</b>obese/overweight<br /><b>N:</b>normal
                    </td>
                    <th class="top-text">1 mo</th>
                    <th class="top-text">2 mos</th>
                    <th class="top-text">3 mos</th>
                </tr>

                <?php
                $sql = "SELECT immunization.*, immunization_2.*
                FROM immunization_2
                INNER JOIN immunization ON immu_id = immunization.id";
                $sql .= " WHERE 1";
                if ($selectedYear !== null) {
                    $sql .= " AND YEAR(immunization.reg) = $selectedYear";
                }
                $sql .= " ORDER BY immunization.reg";
                $i = 1;
                $result = mysqli_query($conn, $sql);
                $even = 0;
                // Check if there are results
                function convertDate($date){
                    $orderdate = explode('-', $date);
                    $year = $orderdate[0];
                    $month = $orderdate[1];
                    $day = $orderdate[2];

                    return "$month-$day-$year"; // Modified return statement
                }
                if (mysqli_num_rows($result) > 0) {
                
                    while ($row = mysqli_fetch_assoc($result)) {
                        $orderdate = explode('-', $row["breastfeeding_initiation_date"]);
                        $year = $orderdate[0];
                        $month   = $orderdate[1];
                        $day = $orderdate[2];
                        $orderdate1 = explode('-', $row["bcg_date"]);
                        $year1 = $orderdate[0];
                        $month1   = $orderdate[1];
                        $day1 = $orderdate[2];
                        $orderdate2 = explode('-', $row["hepa_b_bd_date"]);
                        $year2 = $orderdate[0];
                        $month2   = $orderdate[1];
                        $day2 = $orderdate[2];
                        echo "<tr>";
                        echo "<td>". $i ."</td>";
                        echo "<td>" . (is_numeric($row["length_at_birth"]) ? intval($row["length_at_birth"]) : $row["length_at_birth"]) . "</td>";
                        echo "<td>" . (is_numeric($row["weight_at_birth"]) ? intval($row["weight_at_birth"]) : $row["weight_at_birth"]) . "</td>";
                        echo "<td>". $row["birth_weight_status"] ."</td>";
                        if($row["breastfeeding_initiation_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>".$month . "-" . $day."-".$year."</td>";
                        }
                        if($row["bcg_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>".$month1 . "-" . $day1."-".$year1."</td>";
                        }
                        if($row["hepa_b_bd_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>".$month2 . "-" . $day2."-".$year2."</td>";
                        }
                        if($row["age_in_months_1"]=="0"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". $row["age_in_months_1"] ."</td>";
                        }
                        if($row["length_cm_1"]=="0.00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . $row["length_cm_1"] . " <hr class='broken-line'> " . convertDate($row["date_taken_1"]) . "</td>";
                        }
                        if($row["weight_kg_1"]=="0.00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . $row["weight_kg_1"] . " <hr class='broken-line'> " . convertDate($row["date_taken_2"]) . "</td>";
                        }
                        echo "<td>". $row["sst_1"] ."</td>";
                        if($row["lbw_given_iron_1"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["lbw_given_iron_1"]) . "</td>";
                        }
                        if($row["lbw_given_iron_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["lbw_given_iron_2"]) . "</td>";
                        }
                        if($row["lbw_given_iron_3"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["lbw_given_iron_3"]) . "</td>";
                        }
                        echo "</tr>";
                        $i++;
                    }
                }
                if($i<=15){
                    while($i!=15){
                    echo "<tr>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "</tr>";
                    $i++;
                    }
                }
                ?>
            </table>
        </div>
        <div class="table-container" id="content3">
            <center>
                <h3>PART 1. IMMUNIZATION AND NUTRITION SERVICES FOR INFANTS AGE 0-11 MONTHS & CHILDREN 12 MONTHS OLD
                    (3/4)
                </h3>
            </center>
            <table>
                <tr>
                    <th class="top-text" rowspan="4">No.</th>
                    <th colspan="14">1-3 months old<br>(11)</th>
                    <th colspan="4">6-12 months old<br>(12)</th>

                </tr>
                <tr>
                    <th rowspan="1" colspan="6">Immunization<br>(Write the date)</th>
                    <th rowspan="1" colspan="4">Immunization<br>(Write the date)</th>
                    <td class="long" rowspan="2" colspan="4"><b>Exclusive Breastfeeding*</b><br>During the following
                        immunization
                        visits
                        of the child
                        at 1<br>1/2, 2 1/2, and 3 1/2 months old (or at 4-5 mos.), ask the<br>mother if the child
                        continues
                        to be exclusively<br>breastfed. Write <b>Y</b> if still EBF or <b>N</b> if no longer EBF<br>then
                        <b>write the date</b> below when the infant was<br>assessed.
                    </td>
                    <th rowspan="1" colspan="4">Nutritional Status Assessment</th>
                </tr>
                <tr>
                    <th class="top-text" rowspan="1" colspan="3">DPT-HiB-HepB</th>
                    <th class="top-text" rowspan="1" colspan="3">OPV</th>
                    <th class="top-text" rowspan="1" colspan="3">PCV</th>
                    <th class="top-text" rowspan="1" colspan="1">IPV</th>

                    <th class="top-text" rowspan="2">Age in months</th>
                    <td class="top-text" rowspan="2"><b>Length</b><br>(cm)<br><b>& Date Taken</b></td>
                    <td class="top-text" rowspan="2"><b>Weight</b><br>(kg)<br><b>& Date Taken</b></td>
                    <td class="top-text" rowspan="2"><b>Status</b><br><b>S:</b>stunted<br />
                        <b>W-MAM:</b>wasted-WAM<br /><b>W-SAM:</b>wasted-SAM<br /><b>O:</b>obese/overweight<br /><b>N:</b>normal
                    </td>
                </tr>
                <tr>
                    <td><b>1st dose</b><br>1 1/2 mos</td>
                    <td><b>2nt dose</b><br>2 1/2 mos</td>
                    <td><b>3rd dose</b><br>3 1/2 mos</td>
                    <td><b>1st dose</b><br>1 1/2 mos</td>
                    <td><b>2nt dose</b><br>2 1/2 mos</td>
                    <td><b>3rd dose</b><br>3 1/2 mos</td>
                    <td><b>1st dose</b><br>1 1/2 mos</td>
                    <td><b>2nt dose</b><br>2 1/2 mos</td>
                    <td><b>3rd dose</b><br>3 1/2 mos</td>
                    <td><b>3 1/2 mos</b></td>
                    <th rowspan="1">1 1/2 mos.</th>
                    <th rowspan="1">2 1/2 mos.</th>
                    <th rowspan="1">3 1/2 mos.</th>
                    <th rowspan="1">4-5 mos.</th>
                </tr>
                <?php
                $sql = "SELECT *
                        FROM immunization_2
                        INNER JOIN immunization_4 ON immunization_2.immu_id = immunization_4.immu_id
                        INNER JOIN immunization ON immunization_2.immu_id = immunization.id";
                $sql .= " WHERE 1";
                if ($selectedYear !== null) {
                    $sql .= " AND YEAR(immunization.reg) = $selectedYear";
                }
                $sql .= " ORDER BY immunization.reg";

                $i = 1;
                $result = mysqli_query($conn, $sql);
                $even = 0;
                // Check if there are results

                if (mysqli_num_rows($result) > 0) {
                
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $i ."</td>";
                        if($row["dpt_hib_hepb_1st_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["dpt_hib_hepb_1st_dose_2"]) . "</td>";
                        }
                        if($row["dpt_hib_hepb_2nd_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["dpt_hib_hepb_2nd_dose_2"]) . "</td>";
                        }
                        if($row["dpt_hib_hepb_3rd_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["dpt_hib_hepb_3rd_dose_2"]) . "</td>";
                        }
                        if($row["opb_1st_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["opb_1st_dose_2"]) . "</td>";
                        }
                        if($row["opb_2nd_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["opb_2nd_dose_2"]) . "</td>";
                        }
                        if($row["opb_3rd_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["opb_3rd_dose_2"]) . "</td>";
                        }
                        if($row["pcb_1st_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["pcb_1st_dose_2"]) . "</td>";
                        }
                        if($row["pcb_2nd_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["pcb_2nd_dose_2"]) . "</td>";
                        }
                        if($row["pcb_3rd_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["pcb_3rd_dose_2"]) . "</td>";
                        }
                        if($row["ipv_3rd_dose_2"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["ipv_3rd_dose_2"]) . "</td>";
                        }
                        if($row["ebf_1_5_months_2"]==null){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . $row["ebf_1_5_months_2"] . " <hr class='broken-line'> " . convertDate($row["date_assessed_1_5_months_2"]) . "</td>";
                        }
                        if($row["ebf_2_5_months_2"]==null){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . $row["ebf_2_5_months_2"] . " <hr class='broken-line'> " . convertDate($row["date_assessed_2_5_months_2"]) . "</td>";
                        }
                        if($row["ebf_3_5_months_2"]==null){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . $row["ebf_3_5_months_2"] . " <hr class='broken-line'> " . convertDate($row["date_assessed_3_5_months_2"]) . "</td>";
                        }
                        if($row["ebf_4_5_months_2"]==null){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . $row["ebf_4_5_months_2"] . " <hr class='broken-line'> " . convertDate($row["date_assessed_4_5_months_2"]) . "</td>";
                        }
                        if($row["age_in_months"]=="0"){
                            echo "<td>". " " ."</td>";
                        }else {
                            echo "<td>". $row["age_in_months"] ."</td>";
                        }
                        if($row["length_cm"]=="0"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . $row["length_cm"] . " <hr class='broken-line'> " . convertDate($row["date_taken_length"]) . "</td>";
                        }
                        if($row["weight_kg"]=="0"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . $row["weight_kg"] . " <hr class='broken-line'> " . convertDate($row["date_taken_weight"]) . "</td>";
                        }
                        echo "<td>". $row["status"] ."</td>";
                        echo "</tr>";
                        $i++;
                    }
                }
                if($i<=15){
                    while($i!=15){
                    echo "<tr>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "</tr>";
                    $i++;
                    }
                }
                ?>
            </table>
        </div>
        <div class="table-container" id="content3">
            <center>
                <h3>PART 1. IMMUNIZATION AND NUTRITION SERVICES FOR INFANTS AGE 0-11 MONTHS & CHILDREN 12 MONTHS OLD
                    (4/4)
                </h3>
            </center>
            <table>
                <tr>
                    <th class="top-text" rowspan="3">No.</th>
                    <th colspan="6">6-12 months old<br>(12)</th>
                    <th colspan="6">12 months old<br>(13)</th>
                    <th class="top-text" rowspan="3">CIC<br>(Date)<br>(14)</th>
                    <th colspan="8">0-11 months old<br>(15)</th>
                    <th class="top-text" rowspan="3">Remarks<br>(16)</th>
                </tr>
                <tr>
                    <td class="top-text long" rowspan="2"><b>Exclusively</b><br><b>Breastfed* up</b><br><b>to 6
                            months</b><br>Write <b>Y</b>
                        if Yes or<br><b>N</b> if No; then<br>write the date<br>below when the<br>infant was<br>assessed.
                    </td>
                    <th colspan="2">Introduction of<br>Complementary Feeding** at<br>6 months old</th>
                    <th style="vertical-align: top;" rowspan="2">Vitamin A<br>(Date<br>Given)</th>
                    <th style="vertical-align: top;" rowspan="2">MNP<br>(Date<br>when 90<br>sachets<br>given)</th>
                    <th style="vertical-align: top;" rowspan="2">MMR<br>Dose 1 at<br>9th<br>month<br>(Date<br>Given)
                    </th>
                    <th colspan="4">Nutritional Status Assessment</th>
                    <th class="top-text" rowspan="2">MMR<br>Dose 2 at<br>12th<br>month<br>(Date<br>Given)</th>
                    <th class="top-text" rowspan="2">FIC<br>(Date)</th>
                    <th style="width: 13.39%;" colspan="4">MAM</th>
                    <th style="width: 13.39%;" colspan="4">SAM Without Complication</th>

                </tr>
                <tr>
                    <td style="vertical-align: top;"><b>Y</b> or <b>N</b></td>
                    <td style="vertical-align: top;"><b>1 - </b>With
                        continuous<br>breastfeeding<br><b>2 - </b>no longer<br>breastfeeding or<br>never
                        breastfed
                    </td>
                    <th style="vertical-align: top;">Age in<br>months</th>
                    <td style="vertical-align: top;"><b>Length</b><br>(cm)<br><b>& Date<br>Taken</b></td>
                    <td style="vertical-align: top;"><b>Weight</b><br>(kg)<br><b>& Date<br>Taken</b></td>
                    <td><b>Status</b><br><b>S:</b>stunted<br />
                        <b>W-MAM:</b><br>wasted-WAM<br><b>W-SAM:</b><br>wasted-SAM<br><b>O:</b>obese/<br>overweight<br><b>N:</b>normal
                    </td>
                    <th class="vertical-text">Admitted to SFP</th>
                    <th class="vertical-text">Cured</th>
                    <th class="vertical-text">Defaulted</th>
                    <th class="vertical-text">Died</th>
                    <th class="vertical-text">Admitted to OTC</th>
                    <th class="vertical-text">Cured</th>
                    <th class="vertical-text">Defaulted</th>
                    <th class="vertical-text">Died</th>
                </tr>


                <?php
                $sql = "SELECT *
                        FROM immunization_3
                        INNER JOIN immunization_5 ON immunization_3.immu_id = immunization_5.immu_id
                        INNER JOIN immunization_4 ON immunization_3.immu_id = immunization_4.immu_id
                        INNER JOIN immunization ON immunization_3.immu_id = immunization.id";
                $sql .= " WHERE 1";
                if ($selectedYear !== null) {
                    $sql .= " AND YEAR(immunization.reg) = $selectedYear";
                }
                $sql .= " ORDER BY immunization.reg";
                $i = 1;
                $result = mysqli_query($conn, $sql);
                $even = 0;
                // Check if there are results
                function check1($data){
                    if ($data == "Admitted in SFP"){
                        echo "<td>". "&#x2713;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                    } else if ($data == "Cured"){
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&#x2713;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                    }else if ($data == "Defaulted"){
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&#x2713;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                    } else if ($data == "Died"){
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&#x2713;" ."</td>";
                    } else {
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                    }
                }
                function check2($data){
                    if ($data == "Admitted in SFP"){
                        echo "<td>". "&#x2713;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                    } else if ($data == "Cured"){
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&#x2713;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                    } else if ($data == "Defaulted"){
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&#x2713;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                    } else if ($data == "Died"){
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&#x2713;" ."</td>";
                    } else {
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                        echo "<td>". "&nbsp;" ."</td>";
                    }
                }
                if (mysqli_num_rows($result) > 0) {
                
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $i ."</td>";
                        if($row["ebf_6_months"]==null){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . $row["ebf_6_months"] . " <hr class='broken-line'> " . convertDate($row["date_assessed_ebf_6_months"]) . "</td>";
                        }
                        echo "<td>". $row["complementary_feeding_6_months"] ."</td>";
                        if($row["bfed_6_months"]=="0"){
                            echo "<td>" . " " . "</td>";
                        }else {
                            echo "<td>". $row["bfed_6_months"] ."</td>";
                        }
                        if($row["vitamin_a_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["vitamin_a_date"]) ."</td>";
                        }
                        if($row["mnp_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["mnp_date"]) ."</td>";
                        }
                        if($row["mmr_dose1_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["mmr_dose1_date"]) ."</td>";
                        }
                        if($row["age_in_months"]=="0"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". $row["age_in_months"] ."</td>";
                        }
                        if($row["length_cm"]=="0"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>" . $row["length_cm"] . " <hr class='broken-line'> " . convertDate($row["date_taken_length"]) . "</td>";
                        }
                        if($row["weight_kg"]=="0"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>" . $row["weight_kg"] . " <hr class='broken-line'> " . convertDate($row["date_taken_weight"]) . "</td>";
                        }
                        echo "<td>". $row["status"] ."</td>";
                        if($row["mmr_dose2_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["mmr_dose2_date"]) ."</td>";
                        }if($row["fic_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["fic_date"]) ."</td>";
                        }if($row["cic_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["cic_date"]) ."</td>";
                        }
                        check1($row["mam_status"]);
                        check2($row["sam_status"]);
                        echo "<td>". $row["remarks"] ."</td>";
                        echo "</tr>";
                        $i++;
                    }
                }
                if($i<=15){
                    while($i!=15){
                    echo "<tr>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "</tr>";
                    $i++;
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <style>
    table {
        width: 100%;
        text-align: center;
    }

    .vertical-text {
        /* Rotate the text */
        writing-mode: vertical-rl;
        /* Vertical writing mode from right to left */
        transform: rotate(180deg);
        /* Rotate the text to stand upright */
        white-space: nowrap;
        /* Prevent text from wrapping */
    }

    .broken-line {
        border: 1.3px dashed #000;
        width: 100%;
        margin: 0px;
    }

    table,
    th,
    tr,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    </style>
    <script>
    function printContent(mode) {
        var headerElement = document.querySelector('.header');

        if (headerElement) {
            headerElement.classList.add('hide-on-print');
            if (mode === 'landscape') {
                var style = document.createElement('style');
                style.innerHTML = `
                @media print {
                    @page {
                        size: landscape;
                    }
                    /* Additional styles to fit content within the page */
                    body {
                        width: 100%;
                    }
                    table {
                        width: 100%;
                        /* Adjust other table styles if needed */
                    }
                    /* Add similar adjustments for other elements as needed */
                }
            `;
                document.head.appendChild(style);
            }
            window.print();

            headerElement.classList.remove('hide-on-print'); // Show the header after printing
        } else {
            console.error('Header element not found');
        }
    }
    </script>
</body>

</html>