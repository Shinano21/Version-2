<?php
include "dbcon.php";

$yearFilter = isset($_GET['year']) ? intval($_GET['year']) : null;
$monthFilter = isset($_GET['month']) ? intval($_GET['month']) : null;

// Construct the SQL query based on the year and month filter
$sql = "SELECT * FROM family_planning WHERE 1";

if ($yearFilter !== null) {
    $sql .= " AND YEAR(date_of_registration) = $yearFilter";

    if ($monthFilter !== null) {
        // Display residents registered in the selected month and year
        $sql .= " AND MONTH(date_of_registration) = $monthFilter";
    }
}

$sql .= " ORDER BY date_of_registration DESC";

// Execute the query
$result = mysqli_query($conn, $sql);

$even = 0;

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    $rows = array(); // Array to store rows

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row; // Store each row in the array
    }

    // Pass the rows array to JavaScript as JSON
    echo '<script>var familyData = ' . json_encode($rows) . ';</script>';

    // Display only a subset of the rows initially
    $startIndex = 0;
    $endIndex = min(15, count($rows));

    for ($i = $startIndex; $i < $endIndex; $i++) {
        $row = $rows[$i]; // Fetch the current row
    
        echo "<tr ";
        if ($even % 2 == 1) {
            echo "style='background-color:rgb(243,244,245);'";
        }
        echo "><th class='names'> " . $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name']  . "</th>";
        echo "<th> " . $row['date_of_registration'] . "</th>";
        echo "<th> " . $row['date_of_birth'] . "</th>";
        echo "<th> " . $row['se_status'] . "</th>";
        echo "<th> " . $row['zone'] . "</th>";
        echo "<th> " . $row['source'] . "</th>";
        echo "<th class='lastCol'> <select style='background-color:#1e80c1;color:white;border:none;padding:10px 20px;'  onchange='location = this.value;' >";
        echo "<option value='' selected hidden>Action</option>";
        echo "<option value='view/view_services3.php?update=".$row['id']."'>View</option>";
        echo "<option value='view/services3.php?update=".$row['id']."'>Update</option>";
        echo "<option value='view/delete_services3.php?id=".$row['id']."'>Delete</option>";
        echo "</select> </th></tr>";
        $even++;
    }
    
} else {
    echo "No data found.";
}
?>
