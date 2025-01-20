<?php
include "../dbcon.php";

$sql = "SELECT center_name FROM home LIMIT 1";
$result = $conn->query($sql);
$centerName = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $centerName = $row['center_name'];
} else {
    $centerName = "No center name found";
}

// Initialize filter variables
$selected_month = isset($_GET['month']) ? $_GET['month'] : date('m');
$selected_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Fetch filtered medicine log data
$query = "SELECT ml.log_id, r.fname, r.lname, ml.medicine_name, ml.medicine_type, ml.quantity, ml.checkup_date 
          FROM medicine_log ml 
          JOIN residents r ON ml.resident_id = r.id 
          WHERE MONTH(ml.checkup_date) = '$selected_month' AND YEAR(ml.checkup_date) = '$selected_year'
          ORDER BY ml.checkup_date DESC";
$result = mysqli_query($conn, $query);

// Fetch total quantity
$total_query = "SELECT SUM(ml.quantity) AS total_quantity
                FROM medicine_log ml 
                WHERE MONTH(ml.checkup_date) = '$selected_month' AND YEAR(ml.checkup_date) = '$selected_year'";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_quantity = $total_row['total_quantity'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medicine Distribution Report</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .no-print {
    display: flex;
    justify-content: space-between; /* Aligns form to the left and Print button to the right */
    align-items: center; /* Vertically centers elements */
    flex-wrap: wrap; /* Allows wrapping for smaller screens */
    gap: 10px; /* Adds spacing between elements when wrapping */
    padding: 10px; /* Adds padding for a cleaner layout */
}

.no-print form {
    display: flex;
    align-items: center; /* Vertically aligns form elements */
    gap: 10px; /* Adds spacing between form elements */
}

.no-print label {
    margin-right: 5px; /* Adds space between the label and its dropdown */
}

.no-print select {
    padding: 5px 10px; /* Adds padding for better usability */
    font-size: 14px; /* Ensures text is readable */
}

.no-print button {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

.no-print button[type="submit"] {
    background-color: #007bff;
    color: white;
}

.no-print button[type="submit"]:hover {
    background-color: #0056b3;
}

.no-print button[type="button"] {
    background-color: #6DC066;
    color: white;
    margin-left: auto; /* Pushes the Print button to the far right */
    width: 130px;
    padding:10px;
}

.no-print button[type="button"]:hover {
    background-color: #5CA556;
}

@media print {
    .no-print {
        display: none; /* Hides the form and buttons during printing */
    }
}

    </style>
</head>
<body>
<!-- Filter Form -->
<div class="no-print">
    <form method="GET" action="">
        <label for="month">Month:</label>
        <select id="month" name="month">
            <?php for ($m = 1; $m <= 12; $m++) {
                $month = str_pad($m, 2, '0', STR_PAD_LEFT);
                $selected = ($month == $selected_month) ? "selected" : "";
                echo "<option value='$month' $selected>" . date('F', mktime(0, 0, 0, $m, 1)) . "</option>";
            } ?>
        </select>

        <label for="year">Year:</label>
        <select id="year" name="year">
            <?php
            $current_year = date('Y');
            for ($y = $current_year; $y >= $current_year - 10; $y--) {
                $selected = ($y == $selected_year) ? "selected" : "";
                echo "<option value='$y' $selected>$y</option>";
            }
            ?>
        </select>

    <button type="submit" style="background-color: #4D869C; width:130px; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Filter</button>
    </form>

    <!-- Print Button -->
    <button type="button" onclick="window.print();">Print</button>
</div>

    <hr>
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
    <h1 style="text-align:center;">Medicine Distribution Report</h1>



    <!-- Report Table -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Resident Name</th>
                <th>Medicine Name</th>
                <th>Medicine Type</th>
                <th>Quantity</th>
                <th>Checkup Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['log_id'] ?></td>
                        <td><?= $row['fname'] . ' ' . $row['lname'] ?></td>
                        <td><?= $row['medicine_name'] ?></td>
                        <td><?= $row['medicine_type'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['checkup_date'] ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="6">No records found for the selected month and year.</td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total Quantity:</strong></td>
                <td colspan="2"><strong><?= $total_quantity ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
