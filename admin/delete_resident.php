<?php
include "dbcon.php";
$idx = $_GET["id"];
$sql = "DELETE FROM residents WHERE id = '$idx'";
    
if (mysqli_query($conn, $sql)) {
    header("Location: residents.php?deleted=success");
}
?>