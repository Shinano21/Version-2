<?php
while ($row = mysqli_fetch_assoc($query)) {
    // Ensure the outgoing ID is defined
    if (!isset($outgoing_id)) {
        echo "No outgoing ID defined.<br>";
        continue;
    }

    // Initialize $id as null
    $id = null;

    // Use the common 'id' column for both users and admins
    $id = isset($row['id']) ? $row['id'] : null;

    // If ID is invalid, print the row for debugging
    if (is_null($id)) {
        echo "Invalid ID for: ";
        print_r($row); // Debugging step to check the structure of the row
        continue; // Skip if ID is invalid
    }

    // Fetch the last message for this user or admin
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$id} 
            OR outgoing_msg_id = {$id}) AND (outgoing_msg_id = {$outgoing_id} 
            OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);

    // Check if $row2 is not null and get the last message
    $msg = "No message available";
    if ($row2 !== null) {
        $unread = ($row2['status'] == 'unread') ? true : false;
        $result = mysqli_num_rows($query2) > 0 ? $row2['msg'] : "No message available";
        $msg = $unread ? "<b>$result</b>" : $result;
    }

    // Truncate the message if it's too long
    $msg = (strlen($msg) > 28) ? substr($msg, 0, 28) . '...' : $msg;

    // Determine if the message is from the current user
    $you = ($outgoing_id == $id) ? "You: " : "";

    // Determine the online status (Offline or Active)
    $offline = ($row['status'] == "Offline now") ? "offline" : "";

    // Use the correct profile image or default if not set
    $profile_image = isset($row['profile_image']) ? $row['profile_image'] : '../uploads/doctor.png';

    // Generate the HTML output for each user/admin in the search results
    $output .= '<a href="chat.php?user_id=' . $id . '&user_type=' . $row['type'] . '">
                    <div class="content">
                        <img src="../uploads/' . $profile_image . '" alt="">
                        <div class="details">
                            <span>' . $row['first_name'] . " " . $row['last_name'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
?>
