<?php 
session_start();
include_once "dbcon.php";

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

// Query to search in both users and administrators tables
$sql = "(SELECT unique_id AS id, first_name, last_name, 'user' AS type, status, profile_image 
         FROM users 
         WHERE unique_id != {$outgoing_id} 
         AND (first_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%'))
        UNION
        (SELECT id, firstname AS first_name, lastname AS last_name, 'admin' AS type, status, pfp AS profile_image 
         FROM administrator 
         WHERE id != {$outgoing_id} 
         AND (firstname LIKE '%{$searchTerm}%' OR lastname LIKE '%{$searchTerm}%'))
        ORDER BY first_name ASC";

$output = "";
$query = mysqli_query($conn, $sql);
if(mysqli_num_rows($query) > 0){
    include_once "data.php";
} else {
    $output .= 'No user or administrator found related to your search term';
}
echo $output;
?>
