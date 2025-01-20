<?php
include '../dbcon.php';

// Get filter values from the form submission
$filter_month = isset($_GET['month']) ? $_GET['month'] : date('m');
$filter_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Query to get the center name
$sql = "SELECT center_name FROM home LIMIT 1";
$result = $conn->query($sql);
$centerName = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $centerName = $row['center_name'];
} else {
    $centerName = "No center name found";
}

// Get the full name of the selected month
$month_name = date('F', mktime(0, 0, 0, $filter_month, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenatal Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .docuHeader {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }

        .docuHeader .mid p {
            margin: 0;
            line-height: 1.5;
            font-size: 14px;
        }

        form {
    display: flex;
    justify-content: space-between; /* Ensures elements are spaced to the sides */
    align-items: center; /* Vertically aligns the items */
    flex-wrap: wrap; /* Ensures the layout remains responsive */
    gap: 10px; /* Adds spacing between form elements */
    padding: 10px; /* Adds padding around the form */
}

form label {
    margin-right: 5px; /* Adds spacing between the label and its field */
}

form select {
    margin-right: 10px; /* Adds spacing between selects */
}

form button {
    margin-left: 10px; /* Adds spacing between the Filter button and Print button */
}

.no-print {
    margin-left: auto; /* Pushes the Print button to the far right */
}

.printBtn {
    background-color: #6DC066;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    width: 130px;
}

.printBtn:hover {
    background-color: #5CA556; /* Darker green on hover */
}

        h1 {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

   

        select, button {
            padding: 8px;
            font-size: 14px;
        }

        .filter-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter-info span {
            font-weight: bold;
        }

        table {
            width: 90%;
            margin: 0 auto 20px;
            border-collapse: collapse;
            font-size: 14px;
            border: 1px solid #ccc;
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

        @media print {
            .no-print, form {
                display: none;
            }

            .filter-info {
                display: block;
            }
        }
    </style>
</head>
<body>
<!-- Filter Form -->
<form method="GET">
    <!-- Month Filter -->
    <label for="month">Month:</label>
    <select name="month" id="month">
        <?php for ($m = 1; $m <= 12; $m++): ?>
            <option value="<?php echo str_pad($m, 2, '0', STR_PAD_LEFT); ?>" 
                <?php echo ($filter_month == str_pad($m, 2, '0', STR_PAD_LEFT)) ? 'selected' : ''; ?>>
                <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
            </option>
        <?php endfor; ?>
    </select>

    <!-- Year Filter -->
    <label for="year">Year:</label>
    <select name="year" id="year">
        <?php for ($y = date('Y') - 10; $y <= date('Y'); $y++): ?>
            <option value="<?php echo $y; ?>" 
                <?php echo ($filter_year == $y) ? 'selected' : ''; ?>>
                <?php echo $y; ?>
            </option>
        <?php endfor; ?>
    </select>

    <!-- Filter Button -->
    <button type="submit" style="background-color: #4D869C; width:130px; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Filter</button>

    <!-- Print Button -->
    <div class="no-print">
        <button class="printBtn" onclick="window.print()">Print</button>
    </div>
</form>

    <hr>
    <div class="docuHeader">
        <div class="mid">
            <p>Republic of the Philippines</p>
            <p>Province of Albay</p>
            <p>Municipality of Legazpi</p>
            <p style="font-weight: 600;"><?php echo $centerName; ?></p>
        </div>
    </div>
    <div class="header">
        <h1>Prenatal Records</h1>
    </div>



    <!-- Filter Info -->
    <div class="filter-info">
        Showing records for: <span><?php echo $month_name . ' ' . $filter_year; ?></span>
    </div>

   

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Checkup Date</th>
                <th>Gestational Age (weeks)</th>
                <th>Blood Pressure</th>
                <th>Weight (kg)</th>
                <th>Fetal Heartbeat</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch filtered prenatal data
            $query = "SELECT r.fname, r.lname, p.checkup_date, p.gestational_age, 
                             p.blood_pressure, p.weight, p.fetal_heartbeat, p.remarks
                      FROM prenatal p
                      INNER JOIN residents r ON p.resident_id = r.id
                      WHERE MONTH(p.checkup_date) = '$filter_month' AND YEAR(p.checkup_date) = '$filter_year'";
            $result = mysqli_query($conn, $query);

            // Display rows
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                    echo "<td>" . $row['checkup_date'] . "</td>";
                    echo "<td>" . $row['gestational_age'] . "</td>";
                    echo "<td>" . $row['blood_pressure'] . "</td>";
                    echo "<td>" . $row['weight'] . "</td>";
                    echo "<td>" . $row['fetal_heartbeat'] . "</td>";
                    echo "<td>" . $row['remarks'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found for the selected month and year.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
