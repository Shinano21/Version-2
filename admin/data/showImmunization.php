<?php
include "dbcon.php";

$yearFilter = isset($_GET['year']) ? intval($_GET['year']) : null;
$monthFilter = isset($_GET['month']) ? intval($_GET['month']) : null;

// Construct the SQL query based on the year and month filter
$sql = "SELECT * FROM immunization WHERE 1";

if ($yearFilter !== null) {
    $sql .= " AND YEAR(reg) = $yearFilter";

    if ($monthFilter !== null) {
        // Display residents registered in the selected month and year
        $sql .= " AND MONTH(reg) = $monthFilter";
    }
}

$sql .= " ORDER BY reg DESC";

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
    echo '<script>var immunizationData = ' . json_encode($rows) . ';</script>';

    // Display only a subset of the rows initially
    $startIndex = 0;
    $endIndex = min(15, count($rows));

    for ($i = $startIndex; $i < $endIndex; $i++) {
        echo "<tr ";
        if ($even % 2 == 1) {
            echo "style='background-color:rgb(243,244,245);'";
        }
        echo "><th class='names'> " . $rows[$i]['lname'] . ", " . $rows[$i]['fname'] . " " . $rows[$i]['mname'] . "</th>";
        echo "<th> " . $rows[$i]['reg'] . "</th>";
        echo "<th> " . $rows[$i]['bday'] . "</th>";
        echo "<th> " . $rows[$i]['se_status'] . "</th>";
        echo "<th> " . $rows[$i]['sex'] . "</th>";
        echo "<th> " . $rows[$i]['zone'] . "</th>";
        echo "<th class='lastCol'> <select style='background-color:#006BDD;color:white;border:none;padding:10px 20px;'  onchange='location = this.value;' >";
        echo "<option value='' selected hidden>Action</option>";
        echo "<option value='view/view_services1.php?view=" . $rows[$i]['id'] . "'>View</option>";
        echo "<option value='view/services1.php?update=" . $rows[$i]['id'] . "'>Update</option>";
        echo "<option value='view/delete_services1.php?id=" . $rows[$i]['id'] . "'>Delete</option>";
        echo "</select> </th></tr>";
        $even++;
    }
} else {
    echo "No data found.";
}
?>
