<?php
include "../dbcon.php";
$idx = $_GET["id"];
$sql = "DELETE FROM immunization WHERE id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM immunization_1 WHERE immu_id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM immunization_2 WHERE immu_id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM immunization_3 WHERE immu_id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM immunization_4 WHERE immu_id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM immunization_5 WHERE immu_id = '$idx'";
mysqli_query($conn, $sql);

header("Location: ../services1.php?deleted=success");

?>