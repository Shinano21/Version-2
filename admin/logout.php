<?php
// Start the session
session_start();

// Unset all of the session variables
include_once 'dbcon.php';
$status = "Offline now";
$logout_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id='{$logout_id}'");
if($sql){
    $_SESSION = array();
    session_unset();
    session_destroy();
}else{  
   echo "no log out id ";
}


// Redirect to the login page or any other desired page after logout
header("Location:index.php");

?>