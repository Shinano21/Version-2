<?php
include '../dbcon.php';

// Fetch center name
$sql = "SELECT center_name FROM home LIMIT 1";
$result = $conn->query($sql);
$centerName = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $centerName = $row['center_name'];
} else {
    $centerName = "No center name found";
}

// Get filter values
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('F');
$selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Convert month name to number
$monthNumber = date('m', strtotime($selectedMonth));

// Fetch filtered data
$query = "SELECT r.fname, r.lname, a.bite_date, a.treatment_date, a.bitten_location, a.remarks 
          FROM animal_bite_records a 
          INNER JOIN residents r ON a.resident_id = r.id 
          WHERE YEAR(a.bite_date) = '$selectedYear' AND MONTH(a.bite_date) = '$monthNumber'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List 6 - Print View</title>
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

        .no-print { 
            display: flex; 
            justify-content: space-between; /* Ensures spacing between elements */ 
            margin: 20px; 
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .printBtn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .printBtn:hover {
            background-color: #0056b3;
        }

        @media print {
            .no-print {
                display: none;
            }
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .header {
            margin-bottom: 20px;
            text-align: center;
        }
         select {
            padding: 5px 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="no-print">
        <form method="GET" style="display: flex; gap: 10px; align-items:center;">
            <label for="month">Month:</label>
            <select name="month" id="month">
                <?php
                // Generate months dropdown
                foreach (range(1, 12) as $m) {
                    $monthName = date('F', mktime(0, 0, 0, $m, 1));
                    echo "<option value='$monthName'" . ($selectedMonth == $monthName ? ' selected' : '') . ">$monthName</option>";
                }
                ?>
            </select>

            <label for="year">Year:</label>
            <select name="year" id="year">
                <?php
                // Generate years dropdown (last 10 years + next 1 year)
                $currentYear = date('Y');
                foreach (range($currentYear - 10, $currentYear + 1) as $y) {
                    echo "<option value='$y'" . ($selectedYear == $y ? ' selected' : '') . ">$y</option>";
                }
                ?>
            </select>

            <button type="submit" style="background-color: #4D869C; color: white; padding: 10px 20px; border: none; border-radius: 5px; width:130px;">Filter</button>
        </form>

        <button class="printBtn" style="background-color:#6DC066; width:130px;" onclick="window.print()">Print</button>
    </div>
<hr>
    <div class="docuHeader">
        <div class="mid">
            <p class="text">Republic of the Philippines</p>
            <p class="text">Province of Albay</p>
            <p class="text">Municipality of Legazpi</p>
            <p class="text" style="font-weight: 600;"><?php echo $centerName; ?></p>
        </div>
    </div>

    <div class="header">
        <h1>Animal Bite Records</h1>
        <p>Showing records for: <strong><?php echo "$selectedMonth $selectedYear"; ?></strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Bite Date</th>
                <th>Treatment Date</th>
                <th>Bitten Location</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display data in rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                echo "<td>" . $row['bite_date'] . "</td>";
                echo "<td>" . $row['treatment_date'] . "</td>";
                echo "<td>" . $row['bitten_location'] . "</td>";
                echo "<td>" . $row['remarks'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
