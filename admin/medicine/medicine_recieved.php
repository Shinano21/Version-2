<?php
session_start();
include "../dbcon.php";

// Redirect if user is not logged in or user type is System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Initialize variables
$month = date('m'); // Default to current month
$year = date('Y');  // Default to current year

// Check if month and year are set in GET request
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $month = isset($_GET['month']) ? $_GET['month'] : $month;
    $year = isset($_GET['year']) ? $_GET['year'] : $year;
}

// Query to fetch data based on month and year
$query = "SELECT medicine_name, medicine_type, SUM(quantity) AS total_quantity 
          FROM medicine_inventory 
          WHERE MONTH(received_date) = ? AND YEAR(received_date) = ? 
          GROUP BY medicine_name, medicine_type";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("ii", $month, $year);
    $stmt->execute();
    $result = $stmt->get_result();
    $medicines = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    die("Error fetching report: " . $conn->error);
}

// Calculate total quantity of all medicines received
$total_quantity = 0;
foreach ($medicines as $medicine) {
    $total_quantity += $medicine['total_quantity'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Received Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .report-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-header h1 {
            margin: 0;
        }
        .filter-form {
            text-align: center;
            margin-bottom: 20px;
        }
        .filter-form select, .filter-form button {
            padding: 8px;
            margin: 5px;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .report-table th, .report-table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="report-header">
        <h1>Medicine Received Report</h1>
        <p>Month: <?= date('F', mktime(0, 0, 0, $month, 1)) ?>, Year: <?= $year ?></p>
    </div>

    <div class="filter-form">
        <form method="GET" action="">
            <label for="month">Select Month:</label>
            <select name="month" id="month">
                <?php for ($m = 1; $m <= 12; $m++): ?>
                    <option value="<?= $m ?>" <?= $m == $month ? 'selected' : '' ?>>
                        <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                    </option>
                <?php endfor; ?>
            </select>

            <label for="year">Select Year:</label>
            <select name="year" id="year">
                <?php for ($y = date('Y') - 10; $y <= date('Y'); $y++): ?>
                    <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>>
                        <?= $y ?>
                    </option>
                <?php endfor; ?>
            </select>

            <button type="submit">Filter</button>
        </form>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Type</th>
                <th>Total Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($medicines)) : ?>
                <?php foreach ($medicines as $medicine) : ?>
                    <tr>
                        <td><?= htmlspecialchars($medicine['medicine_name']) ?></td>
                        <td><?= htmlspecialchars($medicine['medicine_type']) ?></td>
                        <td><?= (int)$medicine['total_quantity'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">No medicines received for this period.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="total">
        Total Quantity Received: <?= $total_quantity ?>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Print Report</button>
    </div>
</body>
</html>
