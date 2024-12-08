<?php
include "dbcon.php"; // Include the database connection file

// Prepare filters for date range if needed
$yearFilter = isset($_GET['year']) ? intval($_GET['year']) : null;
$monthFilter = isset($_GET['month']) ? intval($_GET['month']) : null;

// Construct the SQL query based on the year and month filter
$sql = "SELECT p.prenatal_id, r.fname, r.lname, p.checkup_date, p.gestational_age, 
               p.blood_pressure, p.weight, p.fetal_heartbeat, p.remarks 
        FROM prenatal p 
        JOIN residents r ON p.resident_id = r.id 
        WHERE 1"; // Joining prenatal and residents table

// Add filters for year and month if specified
if ($yearFilter !== null) {
    $sql .= " AND YEAR(p.checkup_date) = $yearFilter";

    if ($monthFilter !== null) {
        $sql .= " AND MONTH(p.checkup_date) = $monthFilter";
    }
}

$sql .= " ORDER BY p.checkup_date DESC"; // Order by checkup date

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    $even = 0; // To alternate row colors

    

    // Output each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        $rowColor = $even % 2 == 1 ? "style='background-color: rgb(243, 244, 245);'" : "";
        echo "<tr $rowColor>";
        echo "<td>" . htmlspecialchars($row['lname'] . ", " . $row['fname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['checkup_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['gestational_age']) . " weeks</td>";
        echo "<td>" . htmlspecialchars($row['blood_pressure']) . "</td>";
        echo "<td>" . htmlspecialchars($row['weight']) . " kg</td>";
        echo "<td>" . htmlspecialchars($row['fetal_heartbeat']) . "</td>";
        echo "<td>" . htmlspecialchars($row['remarks']) . "</td>";
        echo "<td>
                <select style='background-color: #006BDD; color: white; border: none; padding: 10px 20px;' onchange='location = this.value;'>
                    <option value='' selected hidden>Action</option>
                    <option value='view/view_services7.php?view=" . urlencode($row['prenatal_id']) . "'>View</option>
                    <option value='view/services7.php?id=" . urlencode($row['prenatal_id']) . "'>Update</option>
                    <option value='view/delete_prenatal.php?id=" . urlencode($row['prenatal_id']) . "'>Delete</option>
                </select>
              </td>";
        echo "</tr>";
        $even++;
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "<p style='color: red; font-weight: bold;'>No data found.</p>";
}
?>
