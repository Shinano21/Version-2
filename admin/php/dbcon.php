<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "carevisio";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>