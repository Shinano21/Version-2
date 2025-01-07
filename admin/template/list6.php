<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List 6 - Print View</title>
    <style>
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
            margin: 20px;
            float: right;
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
    </style>
</head>
<body>
    <div class="no-print">
        <button class="printBtn" onclick="window.print()">Print</button>
    </div>

    <div class="header">
        <h1>Animal Bite Records</h1>
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
            // Include database connection
            include "../dbcon.php";

            // Fetch data from the `animal_bite_records` table
            $query = "SELECT r.fname, r.lname, a.bite_date, a.treatment_date, a.bitten_location, a.remarks 
                      FROM animal_bite_records a 
                      INNER JOIN residents r ON a.resident_id = r.id";
            $result = mysqli_query($conn, $query);

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
