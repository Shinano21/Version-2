<?php
include "dbcon.php";

$sql = "SELECT * FROM brgy_health";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $name = $row["name"];
        $position = $row["position"];
        $pic = $row["pic"];
    }
}
?>