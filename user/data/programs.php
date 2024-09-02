<?php
include "dbcon.php";

$sql = "SELECT * FROM programs";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $progType = $row["program_type"];
        $progHeading = $row["prog_heading"];
        $progBody = $row["prog_body"];
        $progPic = $row["prog_pic"];
        $date = $row["post_date"];
    }
}
?>