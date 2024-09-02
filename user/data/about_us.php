<?php
include "dbcon.php";

$sql = "SELECT * FROM about";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        $headerPic = $row["header_pic"];
        $sectionHead = $row["section_head"];
        $sectionSubhead = $row["section_subhead"];
        $sectionBody = $row["section_body"];
        $sectionPic = $row["section_pic"];
        $mission = $row["mission"];
        $vision = $row["vision"];
        $missionPic = $row["mission_pic"];
        $visionPic = $row["vision_pic"];
    }
}
?>