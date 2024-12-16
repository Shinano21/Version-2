<?php
// Ensure connection is included
include('../dbcon.php');

// Fetch filter inputs
$filterMonth = isset($_GET['month']) ? $_GET['month'] : '';
$filterYear = isset($_GET['year']) ? $_GET['year'] : '';

// SQL query to fetch data including filters
$query = "SELECT ab.*, r.fname AS first_name, r.lname AS last_name, r.mname AS middle_name, r.suffix, r.sex, r.bday
          FROM animal_bite_records ab
          JOIN residents r ON ab.resident_id = r.id";

// Apply filters
$conditions = [];
if ($filterMonth) {
    $conditions[] = "MONTH(ab.bite_date) = '$filterMonth'";
}
if ($filterYear) {
    $conditions[] = "YEAR(ab.bite_date) = '$filterYear'";
}
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Get the search input
$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

// SQL query with search functionality
$query = "SELECT ab.*, r.fname AS first_name, r.lname AS last_name, r.mname AS middle_name, r.suffix, r.bday,
                 ab.bite_date, ab.bite_location, ab.bitten_location, ab.treatment_center, ab.remarks
          FROM animal_bite_records ab
          JOIN residents r ON ab.resident_id = r.id";

// Add search condition
if (!empty($search)) {
    $query .= " WHERE CONCAT(r.fname, ' ', r.mname, ' ', r.lname, ' ', r.suffix) LIKE '%$search%'";
}

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Fetch and display the results
    while ($row = mysqli_fetch_assoc($result)) {
        $fullName = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' ' . $row['suffix'];
        
        echo "<tr>";
        echo "<td>{$fullName}</td>";
        echo "<td>{$row['bday']}</td>";
        echo "<td>{$row['bite_date']}</td>";
        echo "<td>{$row['bite_location']}</td>";
        echo "<td>{$row['bitten_location']}</td>";
        echo "<td>{$row['treatment_center']}</td>";
        echo "<td>{$row['remarks']}</td>";
        echo "<td style='display: flex; justify-content:center;'>
               <select style='background-color:#1e80c1;color:white;border:none;padding:10px 20px;' onchange='location = this.value;'>
                   <option value='' selected hidden>Action</option>
                   <option value='view/view_services6.php?id={$row['id']}'>View</option>
                   <option value='view/services6.php?id={$row['id']}'>Update</option>
                   <option value='view/delete_animal_bite.php?id={$row['id']}'>Delete</option>
               </select>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No records found.</td></tr>";
}
?>
