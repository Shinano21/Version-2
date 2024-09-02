<?php
include "../dbcon.php";
$idx = $_GET["id"];
$sql = "DELETE FROM family_planning WHERE id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM family_planning_sched WHERE family_id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM family_plan_rem WHERE family_id = '$idx'";
mysqli_query($conn, $sql);

header("Location: ../services3.php?deleted=success");

?>