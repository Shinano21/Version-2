<?php
// Ensure connection is included
include('../dbcon.php');

// SQL query
$query = "SELECT ab.*, r.fname AS first_name, r.lname AS last_name
          FROM animal_bite_records ab
          JOIN residents r ON ab.resident_id = r.id";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    // Output the error message
    die("Query failed: " . mysqli_error($conn));
}

// Fetch and display the results
while ($row = mysqli_fetch_assoc($result)) {
    $fullName = $row['first_name'] . ' ' . $row['last_name'];
    echo "<tr>";
    echo "<td>{$fullName}</td>";
    echo "<td>{$row['bite_date']}</td>";
    echo "<td>{$row['treatment_date']}</td>";
    echo "<td>{$row['bite_location']}</td>";
    echo "<td>{$row['treatment_center']}</td>";
    echo "<td>{$row['remarks']}</td>";
    echo "<td style='display: flex; justify-content:center;'>
            <select style='background-color:#1e80c1;color:white;border:none;padding:10px 20px;' onchange='location = this.value;'>
                <option value='' selected hidden>Action</option>
                <option value='edit_animal_bite.php?id={$row['id']}'>Edit</option>
                <option value='view/delete_animal_bite.php?id={$row['id']}'>Delete</option>
            </select>
          </td>";
    echo "</tr>";
}
?>
