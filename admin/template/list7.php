<?php
include '../dbcon.php';

$sql = "SELECT center_name FROM home LIMIT 1";
$result = $conn->query($sql);
$centerName = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $centerName = $row['center_name'];
} else {
    $centerName = "No center name found";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenatal Records</title>
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
            display: inline-block;
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
        <h1>Prenatal Records</h1>
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
