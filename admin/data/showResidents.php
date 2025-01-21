<?php
    include "dbcon.php";

    $yearFilter = isset($_GET['year']) ? intval($_GET['year']) : null;
    $monthFilter = isset($_GET['month']) ? intval($_GET['month']) : null;

    // Construct the SQL query based on the year and month filter
    $sql = "SELECT * FROM residents WHERE status = 'active'";
    if ($yearFilter !== null && $monthFilter !== null) {
        $sql .= " AND (YEAR(bday) < $yearFilter OR (YEAR(bday) = $yearFilter AND MONTH(bday) <= $monthFilter))";
    }
    $sql .= " ORDER BY lname";

    $result = mysqli_query($conn, $sql);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        $rows = array(); // Array to store rows

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row; // Store each row in the array
        }

        // Pass the rows array to JavaScript as JSON
        echo '<script>var residentData = ' . json_encode($rows) . ';</script>';

        // Display all rows
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<th class='names'> " . $row['lname'] . ", " . $row['fname'] . " " . $row['mname'] . "</th>";
            echo "<th> " . $row['sex'] . "</th>";
            $dob = new DateTime($row["bday"]);
            $today = new DateTime();
            $age = $today->diff($dob)->y;
            echo "<th> " . $age . "</th>";
            echo "<th> " . $row['bday'] . "</th>";
            echo "<th> " . $row['zone'] . "</th>";
            echo "<th> " . $row['contact'] . "</th>";
            echo "<th> <select style='background-color:#006BDD;color:white;border:none;padding:10px 20px;' onchange='handleAction(this.value, " . $row['id'] . ")'>";
            echo "<option value='' selected hidden>Action</option>";
            echo "<option value='view'>View</option>";
            echo "<option value='update'>Update</option>";
            echo "<option value='delete'>Delete</option>";
            echo "</select> </th></tr>";
        }
    } else {
        echo "No data found.";
    }
?>


<!-- Modal -->
<div id="deleteModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:10;">
    <div style="position:relative; margin:10% auto; padding:20px; background:white; width:50%; border-radius:8px; text-align:center;">
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete this resident?</p>
        <button id="confirmDelete" style="background:red; color:white; padding:10px 20px; border:none; border-radius:5px;">Yes</button>
        <button onclick="closeModal()" style="background:gray; color:white; padding:10px 20px; border:none; border-radius:5px;">No</button>
    </div>
</div>

<script>
    let residentIdToDelete = null;

    function handleAction(action, id) {
        if (action === "view") {
            location.href = `view_resident.php?id=${id}`;
        } else if (action === "update") {
            location.href = `update.php?id=${id}`;
        } else if (action === "delete") {
            residentIdToDelete = id;
            document.getElementById("deleteModal").style.display = "block";
        }
    }

    function closeModal() {
    document.getElementById("deleteModal").style.display = "none";
    residentIdToDelete = null;
    window.location.href = "./residents.php"; // Redirect to residents.php
}


    document.getElementById("confirmDelete").addEventListener("click", function () {
        if (residentIdToDelete !== null) {
            location.href = `delete_resident.php?id=${residentIdToDelete}`;
        }
    });
</script>
