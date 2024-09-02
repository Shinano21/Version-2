<?php
include "../dbcon.php";
$idx = $_GET["id"];
$sql = "DELETE FROM anti_pneumonia WHERE id = '$idx'";
mysqli_query($conn, $sql);

header("Location: ../services5.php?deleted=success");

?>