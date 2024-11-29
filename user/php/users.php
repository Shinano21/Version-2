<?php
session_start();
include_once "dbcon.php";

// Ensure session ID is available
$outgoing_id = $_SESSION['unique_id']; 

$sql = "
    SELECT u.*, MAX(m.msg_id) AS latest_msg_id, u.type
    FROM (
        -- Users
        SELECT unique_id AS id, first_name, last_name, profile_image, status, 'user' AS type
        FROM users
        WHERE unique_id != {$outgoing_id}
        
        UNION
        
        -- Admins
        SELECT id AS id, firstname AS first_name, lastname AS last_name, pfp AS profile_image, a_status AS status, 'admin' AS type
        FROM administrator
        WHERE id != {$outgoing_id}
    ) u
    LEFT JOIN (
        -- Messages
        SELECT incoming_msg_id AS user_id, msg_id
        FROM messages
        WHERE outgoing_msg_id = {$outgoing_id}
        UNION ALL
        SELECT outgoing_msg_id AS user_id, msg_id
        FROM messages
        WHERE incoming_msg_id = {$outgoing_id}
    ) m ON u.id = m.user_id
    WHERE m.user_id IS NOT NULL
    GROUP BY u.id
    ORDER BY latest_msg_id DESC";
        
$query = mysqli_query($conn, $sql);

$output = "";
if(mysqli_num_rows($query) == 0){
    $output .= "Search a user to start a conversation";
} elseif(mysqli_num_rows($query) > 0) {
    include_once "data.php";
}
echo $output;
?>
