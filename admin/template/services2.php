<?php 
include "../dbcon.php";
$selectedYear = isset($_GET['year']) ? intval($_GET['year']) : null;

$sql = "SELECT center_name FROM home LIMIT 1";
$result = $conn->query($sql);
$centerName = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $centerName = $row['center_name'];
} else {
    $centerName = "No center name found";
}
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
        <div class="docuHeader">
                <!-- <div class="img"><img src="../src/techcareLogo2.png" alt="BrgyLogo"></div> -->
                 <div class="space"></div>
                <div class="mid">
                    <p class="text">Republic of the Philippines</p>
                    <p class="text">Province of Albay</p>
                    <p class="text">Municipality of Legazpi</p>
                    <p class="text" style="font-weight: 600;"><?php echo $centerName; ?></p>


                </div>
                <div class="space"></div>
            </div>
            <center>
                <h3>PART 2. NUTRITION AND DEWORMING SERVICES FOR CHILDREN AGE 12-59 MONTHS OLD (1-4 YEARS OLD)
                    (1/2)
                </h3>
            </center>
            <table>
                <tr>
                    <th rowspan="4" style="vertical-align: top;">No.</th>
                    <th rowspan="4" style="vertical-align: top;">Date of Registration<br>(mm/dd/yy)</th>
                    <th rowspan="4" style="vertical-align: top;">Date of Birth<br>(mm/dd/yy)</th>
                    <th rowspan="4" style="vertical-align: top;">Family Serial Number</th>
                    <th rowspan="4" style="vertical-align: top;">SE Status<br> 1. NHTS<br>2. Non-NHTS</th>
                    <th rowspan="4" style="vertical-align: top;">Name of Child<br>(Family name, First name, Middle
                        initial)</th>
                    <th rowspan="4" style="vertical-align: top;">Sex<br>(M or F)</th>
                    <th rowspan="4" style="vertical-align: top;">Complete name of Mother<br>(Family name, First name,
                        Middle initial)</th>
                    <th rowspan="4" style="vertical-align: top;">Complete Address</th>
                    <td rowspan="4" style="vertical-align: top;"><b>Length/</b><br><b>Height</b><br>(cm)</td>
                    <td rowspan="4" style="vertical-align: top;"><b>Weight</b><br>(kg)</td>
                    <th colspan="6">12-23 Months Old</th>
                </tr>
                <tr>
                    <td rowspan="3"><b>Nutritional<br>Status</b><br><b>S:</b>stunted<br />
                        <b>W-MAM:</b><br>wasted-WAM<br><b>W-SAM:</b><br>wasted-SAM<br><b>O:</b>obese/<br>overweight<br><b>N:</b>normal
                    </td>
                    <td colspan="2"><b>Nutrition</b><br><b>Services</b><br>Micronutrient<br>Supplementation</td>
                    <th rowspan="2" colspan="3">Deworming<br>Services</th>
                </tr>
                <tr>
                    <td colspan="2"><b>Vitamin A</b><br>(Data Given)</td>
                </tr>
                <tr>
                    <th>1st<br>dose</th>
                    <th>2nd<br>dose</th>
                    <td><b>1st</b><br><b>dose</b><br>(Date<br>Given)</td>
                    <td><b>2nd</b><br><b>dose</b><br>(Date<br>Given)</td>
                    <td><b>Child<br>Given 2<br>doses of<br>deworm-<br>ing drug</b><br>Place a (&#x2713;)<br>check</td>
                </tr>
                <?php
                $sql = "SELECT * FROM nutrition 
                INNER JOIN nutrition_1 ON nutrition.id = nutrition_1.nutrition_id";
                if ($selectedYear !== null) {
                    $sql .= " AND YEAR(reg) = $selectedYear";
                }
                $sql .= " ORDER BY reg";
                $i = 1;
                function convertDate($date){
                    $orderdate = explode('-', $date);
                    $year = $orderdate[0];
                    $month = $orderdate[1];
                    $day = $orderdate[2];
                                
                    return "$month-$day-$year"; // Modified return statement
                }
                function deworm($data){
                    if($data == "Yes"){
                        echo "<td>&#x2713;</td>";
                    } else {
                        echo "<td>&nbsp;</td>";
                    }
                }
                $result = mysqli_query($conn, $sql);
                $even = 0;
                // Check if there are results
                if (mysqli_num_rows($result) > 0) {
                
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr>";
                        echo "<td>". $i ."</td>";        
                        echo "<td>". convertDate($row["reg"]) ."</td>";
                        echo "<td>". convertDate($row["bday"]) ."</td>";
                        echo "<td>". $row["serial"] ."</td>";
                        echo "<td>". $row["se_status"] ."</td>";
                        echo "<td>". $row["lname"] .", ". $row["fname"]." ". substr($row["mname"], 0, 1)."". $row["suffix"]."</td>";
                        echo "<td>". $row["sex"] ."</td>";
                        echo "<td>". $row["mother_lname"] .", ". $row["mother_fname"]." ". substr($row["mother_mname"], 0, 1)."</td>";
                        echo "<td>". $row["zone"] . ", " . $row["brgy"] .", " . $row["city"] .", " . $row["province"] ."</td>";
                        echo "<td>". $row["length"] ."</td>";
                        echo "<td>". $row["weight"] ."</td>";
                        echo "<td>". $row["nutritional_status"] ."</td>";
                        if($row["vitamin_a_1st_dose_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["vitamin_a_1st_dose_date"]) ."</td>";
                        }
                        if($row["vitamin_a_2nd_dose_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["vitamin_a_2nd_dose_date"]) ."</td>";
                        }
                        if($row["deworming_1st_dose_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["deworming_1st_dose_date"]) ."</td>";
                        }
                        if($row["deworming_2nd_dose_date"]=="0000-00-00"){
                            echo "<td>". " "  ."</td>";
                        }else {
                            echo "<td>". convertDate($row["deworming_2nd_dose_date"]) ."</td>";
                        }
                        deworm($row["deworming_yn"]);
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
                    echo "</tr>";
                    $i++;
                    }
                }
                ?>
            </table>
        </div>
        <div class="table-container">
            <center>
                <h3>PART 2. NUTRITION AND DEWORMING SERVICES FOR CHILDREN AGE 12-59 MONTHS OLD (1-4 YEARS OLD)
                    (2/2)
                </h3>
            </center>
            <table>
                <tr>
                    <th rowspan="4">No.</th>
                    <th colspan="6">24-35 Months Old<br>(12)</th>
                    <th colspan="6">36-47 Months Old<br>(13)</th>
                    <th colspan="6">48-59 Months Old<br>(14)</th>
                    <th colspan="8">12-59 Months Old<br>(15)</th>
                    <th rowspan="4" style="vertical-align: top;">Remarks<br>(16)</th>
                </tr>
                <tr>
                    <td rowspan="3"><b>Nutritional<br>Status</b><br><b>S:</b>stunted<br />
                        <b>W-MAM:</b><br>wasted-WAM<br><b>W-SAM:</b><br>wasted-SAM<br><b>O:</b>obese/<br>overweight<br><b>N:</b>normal
                    </td>
                    <td colspan="2"><b>Nutrition</b><br><b>Services</b><br>Micronutrient<br>Supplementation</td>
                    <th rowspan="2" colspan="3">Deworming<br>Services</th>
                    <td rowspan="3"><b>Nutritional<br>Status</b><br><b>S:</b>stunted<br />
                        <b>W-MAM:</b><br>wasted-WAM<br><b>W-SAM:</b><br>wasted-SAM<br><b>O:</b>obese/<br>overweight<br><b>N:</b>normal
                    </td>
                    <td colspan="2"><b>Nutrition</b><br><b>Services</b><br>Micronutrient<br>Supplementation</td>
                    <th rowspan="2" colspan="3">Deworming<br>Services</th>
                    <td rowspan="3"><b>Nutritional<br>Status</b><br><b>S:</b>stunted<br />
                        <b>W-MAM:</b><br>wasted-WAM<br><b>W-SAM:</b><br>wasted-SAM<br><b>O:</b>obese/<br>overweight<br><b>N:</b>normal
                    </td>
                    <td colspan="2"><b>Nutrition</b><br><b>Services</b><br>Micronutrient<br>Supplementation</td>
                    <th rowspan="2" colspan="3">Deworming<br>Services</th>
                    <th rowspan="2" colspan="4" style="width: 10.29%;">MAM</th>
                    <th rowspan="2" colspan="4" style="width: 10.29%;">SAM Without Complication</th>
                </tr>
                <tr>
                    <td colspan="2"><b>Vitamin A</b><br>(Data Given)</td>
                    <td colspan="2"><b>Vitamin A</b><br>(Data Given)</td>
                    <td colspan="2"><b>Vitamin A</b><br>(Data Given)</td>
                </tr>
                <tr>
                    <th>1st<br>dose</th>
                    <th>2nd<br>dose</th>
                    <td><b>1st</b><br><b>dose</b><br>(Date<br>Given)</td>
                    <td><b>2nd</b><br><b>dose</b><br>(Date<br>Given)</td>
                    <td><b>Child<br>Given 2<br>doses of<br>deworm-<br>ing drug</b><br>Place a (&#x2713;)<br>check</td>
                    <th>1st<br>dose</th>
                    <th>2nd<br>dose</th>
                    <td><b>1st</b><br><b>dose</b><br>(Date<br>Given)</td>
                    <td><b>2nd</b><br><b>dose</b><br>(Date<br>Given)</td>
                    <td><b>Child<br>Given 2<br>doses of<br>deworm-<br>ing drug</b><br>Place a (&#x2713;)<br>check</td>
                    <th>1st<br>dose</th>
                    <th>2nd<br>dose</th>
                    <td><b>1st</b><br><b>dose</b><br>(Date<br>Given)</td>
                    <td><b>2nd</b><br><b>dose</b><br>(Date<br>Given)</td>
                    <td><b>Child<br>Given 2<br>doses of<br>deworm-<br>ing drug</b><br>Place a (&#x2713;)<br>check</td>
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
                $sql = "SELECT * FROM nutrition_2 
                INNER JOIN nutrition ON nutrition_id = nutrition.id";
                if ($selectedYear !== null) {
                    $sql .= " AND YEAR(reg) = $selectedYear";
                }
                $sql .= " ORDER BY reg";
$i = 1;
$result = mysqli_query($conn, $sql);
$even = 0;
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
// Check if there are results
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<td>". $i ."</td>"; 
        echo "<td>". $row["nutritional_status2"] ."</td>";
        if($row["vitamin_a_1st_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["vitamin_a_1st_dose_date"]) ."</td>";
        }
        if($row["vitamin_a_2nd_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["vitamin_a_2nd_dose_date"]) ."</td>";
        }
        if($row["deworming_1st_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["deworming_1st_dose_date"]) ."</td>";
        }
        if($row["deworming_2nd_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["deworming_2nd_dose_date"]) ."</td>";
        }
        deworm($row["deworming_yn"]);
        $i++;
    }
}
$sql = "SELECT * FROM nutrition_3 
INNER JOIN nutrition ON nutrition_id = nutrition.id";
if ($selectedYear !== null) {
    $sql .= " AND YEAR(reg) = $selectedYear";
}
$sql .= " ORDER BY reg";
$result = mysqli_query($conn, $sql);
$even = 0;
// Check if there are results
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<td>". $row["nutritional_status3"] ."</td>";
        if($row["vitamin_a_1st_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["vitamin_a_1st_dose_date"]) ."</td>";
        }
        if($row["vitamin_a_2nd_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["vitamin_a_2nd_dose_date"]) ."</td>";
        }
        if($row["deworming_1st_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["deworming_1st_dose_date"]) ."</td>";
        }
        if($row["deworming_2nd_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["deworming_2nd_dose_date"]) ."</td>";
        }
        deworm($row["deworming_yn"]);
    }
}

$sql = "SELECT * from nutrition_4
INNER JOIN nutrition ON nutrition_id = nutrition.id
INNER JOIN nutrition_5 ON nutrition_4.id = nutrition_5.id";
if ($selectedYear !== null) {
    $sql .= " AND YEAR(reg) = $selectedYear";
}
$sql .= " ORDER BY reg";
$result = mysqli_query($conn, $sql);
$even = 0;
// Check if there are results
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<td>" . $row["nutritional_status4"] . "</td>";
        if($row["vitamin_a_1st_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["vitamin_a_1st_dose_date"]) ."</td>";
        }
        if($row["vitamin_a_2nd_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["vitamin_a_2nd_dose_date"]) ."</td>";
        }
        if($row["deworming_1st_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["deworming_1st_dose_date"]) ."</td>";
        }
        if($row["deworming_2nd_dose_date"]=="0000-00-00"){
            echo "<td>". " "  ."</td>";
        }else {
            echo "<td>". convertDate($row["deworming_2nd_dose_date"]) ."</td>";
        }
        deworm($row["deworming_yn"]);
        check1($row["mam_status"]);
        check1($row["sam_status"]);
        echo "<td>". $row["remarks"] ."</td>";
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
                .docuHeader {
    display: flex;
    justify-content: center; /* Centers horizontally */
    align-items: center; /* Centers vertically */
    text-align: center; /* Ensures text is centered within each <p> tag */
}

.mid {
    display: flex;
    flex-direction: column;
    align-items: center; /* Centers text block horizontally */
}

.text {
    line-height: 1.5; /* Adjusts line spacing */
    margin-top: 0px; /* Adjusts space above each paragraph */
    margin-bottom: 10px; /* Adjusts space below each paragraph */
}
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