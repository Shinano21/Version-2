<?php
while($row = mysqli_fetch_assoc($query)){
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
            OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
            OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    
    // Check if $row2 is not null
    if($row2 !== null) {
        if(mysqli_num_rows($query2) > 0) {
            $result = $row2['msg'];
        } else {
            $result = "No message available";
        }
        // Check if the message status is unread
        $status = $row2['status'];
        if($status == "unread") {
            $msg = "<b>$result</b>"; // Wrap the result in <b> tags if status is unread
        } else {
            $msg = $result; // Otherwise, display the result as it is
        }
    } else {
        // If $row2 is null, set $msg to a default value
        $msg = "No message available";
    }
    
    // Truncate the message if it's too long
    $msg = (strlen($msg) > 28) ? substr($msg, 0, 28) . '...' : $msg;

    // Determine if the message is from the current user
    $you = ($outgoing_id == $row['unique_id']) ? "You: " : "";

    // Determine the user's online status
    $offline = ($row['status'] == "Offline now") ? "offline" : "";

    // Generate the HTML output
    $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                <div class="content">
                <img src="../'. $row['profile_image'] .'" alt="">
                <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                <div class="details">
                    <span>'. $row['first_name']. " " . $row['last_name'] .'</span>
                    <p>'. $you . $msg .'</p>
                </div>
                </div>
                
            </a>';
}

?>
