<?php
include "dbcon.php";

$sql = "SELECT * FROM contact_us";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $shortMess = $row["short_mess"];
        $email = $row["email"];
        $contact = $row["contact"];
        $address = $row["address"];
        $fbAcc = $row["fb_name"];
        $fbLink = $row["fb_link"];
    }
}
?>