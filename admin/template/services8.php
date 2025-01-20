<?php
// Include the database connection
include('../dbcon.php');

$sql = "SELECT center_name FROM home LIMIT 1";
$result = $conn->query($sql);
$centerName = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $centerName = $row['center_name'];
} else {
    $centerName = "No center name found";
}

// Initialize variables for month and year filters
$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

// Build the WHERE clause based on filters
$whereClause = "";
if (!empty($month) && !empty($year)) {
    $whereClause = "WHERE MONTH(h.checkup_date) = $month AND YEAR(h.checkup_date) = $year";
} elseif (!empty($month)) {
    $whereClause = "WHERE MONTH(h.checkup_date) = $month";
} elseif (!empty($year)) {
    $whereClause = "WHERE YEAR(h.checkup_date) = $year";
}

// Query to fetch data including total quantity
$sql = "
SELECT 
    r.zone AS location,
    CASE 
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 3 AND 10 THEN '3-10 years old'
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 11 AND 18 THEN '11-18 years old'
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 19 AND 28 THEN '19-28 years old'
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 29 AND 40 THEN '29-40 years old'
        ELSE '41+ years old'
    END AS age_group,
    h.medicine_type,
    h.medicine_name,
    SUM(h.quantity) AS total_quantity
FROM hypertension h
JOIN residents r ON h.resident_id = r.id
$whereClause
GROUP BY r.zone, age_group, h.medicine_type, h.medicine_name
ORDER BY r.zone, age_group, total_quantity DESC
";

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Query to calculate the overall total quantity for all medicines
$totalSql = "
SELECT SUM(h.quantity) AS grand_total
FROM hypertension h
$whereClause
";

$totalResult = $conn->query($totalSql);
$grandTotal = 0;

if ($totalResult && $totalResult->num_rows > 0) {
    $grandTotalRow = $totalResult->fetch_assoc();
    $grandTotal = $grandTotalRow['grand_total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypertension Report by Zone, Age Group, and Medicines</title>
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
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .filters {
    display: flex;
    justify-content: space-between; /* Align filters to the left and the print button to the right */
    align-items: center; /* Vertically center items */
    flex-wrap: wrap; /* Makes the layout responsive */
    padding: 10px; /* Adds padding around the container */
    gap: 10px; /* Adds space between elements in smaller screens */
}

.filters form {
    display: flex;
    gap: 10px; /* Adds spacing between filter elements */
    align-items: center; /* Vertically aligns the form elements */
}

.filters select,
.filters button {
    padding: 5px 10px; /* Adds padding for better appearance */
    font-size: 14px; /* Ensures text is readable */
}

.print-btn {
    margin-left: auto; /* Pushes the Print button to the far right */
}

.print-btn button {
    background-color: #6DC066;
    color: white;
    border: none;
    padding: 8px 12px;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    width: 130px;
}

.print-btn button:hover {
    background-color: #5CA556; /* Slightly darker green on hover */
}

        @media print {
            .print-btn, .filters {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="filters">
    <!-- Filter Form -->
    <form method="GET" action="">
        <select name="month">
            <option value="">Select Month</option>
            <?php
            // Generate month options
            for ($i = 1; $i <= 12; $i++) {
                $selected = ($month == $i) ? 'selected' : '';
                echo "<option value='$i' $selected>" . date('F', mktime(0, 0, 0, $i, 1)) . "</option>";
            }
            ?>
        </select>
        <select name="year">
            <option value="">Select Year</option>
            <?php
            // Generate year options
            $currentYear = date('Y');
            for ($i = $currentYear; $i >= 2000; $i--) {
                $selected = ($year == $i) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>
    <button type="submit" style="background-color: #4D869C; width:130px; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Filter</button>
    </form>

    <!-- Print Button -->
    <div class="print-btn">
        <button onclick="window.print()">Print Report</button>
    </div>
</div>
<hr>
<div class="container">
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
    <h2>Hypertension Report - By Zone, Age Group, and Medicines</h2>


    <table>
        <thead>
            <tr>
                <th>Zone (Purok)</th>
                <th>Age Group</th>
                <th>Medicine Type</th>
                <th>Medicine Name</th>
                <th>Total Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['age_group'] . "</td>";
                    echo "<td>" . $row['medicine_type'] . "</td>";
                    echo "<td>" . $row['medicine_name'] . "</td>";
                    echo "<td>" . $row['total_quantity'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Grand Total (All Medicines):</strong></td>
                <td><strong><?php echo $grandTotal; ?></strong></td>
            </tr>
        </tfoot>
    </table>

   
</div>

</body>
</html>
