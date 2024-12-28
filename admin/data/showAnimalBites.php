<?php
// Ensure connection is included
include('../dbcon.php');

// Fetch filter inputs
$filterMonth = isset($_GET['month']) ? $_GET['month'] : '';
$filterYear = isset($_GET['year']) ? $_GET['year'] : '';

// Get the search input
$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

// Base SQL query
$query = "SELECT ab.*, 
                 r.fname AS first_name, 
                 r.lname AS last_name, 
                 r.mname AS middle_name, 
                 r.suffix, 
                 r.bday,
                 ab.bite_date, 
                 ab.bite_location, 
                 ab.bitten_location, 
                 ab.treatment_center, 
                 ab.remarks
          FROM animal_bite_records ab
          JOIN residents r ON ab.resident_id = r.id";

// Apply filters and search
$conditions = [];

// Add month filter
if (!empty($filterMonth)) {
    $conditions[] = "MONTH(ab.bite_date) = '$filterMonth'";
}

// Add year filter
if (!empty($filterYear)) {
    $conditions[] = "YEAR(ab.bite_date) = '$filterYear'";
}

// Add search filter
if (!empty($search)) {
    $conditions[] = "CONCAT(r.fname, ' ', r.mname, ' ', r.lname, ' ', r.suffix) LIKE '%$search%'";
}

// Combine conditions into the query
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
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
        echo "<td style='color: #333;'>{$fullName}</td>";
        echo "<td style='color: #333;'>{$row['bday']}</td>";
        echo "<td style='color: #333;'>{$row['bite_date']}</td>";
        echo "<td style='color: #333;'>{$row['bite_location']}</td>";
        echo "<td style='color: #333;'>{$row['bitten_location']}</td>";
        echo "<td style='color: #333;'>{$row['treatment_center']}</td>";
        echo "<td style='color: #333;'>{$row['remarks']}</td>";
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
