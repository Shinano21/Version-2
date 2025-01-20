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
    display: flex;
    justify-content: space-between; /* Pushes content to far left and right */
    align-items: center; /* Vertically aligns the items */
    padding: 10px; /* Adds some spacing around the container */
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
            background-color: #4D869C;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            width: 130px;
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

    <button style="background-color: #6DC066;" onclick="window.print()">Print Report</button>
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
    <h2>Animal Bite Report</h2>



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

</div>

</body>
</html>
