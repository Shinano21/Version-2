<?php
// Include the database connection
include('../dbcon.php');

// Query to fetch the number of hypertension cases grouped by zone and age group
$sql = "
SELECT 
    COUNT(*) AS count,
    r.zone AS location,
    CASE 
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 3 AND 10 THEN '3-10 years old'
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 11 AND 18 THEN '11-18 years old'
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 19 AND 28 THEN '19-28 years old'
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 29 AND 40 THEN '29-40 years old'
        ELSE '41+ years old'
    END AS age_group
FROM hypertension h
JOIN residents r ON h.resident_id = r.id
GROUP BY r.zone, age_group
ORDER BY r.zone, age_group
";

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypertension Report by Zone and Age Group</title>
    <style>
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
        .print-btn {
            text-align: center;
            margin-top: 20px;
        }
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Hypertension Report - By Zone and Age Group</h2>

    <table>
        <thead>
            <tr>
                <th>Zone (Purok)</th>
                <th>Age Group</th>
                <th>Number of Cases</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are results
            if ($result->num_rows > 0) {
                // Output each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['age_group'] . "</td>";
                    echo "<td>" . $row['count'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="print-btn">
        <button onclick="window.print()">Print Report</button>
    </div>
</div>

</body>
</html>
