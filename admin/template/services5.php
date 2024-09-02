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
                <h3>ANTI PNEUMONIA VACCINE RECIPIENTS OF <?php echo $selectedYear ?></h3>
            </center>
            <table>
                <tr>
                    <th colspan="1">No.</th>
                    <th colspan="1">Name</th>
                    <th colspan="1">Age</th>
                    <th colspan="1">Birthday</th>
                    <th colspan="1">Address</th>
                    <th colspan="1">Signature</th>
                    <th colspan="1">SITE</th>
                    <th colspan="1">Date</th>
                </tr>
                <?php
                function age($data){
                    $today = date('Y-m-d');
                    $diff = date_diff(date_create($data), date_create($today));
                    $age = $diff->format('%y');
                    echo "<td>". $age ."</td>";
                }
                function convertDate($date){
                    $orderdate = explode('-', $date);
                    $year = $orderdate[0];
                    $month = $orderdate[1];
                    $day = $orderdate[2];
                                
                    return "$month-$day-$year"; // Modified return statement
                }
                $sql = "SELECT * FROM anti_pneumonia WHERE 1";

                if ($selectedYear !== null) {
                    $sql .= " AND YEAR(vaccination_date) = $selectedYear";
                }
                $sql .= " ORDER BY vaccination_date";

                $i = 1;
                $result = mysqli_query($conn, $sql);
                $even = 0;
                // Check if there are results
                if (mysqli_num_rows($result) > 0) {
                
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr>";
                        echo "<td>". $i ."</td>";        
                        echo "<td class='name'>&nbsp;&nbsp" . $row["last_name"] . ", " . $row["first_name"] . " " . $row["middle_name"] . " " . $row["suffix"] . "</td>";
                        age($row["date_of_birth"]);
                        echo "<td>". $row["date_of_birth"] ."</td>";
                        echo "<td>" . $row["zone"] . ", " . $row["barangay"] . ", " . $row["city_municipality"] . ", " . $row["province"] . "</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>". $row["vaccination_site"] ."</td>";
                        echo "<td>". convertDate($row["vaccination_date"]) ."</td>";
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
        margin-bottom: 25px;
        width: 247mm;
        height: 160mm;
    }

    #contentsContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 auto;
        border: none;
        /* Center the div horizontally */
        padding: 0;
        /* Add some padding for content inside the div */
    }

    table,
    th,
    tr,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .name {
        text-align: left;
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