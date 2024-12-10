<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenatal Records</title>
    <style>
        .printBtn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin: 20px;
        }
        .printBtn:hover {
            background-color: #0056b3;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button class="printBtn" onclick="window.print()">Print</button>
    </div>

    <h1>Prenatal Records</h1>
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
            // Include database connection
            include "../dbcon.php";

            // Fetch prenatal data
            $query = "SELECT r.fname, r.lname, p.checkup_date, p.gestational_age, 
                             p.blood_pressure, p.weight, p.fetal_heartbeat, p.remarks
                      FROM prenatal p
                      INNER JOIN residents r ON p.resident_id = r.id";
            $result = mysqli_query($conn, $query);

            // Display rows
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
            ?>
        </tbody>
    </table>
</body>
</html>
