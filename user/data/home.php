<?php
include "dbcon.php";

$sql = "SELECT * FROM home";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        $centerName = $row["center_name"];
        $address = $row["address"];
        $email = $row["email"];
        $contact = $row["contact"];
        $openHours = $row["open_hours"];
        $bgImg = $row["bg_img"];
        $shortDesc = $row["short_desc"];
        $mission = $row["mission"];
        $vision = $row["vision"];
        $goal = $row["goal"];
        $chairman = $row["chairman"];
        $chairmanPic = $row["chairman_pic"];
        $chairmanComm = $row["chairman_comm"];
        $chairmanCommPic = $row["chairman_comm_pic"];
        $sectionPic = $row["section_pic"];
        $contactMess = $row["contact_mess"];
        $officeHrs = $row["office_hrs"];
        $programsPic = $row["programs_pic"];
        $announcePic = $row["announce_pic"];
    }
}
?>