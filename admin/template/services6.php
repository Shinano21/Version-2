<?php
// Include the database connection
include('../dbcon.php');

// Enable detailed error reporting (optional)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Initialize filter variables
$selectedYear = $_GET['year'] ?? date('Y');
$selectedMonth = $_GET['month'] ?? date('m');

// Query to fetch the number of people bitten for the selected month and year
$sql = "
SELECT 
    COUNT(*) AS count,
    ab.bitten_location AS location,
    CASE 
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 3 AND 10 THEN '3-10 years old'
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 11 AND 18 THEN '11-18 years old'
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 19 AND 28 THEN '19-28 years old'
        WHEN FLOOR(DATEDIFF(CURDATE(), r.bday) / 365) BETWEEN 29 AND 40 THEN '29-40 years old'
        ELSE '41+ years old'
    END AS age_group
FROM animal_bite_records ab
JOIN residents r ON ab.resident_id = r.id
WHERE ab.bitten_location IS NOT NULL
  AND MONTH(ab.bite_date) = ?
  AND YEAR(ab.bite_date) = ?
GROUP BY ab.bitten_location, age_group
ORDER BY ab.bitten_location, age_group
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $selectedMonth, $selectedYear);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Bite Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            width: 90%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }
        .filters {
            text-align: center;
            margin-bottom: 20px;
        }
        .filters select {
            padding: 5px 10px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            color: #555;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #777;
        }
        .print-btn {
            text-align: center;
            margin-top: 20px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        @media print {
            .filters, .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Animal Bite Report</h2>

    <div class="filters">
        <form method="GET">
            <label for="year">Year:</label>
            <select id="year" name="year">
                <?php
                for ($y = 2020; $y <= date('Y'); $y++) {
                    echo "<option value='$y'" . ($y == $selectedYear ? " selected" : "") . ">$y</option>";
                }
                ?>
            </select>

            <label for="month">Month:</label>
            <select id="month" name="month">
                <?php
                for ($m = 1; $m <= 12; $m++) {
                    $monthName = date('F', mktime(0, 0, 0, $m, 1));
                    echo "<option value='$m'" . ($m == $selectedMonth ? " selected" : "") . ">$monthName</option>";
                }
                ?>
            </select>

            <button type="submit">Filter</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Location</th>
                <th>Age Group</th>
                <th>Number of Cases</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['age_group']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['count']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='no-data'>No data available for the selected period</td></tr>";
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
