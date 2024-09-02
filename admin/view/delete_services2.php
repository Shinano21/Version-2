<?php
include "../dbcon.php";
$idx = $_GET["id"];
$sql = "DELETE FROM nutrition WHERE id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM nutrition_1 WHERE nutrition_id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM nutrition_2 WHERE nutrition_id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM nutrition_3 WHERE nutrition_id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM nutrition_4 WHERE nutrition_id = '$idx'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM nutrition_5 WHERE nutrition_id = '$idx'";
mysqli_query($conn, $sql);

header("Location: ../services2.php?deleted=success");

?>