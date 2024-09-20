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
    echo "<td>
            <a href='edit_animal_bite.php?id={$row['id']}'>Edit</a> |
            <a href='delete_animal_bite.php?id={$row['id']}'>Delete</a>
          </td>";
    echo "</tr>";
}
?>
