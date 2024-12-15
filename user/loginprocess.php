<?php
// Working!
// Login system for residents
include "dbcon.php";
session_start();
if(isset($_POST["submit"])){
   // echo $_POST["username"];
   if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  $user = $_POST["user"];
  $password= ($_POST["password"]);
  
  $sql = "SELECT * FROM `users` WHERE email='$user' ;";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    // User found, now check the password
    $row = mysqli_fetch_assoc($result);
    $storedPassword = $row["password"];

    // Check if the entered password matches the stored hashed password
    if (password_verify($password, $storedPassword)) {
        // Passwords match, set session variables and redirect to home.php
        $_SESSION["firstname"] = $row["firstname"];
        $_SESSION["lastname"] = $row["lastname"];
        $_SESSION["user"] = $row["user"];
        $_SESSION["unique_id"] = $row["unique_id"];
        $status = "Active now";
        $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
        header("Location: index.php");
        exit();
    } else {
        // Passwords don't match
        header("Location: login.php?error=Incorrect Password");
        exit();
    }
} else {
    // User not found
    header("Location: login.php?error=User Not Found");
    exit();
}
  
}
?>
