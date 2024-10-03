<?php
include 'dbcon.php'; 

$query = "SELECT h.hypertension_id, CONCAT(r.fname, ' ', r.mname, ' ', r.lname) AS full_name, h.checkup_date, h.medicine_type, h.blood_pressure, h.remarks_type 
          FROM hypertension h 
          JOIN residents r ON h.resident_id = r.id 
          ORDER BY h.checkup_date DESC";

$result = $conn->query($query);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['full_name'] . "</td>"; // Display the full name
        echo "<td>" . $row['checkup_date'] . "</td>";
        echo "<td>" . $row['medicine_type'] . "</td>";
        echo "<td>" . $row['blood_pressure'] . "</td>";
        echo "<td>" . $row['remarks_type'] . "</td>";
        echo "<td>
                <select onchange='window.location.href=this.value'>
    <option value=''>Select Action</option>
    <option value='view/view_services8.php?view=" . $row['hypertension_id'] . "'>View</option>
    <option value='view/services8.php?id=" . $row['hypertension_id'] . "'>Update</option>
    <option value='view/delete_services8.php?id=" . $row['hypertension_id'] . "'>Delete</option>
</select>

              </td>";
        echo "</tr>";
    }
}

 else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}

$conn->close();
?>
