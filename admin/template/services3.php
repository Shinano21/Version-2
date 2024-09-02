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
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</head>

<body>
    <!-- Your HTML content to be converted to PDF -->
    <div id="contentsContainer">
        <?php include "header.php" ?>
        <div class="table-container">
            <center>
                <h3>TARGET CLIENT LIST FOR FAMILY PLANNING SERVICES
                    (1/2)
                </h3>
            </center>
            <table>
                <tr>
                    <th rowspan="1" colspan="1" style="vertical-align: middle;">No.</th>
                    <td rowspan="1" colspan="1" style="vertical-align: top;"><b>Date of
                            Registration</b><br>(mm/dd/yy)<br>(1)</td>
                    <td rowspan="1" colspan="1" style="vertical-align: top;"><b>Family Serial No.</b><br>(2)</td>
                    <td rowspan="1" colspan="1" style="vertical-align: top;">
                        <b>Complete Name</b><br>(Family Name, First Name, Middle Name)<br>(3)
                    </td>
                    <td rowspan="1" colspan="1" style="vertical-align: top;"><b>Complete Address</b><br>(4)</td>
                    <td rowspan="1" colspan="1" style="vertical-align: top;"><b>Age/Date of<br>Birth</b><br>(5)</td>
                    <td rowspan="1" colspan="1" style="vertical-align: top;">
                        <b>SE<br>Status</b><br><b>1:</b>NHTS<br><b>2:</b>Non-<br>NHTS<br>(6)
                    </td>
                    <td rowspan="1" colspan="1" style="vertical-align: top;"><b>Type of<br>Client*</b><br>(7)</td>
                    <td rowspan="1" colspan="1" style="vertical-align: top;"><b>Source**</b><br>(8)</td>
                    <td rowspan="1" colspan="1" style="vertical-align: top;"><b>Previous Method***</b><br>(9)</td>
                </tr>
                <?php
                    $sql = "SELECT * FROM family_planning WHERE 1";

                    if ($selectedYear !== null) {
                        $sql .= " AND YEAR(date_of_registration) = $selectedYear";
                    }
                    $sql .= " ORDER BY date_of_registration";
                    $i = 1;

                    function age($birthdate)
                    {
                        $today = new DateTime();
                        $birthdate = new DateTime($birthdate);
                        $diff = $today->diff($birthdate);
                        return $diff->format('%y');
                    }                    

                    function convertDate($date)
                    {
                        $orderdate = explode('-', $date);
                        $year = $orderdate[0];
                        $month = $orderdate[1];
                        $day = $orderdate[2];

                        return "$month-$day-$year"; // Modified return statement
                    }

                    $result = mysqli_query($conn, $sql);
                    $even = 0;

                    // Check if there are results
                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . convertDate($row["date_of_registration"]) . "</td>";
                            echo "<td>" . $row["family_serial_number"] . "</td>";
                            echo "<td>" . $row["last_name"] . ", " . $row["first_name"] . " " . $row["middle_name"] . " " . $row["suffix"] . "</td>";
                            echo "<td>" . $row["zone"] . ", " . $row["barangay"] . ", " . $row["city_municipality"] . ", " . $row["province"] . "</td>";
                            echo "<td>" . age($row["date_of_birth"]) . " / " . convertDate($row["date_of_birth"]) . "</td>";
                            echo "<td>" . $row["se_status"] . "</td>";
                            echo "<td>" . $row["type_of_client"] . "</td>";
                            echo "<td>" . $row["source"] . "</td>";
                            echo "<td>" . $row["previous_method"] . "</td>";
                            echo "</tr>";
                            $i++;
                        }
                    }

                    if ($i <= 15) {
                        while ($i != 15) {
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
            <div id="legends">
                <div id="clientType">
                    <b>*Type of Client</b>
                    <p><b>NA: </b>New Acceptors</p>
                    <p><b>CU: </b>Current Users</p>
                    <p><b>OA: </b>Other Acceptors</p>
                    <p><b>CU-CM: </b>Changing Method</p>
                    <p><b>CU-CC: </b>Changing Clinic</p>
                    <p><b>CU-RS: </b>Restarter</p>
                </div>
                <div>
                    <b>**Source</b>
                    <p>Public</p>
                    <p>Private</p>
                </div>
                <div>
                    <b>***Previous Method</b>
                    <p><b>FSTR/BTL: </b>Female Sterilization/Bilateral tubal ligation</p>
                    <p><b>MSTR/NSV: </b>Male Sterilization/No-Scalep Vasectomy</p>
                    <p><b>CON: </b>Condom</p>
                    <p><b>Pills-POP: </b>Progestin Only Pills</p>
                    <p><b>Pills-COC: </b>Combined Oral Contraceptives</p>
                    <p><b>INJ: </b>DMPA or CIC</p>
                    <p><b>IMP: </b>Single rod sub-thermal Implant</p>
                    <p><b>IUD-I: </b>IUD Interval</p>
                    <p><b>IUD-PP</b>IUD Postpartum</p>
                </div>
                <div>
                    <p><b>NFP-LAM: </b>Lactational Amenorrhea Method</p>
                    <p><b>NFP-BBT: </b>Basal Body Temperature</p>
                    <p><b>NFP-CMM: </b>Cervical Mucus Method</p>
                    <p><b>NFP-STM: </b>Symptothermal Method</p>
                    <p><b>NFP-SDM: </b>Standard Days Method</p>
                    <p><b>None </b>or <b>New Acceptor</b></p>
                </div>
            </div>
        </div>

        <div class="table-container">
            <center>
                <h3>TARGET CLIENT LIST FOR FAMILY PLANNING SERVICES
                    (2/2)
                </h3>
            </center>
            <table>
                <tr>
                    <th rowspan="2" style="vertical-align: top;">No.</th>
                    <td colspan="12"><b>FOLLOW-UP VISITS<br>(Upper Space: Schedule Date of next visit / Lower Space:
                            Actual
                            Date of Visit)</b><br>(10)</td>
                    <td colspan="2" style="vertical-align: top;"><b>DROP-OUT</b><br>(11)</td>
                    <td rowspan="2" style="vertical-align: top;"><b>Remarks/<br>Actions Taken</b><br>(12)</td>
                    <td colspan="3" style="vertical-align: top;"><b>Deworming Drugs Given to 20-49 years<br>old
                            WRA</b><br>(13)</td>
                </tr>
                <tr>
                    <th colspan="1">Jan</th>
                    <th colspan="1">Feb</th>
                    <th colspan="1">Mar</th>
                    <th colspan="1">Apr</th>
                    <th colspan="1">May</th>
                    <th colspan="1">Jun</th>
                    <th colspan="1">Jul</th>
                    <th colspan="1">Aug</th>
                    <th colspan="1">Sept</th>
                    <th colspan="1">Oct</th>
                    <th colspan="1">Nov</th>
                    <th colspan="1">Dec</th>
                    <th colspan="1" style="width: 5.56%;">Date</th>
                    <th colspan="1" style="width: 5.56%;">Reason***</th>
                    <th colspan="1">Date 1st dose<br>given</th>
                    <th colspan="1">Date 2nd dose<br>given</th>
                    <td colspan="1"><b>Status<br>check</b>(&#x2713;) if<br>given 2 doses</td>
                </tr>
                
                <?php
                $sql = "SELECT * FROM family_planning_sched 
                INNER JOIN family_plan_rem ON family_planning_sched.family_id = family_plan_rem.family_id
                INNER JOIN family_planning ON family_planning_sched.family_id = family_planning.id";
                if ($selectedYear !== null) {
                    $sql .= " AND YEAR(date_of_registration) = $selectedYear";
                }
                $sql .= " ORDER BY family_planning.date_of_registration";

                $i = 1;

                function status($data){
                    if ($data == "Yes"){
                        echo "<td>&#x2713;</td>";  
                    }
                }

                $result = mysqli_query($conn, $sql);
                $even = 0;
                // Check if there are results
                if (mysqli_num_rows($result) > 0) {
                
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr>";
                        echo "<td>". $i ."</td>";
                        if($row["schedule_date_january"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_january"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_january"]) . "</td>";
                        }        
                        if($row["schedule_date_february"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_february"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_february"]) . "</td>";
                        } 
                        if($row["schedule_date_march"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_march"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_march"]) . "</td>";
                        }
                        if($row["schedule_date_april"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_april"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_april"]) . "</td>";
                        } 
                        if($row["schedule_date_may"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_may"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_may"]) . "</td>";
                        }
                        if($row["schedule_date_june"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_june"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_june"]) . "</td>";
                        }
                        if($row["schedule_date_july"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_july"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_july"]) . "</td>";
                        }
                        if($row["schedule_date_august"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_august"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_august"]) . "</td>";
                        }
                        if($row["schedule_date_september"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_september"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_september"]) . "</td>";
                        }
                        if($row["schedule_date_october"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_october"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_october"]) . "</td>";
                        }
                        if($row["schedule_date_november"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_november"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_november"]) . "</td>";
                        }
                        if($row["schedule_date_december"]=="0000-00-00"){
                            echo "<td>" . " " . " <hr class='broken-line'> " . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["schedule_date_december"]) . " <hr class='broken-line'> " . convertDate($row["actual_date_december"]) . "</td>";
                        }
                        if($row["reasons_date"]=="0000-00-00"){
                            echo "<td>" . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["reasons_date"]) . "</td>";
                        }
                        echo "<td>". $row["reasons"] ."</td>";  
                        echo "<td>". $row["lam_remarks"] ."</td>";
                        if($row["deworming_drugs_1st_dose_date"]=="0000-00-00"){
                            echo "<td>" . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["deworming_drugs_1st_dose_date"]) . "</td>";
                        }
                        if($row["deworming_drugs_2nd_dose_date"]=="0000-00-00"){
                            echo "<td>" . " " . "</td>";
                        }else {
                            echo "<td>" . convertDate($row["deworming_drugs_2nd_dose_date"]) . "</td>";
                        }
                        status($row["deworming_drugs_yndwrm"]);
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
            <div id="legends">
                <div id="clientType">
                    <b>****Reasons:</b>
                    <p><b>A: </b>Pregnant</p>
                    <p><b>B: </b>Desire to be pregnant</p>
                    <p><b>C: </b>Medical complications</p>
                    <p><b>D: </b>Fear of side effects</p>
                    <p><b>E: </b>Changed Clinic</p>
                    <p><b>F: </b>Husband disapproves</p>
                    <p><b>G: </b>Menopause</p>
                    <p><b>H: </b>Lost or moved out of the area or residence</p>
                </div>
                <div>
                    <p><b>I: </b>Failed to get supply</p>
                    <p><b>J: </b>Change Method</p>
                    <p><b>K: </b>Underwent Hysterectomy</p>
                    <p><b>L: </b>Underwent Bilateral Salping-oophorectomy</p>
                    <p><b>M: </b>No FP Commodity</p>
                    <p><b>N: </b>Unknown</p>
                    <p><b>O: </b>Age out for BTL</p>
                </div>

                <div>
                    <b>For LAM:</b>
                    <p><b>A: </b>Mother has a menstruation or not amenorrheic within 6 months OR</p>
                    <p><b>B: </b>No longer practicing fully/exclusively breastfeeding OR</p>
                    <p><b>C: </b>Baby is more than six (6) months old</p>
                </div>
            </div>
        </div>
    </div>

    <style>
    #contentsContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    table {
        text-align: center;
        margin-bottom: 25px;
    }

    .broken-line {
        border: 1.3px dashed #000;
        width: 100%;
        margin: 0px;
    }

    #legends {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        font-size: 13px;
    }

    #legends:nth-child(1) {
        margin-left: 0px;
    }

    #legends:nth-child(4) {
        margin-right: 0px;
    }

    #legends>div>p {
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

    <!-- Button to trigger PDF generation -->


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