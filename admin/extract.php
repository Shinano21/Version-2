<?php 
include "dbcon.php";

$sql = [];

$query = "SELECT * FROM residents WHERE `status` = 'Active'";
$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sql[] = $row;
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

echo json_encode($sql);
?>