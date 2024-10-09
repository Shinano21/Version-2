<?php
while($row = mysqli_fetch_assoc($query)){
    // Update the query to use sender_id and receiver_id instead of incoming_msg_id and outgoing_msg_id
    $sql2 = "SELECT * FROM messages WHERE (sender_id = {$row['unique_id']} OR receiver_id = {$row['unique_id']}) 
             AND (sender_id = {$outgoing_id} OR receiver_id = {$outgoing_id}) 
             ORDER BY id DESC LIMIT 1"; // 'id' is the primary key column in your messages table
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);

    // Check if $row2 is not null
    if($row2 !== null) {
        if(mysqli_num_rows($query2) > 0) {
            $result = $row2['message']; // Use 'message' column
        } else {
            $result = "No message available";
        }
        
        // Check if the message status is unread (add status column to your messages table if needed)
        $status = $row2['status'] ?? 'read'; // Default to 'read' if status is not set
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
                <img src="../user/images/'. $row['img'] .'" alt="">
                <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                <div class="details">
                    <span>'. $row['first_name'] . " " . $row['last_name'] .'</span>
                    <p>'. $you . $msg .'</p>
                </div>
                </div>
            </a>';
}
?>
