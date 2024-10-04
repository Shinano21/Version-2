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

if ($yearFilter !== null) {
    $sql .= " AND YEAR(p.checkup_date) = $yearFilter"; // Filter by year

    if ($monthFilter !== null) {
        // Filter by month if a year is selected
        $sql .= " AND MONTH(p.checkup_date) = $monthFilter";
    }
}

$sql .= " ORDER BY p.checkup_date DESC"; // Order by checkup date

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    $even = 0; // To alternate row colors
    echo '<table>';
    echo '<tr>
            <th>Name</th>
            <th>Checkup Date</th>
            <th>Gestational Age</th>
            <th>Blood Pressure</th>
            <th>Weight</th>
            <th>Fetal Heartbeat</th>
            <th>Remarks</th>
            <th>Actions</th>
          </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr ";
        if ($even % 2 == 1) {
            echo "style='background-color:rgb(243,244,245);'";
        }
        echo ">";
        echo "<td>" . $row['lname'] . ", " . $row['fname'] . "</td>";
        echo "<td>" . $row['checkup_date'] . "</td>";
        echo "<td>" . $row['gestational_age'] . " weeks</td>";
        echo "<td>" . $row['blood_pressure'] . "</td>";
        echo "<td>" . $row['weight'] . " kg</td>";
        echo "<td>" . $row['fetal_heartbeat'] . "</td>";
        echo "<td>" . $row['remarks'] . "</td>";
        echo "<td>
                <select style='background-color:#006BDD;color:white;border:none;padding:10px 20px;' onchange='location = this.value;'>
                    <option value='' selected hidden>Action</option>
                    <option value='view/view_services7.php?view=" . $row['prenatal_id'] . "'>View</option>
                    <option value='view/services7.php?id=" . $row['prenatal_id'] . "'>Update</option>
                    <option value='view/delete_prenatal.php?id=" . $row['prenatal_id'] . "'>Delete</option>
                </select>
              </td>";
        echo "</tr>";
        $even++;
    }
    echo '</table>';
} else {
    echo "No data found.";
}
?>
