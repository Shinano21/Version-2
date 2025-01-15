<?php
include "../dbcon.php";

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
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <h1>Medicine Distribution Report</h1>

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

            <button type="submit">Filter</button>
            <button type="button" onclick="window.print();">Print</button>
        </form>
    </div>

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
