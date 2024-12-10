<?php
// Include the database connection
include '../dbcon.php';

// Fetch hypertension records with resident details
$query = "
    SELECT 
        h.hypertension_id, 
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
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypertension Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        table {
            width: 100%;
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
        .print-btn {
            display: block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            width: fit-content;
        }
        .print-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hypertension Records</h1>
        <a href="#" class="print-btn" onclick="window.print(); return false;">Print Records</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
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
                            <td><?= htmlspecialchars($row['hypertension_id']); ?></td>
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
                        <td colspan="6">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
