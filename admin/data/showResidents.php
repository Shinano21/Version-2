<?php
    include "dbcon.php";

    $yearFilter = isset($_GET['year']) ? intval($_GET['year']) : null;
    $monthFilter = isset($_GET['month']) ? intval($_GET['month']) : null;

    // Construct the SQL query based on the year and month filter
    $sql = "SELECT * FROM residents WHERE status = 'active'";
    if ($yearFilter !== null && $monthFilter !== null) {
        // Display residents born before or in the selected month and year
        $sql .= " AND (YEAR(bday) < $yearFilter OR (YEAR(bday) = $yearFilter AND MONTH(bday) <= $monthFilter))";
    }
    $sql .= " ORDER BY lname";

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
        echo '<script>var residentData = ' . json_encode($rows) . ';</script>';

        // Display all rows
        for ($i = 0; $i < count($rows); $i++) {
            echo "<tr ";
            if ($even % 2 == 1) {
                echo "style='background-color:rgb(243,244,245);'";
            }
            echo "><th class='names'> " . $rows[$i]['lname'] . ", " . $rows[$i]['fname'] . " " . $rows[$i]['mname'] . "</th>";
            echo "<th> " . $rows[$i]['sex'] . "</th>";
            $dob = new DateTime($rows[$i]["bday"]);
            $today = new DateTime();
            $age = $today->diff($dob)->y;
            echo "<th> " . $age . "</th>";
            echo "<th> " . $rows[$i]['bday'] . "</th>";
            echo "<th> " . $rows[$i]['zone'] . "</th>";
            echo "<th> " . $rows[$i]['contact'] . "</th>";
            echo "<th> <select style='background-color:#006BDD;color:white;border:none;padding:10px 20px;'  onchange='location = this.value;'>";
            echo "<option value='' selected hidden>Action</option>";
            echo "<option value='view_resident.php?id=" . $rows[$i]['id'] . "'>View</option>";
            echo "<option value='update.php?id=" . $rows[$i]['id'] . "'>Update</option>";
            echo "<option value='delete_resident.php?id=" . $rows[$i]['id'] . "'>Delete</option>";
            echo "</select> </th></tr>";
            $even++;
        }
    } else {
        echo "No data found.";
    }
?>
