<?php
include "dbcon.php";

$sql = "SELECT * FROM logo ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $navbarLogo = $row["navbar_logo"];
        $logoPic = $row["logo_pic"];
        $centerName = $row["center_name"];
        $shortDesc = $row["short_desc"];
        $email = $row["email"];
        $contact = $row["contact"];
        $address = $row["address"];
    }
}
?>