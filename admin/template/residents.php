<?php
include "../dbcon.php";

// Get selected month and year from URL parameters
$selectedMonth = isset($_GET['month']) ? intval($_GET['month']) : null;
$selectedYear = isset($_GET['year']) ? intval($_GET['year']) : null;

// Convert month number to month name
$monthNames = [
    1 => 'JANUARY',
    2 => 'FEBRUARY',
    3 => 'MARCH',
    4 => 'APRIL',
    5 => 'MAY',
    6 => 'JUNE',
    7 => 'JULY',
    8 => 'AUGUST',
    9 => 'SEPTEMBER',
    10 => 'OCTOBER',
    11 => 'NOVEMBER',
    12 => 'DECEMBER',
];

$selectedMonthName = isset($monthNames[$selectedMonth]) ? $monthNames[$selectedMonth] : '';

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
                <h3>LIST OF RESIDENTS AS OF <?php echo $selectedMonthName . ' ' . $selectedYear; ?></h3>
            </center>
            <table>
                <tr>
                    <th colspan="1">No.</th>
                    <th colspan="1">Full Name</th>
                    <th colspan="1">Sex</th>
                    <th colspan="1">Age</th>
                    <th colspan="1">Birthday</th>
                    <th colspan="1">Address</th>
                    <th colspan="1">Contact Number</th>
                </tr>
                <?php
                function age($data)
                {
                    $today = date('Y-m-d');
                    $diff = date_diff(date_create($data), date_create($today));
                    $age = $diff->format('%y');
                    echo "<td>" . $age . "</td>";
                }
                function convertDate($date)
                {
                    $orderdate = explode('-', $date);
                    $year = $orderdate[0];
                    $month = $orderdate[1];
                    $day = $orderdate[2];

                    return "$month-$day-$year"; // Modified return statement
                }

                // Construct SQL query based on selected month and year
                $sql = "SELECT * FROM residents WHERE status = 'active'";
                if ($selectedYear !== null && $selectedMonth !== null) {
                    $sql .= " AND (YEAR(bday) < $selectedYear OR (YEAR(bday) = $selectedYear AND MONTH(bday) <= $selectedMonth))";
                }
                $sql .= " ORDER BY lname";

                $i = 1;
                $result = mysqli_query($conn, $sql);
                $even = 0;

                // Check if there are results
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td class='name'>&nbsp;&nbsp;" . $row["lname"] . ", " . $row["fname"] . " " . $row["mname"] . " " . $row["suffix"] . "</td>";
                        echo "<td>" . $row["sex"] . "</td>";
                        age($row["bday"]);
                        echo "<td>" . $row["bday"] . "</td>";
                        echo "<td>" . $row["zone"] . ", " . $row["brgy"] . ", " . $row["mun"] . ", " . $row["province"] . "</td>";
                        echo "<td>" . $row["contact"] . "</td>";
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


        @page header {
            display: none;

            /* Hide header */
        }

        @page footer {
            display: none;

            /* Hide footer */
        }

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
