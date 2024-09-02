<?php
// Generating account sample
include "dbcon.php";

$fname = "Juan";
$lname = "Dela Cruz";
$cpNum = "091234567890";
$email = "admin@gmail.com";
$pass = "adminadmin1234";
$user_type = "System Administrator";
$hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

$sql = "INSERT INTO `administrator` (`id`, `firstname`, `lastname`, `cpnumber`, `email`, `password`, `user_type`) VALUES (1, '$fname', '$lname', '$cpNum', '$email', '$hashedPassword', '$user_type')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>