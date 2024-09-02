<?php 
include("../dbcon.php");
function countResidentsInZone($conn, $zone) {
    $sql = "SELECT COUNT(*) as total_residents FROM residents WHERE zone = '$zone' AND `status` = 'active'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_residents'];
    } else {
        return "Error: " . mysqli_error($conn);
    }
}
// Fetch distinct zones from the database
$sql_zones = "SELECT DISTINCT zone FROM residents ORDER BY zone ASC";
$result_zones = mysqli_query($conn, $sql_zones);

if ($result_zones) {
    while ($row_zone = mysqli_fetch_assoc($result_zones)) {
        $zone_name = $row_zone['zone'];
        $totalResidents = countResidentsInZone($conn, $zone_name);
?>
<tr>
    <th><?php echo $zone_name; ?></th>
    <th><?php echo $totalResidents; ?></th>
</tr>

<?php
    }
} else {
    echo "Error fetching zones: " . mysqli_error($conn);
}
?>