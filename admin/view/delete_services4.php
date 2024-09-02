<?php
include "../dbcon.php";
$idx = $_GET["id"];
$sql = "DELETE FROM influenza_vaccination WHERE id = '$idx'";
mysqli_query($conn, $sql);

header("Location: ../services4.php?deleted=success");

?>