<?php
session_start();
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
        .filter-container {
    display: flex;
    justify-content: space-between; /* Align form to the left and button to the right */
    align-items: center; /* Vertically align elements */
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
    padding: 10px;
    gap: 20px; /* Adds space between elements when they wrap */
}

.filter-form form {
    display: flex;
    align-items: center; /* Vertically align form elements */
    gap: 10px; /* Adds spacing between form elements */
}

.filter-form label {
    margin-right: 5px; /* Adds space between the label and the dropdown */
}

.filter-form select {
    padding: 5px 10px;
    font-size: 14px;
}

.filter-form button {
    padding: 6px 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.filter-form button:hover {
    background-color: #0056b3;
}

.no-print button {
    background-color: #6DC066;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    width: 130px;
}

.no-print button:hover {
    background-color: #5CA556;
}

@media print {
    .filter-container {
        display: none; /* Hides the Print button during printing */
    }
}

    </style>
</head>
<body>
<div class="filter-container">
    <!-- Filter Form -->
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

    <button type="submit" style="background-color: #4D869C; width:130px; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Filter</button>
        </form>
    </div>

    <!-- Print Button -->
    <div class="no-print">
        <button onclick="window.print()">Print Report</button>
    </div>
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
    <div class="report-header">
        <h1>Medicine Received Report</h1>
        <p>Month: <?= date('F', mktime(0, 0, 0, $month, 1)) ?>, Year: <?= $year ?></p>
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

  
</body>
</html>
