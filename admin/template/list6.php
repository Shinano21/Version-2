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
            /* float: right; */
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
