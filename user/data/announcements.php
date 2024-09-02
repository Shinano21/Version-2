<?php
include "dbcon.php";

$sql = "SELECT * FROM announcements";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $announceType = $row["announce_type"];
        $announceHeading = $row["announce_heading"];
        $announceBody = $row["announce_body"];
        $announcePic = $row["announce_pic"];
        $announceDate = $row["post_date"];
    }
}
?>