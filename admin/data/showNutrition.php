<?php
include "dbcon.php";

$yearFilter = isset($_GET['year']) ? intval($_GET['year']) : null;
$monthFilter = isset($_GET['month']) ? intval($_GET['month']) : null;

// Construct the SQL query based on the year and month filter
$sql = "SELECT * FROM nutrition WHERE 1";

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
    echo '<script>var nutritionData = ' . json_encode($rows) . ';</script>';

    // Display only a subset of the rows initially
    $startIndex = 0;
    $endIndex = min(15, count($rows));

    // Function to format dates
    function formatDate($date) {
        $dateObj = new DateTime($date);
        return $dateObj->format('F j, Y'); // Formats as "January 1, 2029"
    }

    for ($i = $startIndex; $i < $endIndex; $i++) {
        $row = $rows[$i]; // Fetch the current row

        // Format the registration date and birth date
        $formattedRegDate = formatDate($row['reg']);
        $formattedBday = formatDate($row['bday']);

        echo "<tr ";
        if ($even % 2 == 1) {
            echo "style='background-color:rgb(243,244,245);'";
        }
        echo "><th class='names'> " . $row['lname'] . ", " . $row['fname'] . " " . $row['mname'] . "</th>";
        echo "<th> " . $formattedRegDate . "</th>"; // Display formatted reg date
        echo "<th> " . $formattedBday . "</th>"; // Display formatted birth date
        echo "<th> " . $row['se_status'] . "</th>";
        echo "<th> " . $row['sex'] . "</th>";
        echo "<th> " . $row['zone'] . "</th>";
        echo "<th class='lastCol'> <select style='background-color:#006BDD;color:white;border:none;padding:10px 20px;'  onchange='location = this.value;' >";
        echo "<option value='' selected hidden>Action</option>";
        echo "<option value='view/view_services2.php?view=" . $row['id'] . "'>View</option>";
        echo "<option value='view/services2.php?update=" . $row['id'] . "'>Update</option>";
        echo "<option value='view/delete_services2.php?id=" . $row['id'] . "'>Delete</option>";
        echo "</select> </th></tr>";
        $even++;
    }
} else {
    echo "No data found.";
}
?>
