<?php
    session_start();
    include_once "dbcon.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT u.*, MAX(m.msg_id) AS latest_msg_id
    FROM users u
    LEFT JOIN (
        SELECT incoming_msg_id AS user_id, msg_id
        FROM messages
        WHERE outgoing_msg_id = {$_SESSION['unique_id']}
        UNION ALL
        SELECT outgoing_msg_id AS user_id, msg_id
        FROM messages
        WHERE incoming_msg_id = {$_SESSION['unique_id']}
    ) m ON u.unique_id = m.user_id
    WHERE u.unique_id != {$_SESSION['unique_id']} AND m.user_id IS NOT NULL
    GROUP BY u.unique_id
    ORDER BY latest_msg_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Search a user to start a conversation";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>