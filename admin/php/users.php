<?php
session_start();
include_once "dbcon.php"; // Include your database connection

// Ensure the user is logged in and their unique_id is set in the session
if (!isset($_SESSION['unique_id'])) {
    echo "User not logged in.";
    exit;
}

$outgoing_id = $_SESSION['unique_id'];

// Updated query using sender_id and receiver_id
$sql = "SELECT u.*, MAX(m.id) AS latest_msg_id
    FROM users u
    LEFT JOIN (
        SELECT sender_id AS user_id, id
        FROM messages
        WHERE receiver_id = {$_SESSION['unique_id']}
        UNION ALL
        SELECT receiver_id AS user_id, id
        FROM messages
        WHERE sender_id = {$_SESSION['unique_id']}
    ) m ON u.unique_id = m.user_id
    WHERE u.unique_id != {$_SESSION['unique_id']} AND m.user_id IS NOT NULL
    GROUP BY u.unique_id
    ORDER BY latest_msg_id DESC";

$query = mysqli_query($conn, $sql);

// Initialize output variable
$output = "";

// Check if there are any results
if (mysqli_num_rows($query) == 0) {
    $output .= "Search a user to start a conversation";
} else {
    // Include the file to display user data
    include_once "data.php"; // This file will handle how to display each user
}

echo $output;
?>
