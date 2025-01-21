<?php
// Include the database connection
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

// Get filter inputs
$filterMonth = isset($_GET['month']) ? $_GET['month'] : '';
$filterYear = isset($_GET['year']) ? $_GET['year'] : '';

// Build query with filters
$query = "
    SELECT 
        r.fname, 
        r.mname, 
        r.lname, 
        r.suffix, 
        h.checkup_date, 
        h.medicine_type, 
        h.blood_pressure, 
        h.remarks_type
    FROM 
        hypertension h
    JOIN 
        residents r ON h.resident_id = r.id
";

if ($filterMonth && $filterYear) {
    $query .= " WHERE MONTH(h.checkup_date) = '$filterMonth' AND YEAR(h.checkup_date) = '$filterYear'";
} elseif ($filterYear) {
    $query .= " WHERE YEAR(h.checkup_date) = '$filterYear'";
}

$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypertension Records</title>
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
    justify-content: flex-end; /* Positions the button to the right */ 
}
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    .container {
        width: 100%; /* Make container full-width */
        margin: auto;
    }
    .header {
        display: flex;
        justify-content: space-between; /* Align items to the sides */
        align-items: center; /* Center items vertically */
        margin-bottom: 20px;
    }
    .header h1 {
        margin: 0 auto; /* Center the title */
        text-align: center;
        flex-grow: 1; /* Allow title to take up available space */
        font-size: 25px;
    }
    .printBtn {
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        border: none;
        display: inline-block;
    }
    .print-btn:hover {
        background-color: #0056b3;
    }
    table {
        width: 100%; /* Stretch table to full width */
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }
    table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    table tbody tr:hover {
        background-color: #f1f1f1;
    }
    @media print {
        .no-print {
            display: none;
        }
    }
</style>

</head>
<body>
    <div class="container">
    <div class="no-print">
    <form method="GET" style="margin-bottom: 20px;">
            <label for="month">Month:</label>
            <select name="month" id="month">
                <option value="">All</option>
                <?php for ($m = 1; $m <= 12; $m++): ?>
                    <option value="<?= $m ?>" <?= $m == $filterMonth ? 'selected' : '' ?>>
                        <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                    </option>
                <?php endfor; ?>
            </select>
            <label for="year">Year:</label>
            <select name="year" id="year">
                <option value="">All</option>
                <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
                    <option value="<?= $y ?>" <?= $y == $filterYear ? 'selected' : '' ?>>
                        <?= $y ?>
                    </option>
                <?php endfor; ?>
            </select>
            <button type="submit">Filter</button>
        </form>
        <button class="printBtn" onclick="window.print()">Print</button>
    </div>
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
        
    <div class="header">
        <h1>Hypertension Records</h1>
        <!-- <a href="#" class="print-btn" onclick="window.print(); return false;">Print Records</a> -->
    </div>
        <table>
            <thead>
                <tr>
                    <th>Resident Name</th>
                    <th>Checkup Date</th>
                    <th>Medicine Type</th>
                    <th>Blood Pressure</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['suffix']); ?>
                            </td>
                            <td><?= htmlspecialchars($row['checkup_date']); ?></td>
                            <td><?= htmlspecialchars($row['medicine_type']); ?></td>
                            <td><?= htmlspecialchars($row['blood_pressure']); ?></td>
                            <td><?= htmlspecialchars($row['remarks_type']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
