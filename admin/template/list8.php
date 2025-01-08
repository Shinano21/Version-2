<?php
// Include the database connection
include '../dbcon.php';

// Fetch hypertension records with resident details
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
    }
    .print-btn {
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
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
        .print-btn {
            display: none;
        }
    }
</style>

</head>
<body>
    <div class="container">
    <div class="header">
        <h1>Hypertension Records</h1>
        <a href="#" class="print-btn" onclick="window.print(); return false;">Print Records</a>
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
