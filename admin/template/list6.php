<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List 6 - Print View</title>
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
        /* Style your table and content as needed */
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

    <h1>List 6 - Animal Bite Records</h1>
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
