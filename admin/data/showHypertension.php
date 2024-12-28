<?php
include 'dbcon.php';

// Capture filter inputs
$month = isset($_GET['month']) ? intval($_GET['month']) : 0;
$year = isset($_GET['year']) ? intval($_GET['year']) : 0;

// Construct the SQL query with filtering conditions
$query = "SELECT h.hypertension_id, CONCAT(r.fname, ' ', r.mname, ' ', r.lname) AS full_name, h.checkup_date, h.medicine_type, h.blood_pressure, h.remarks_type 
          FROM hypertension h 
          JOIN residents r ON h.resident_id = r.id";

// Add filtering conditions if month and/or year are specified
if ($month > 0 && $year > 0) {
    $query .= " WHERE MONTH(h.checkup_date) = $month AND YEAR(h.checkup_date) = $year";
} elseif ($year > 0) {
    $query .= " WHERE YEAR(h.checkup_date) = $year";
} elseif ($month > 0) {
    $query .= " WHERE MONTH(h.checkup_date) = $month";
}

$query .= " ORDER BY h.checkup_date DESC";

$result = $conn->query($query);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='color: #333;'>" . $row['full_name'] . "</td>";
        echo "<td style='color: #333;'>" . $row['checkup_date'] . "</td>";
        echo "<td style='color: #333;'>" . $row['medicine_type'] . "</td>";
        echo "<td style='color: #333;'>" . $row['blood_pressure'] . "</td>";
        echo "<td style='color: #333;'>" . $row['remarks_type'] . "</td>";
        echo "<td>
                 <select style='background-color:#1e80c1;color:white;border:none;padding:10px 20px;' onchange='location = this.value;'>
                    <option value=''>Action</option>
                    <option value='view/view_services8.php?id=" . $row['hypertension_id'] . "'>View</option>
                    <option value='view/services8.php?id=" . $row['hypertension_id'] . "'>Update</option>
                    <option value='view/deletehypertension.php?id=" . $row['hypertension_id'] . "'>Delete</option>
                </select>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}

$conn->close();
?>
