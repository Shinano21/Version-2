<?php
    while ($row = mysqli_fetch_assoc($query)) {
        // Ensure the outgoing ID is defined
        if (!isset($outgoing_id)) {
            $msg = "No outgoing ID defined";
            continue;
        }

        // Determine the unique ID field based on the type (user or admin)
        $id = null; // Initialize $id as null

        // Check if type exists and assign the correct ID based on the user type
        if (isset($row['type'])) {
            $id = ($row['type'] === 'admin') ? ($row['id'] ?? null) : ($row['unique_id'] ?? null);
        }

        // Skip if no valid ID was found
        if (is_null($id)) {
            $msg = "No valid ID found";
            continue;
        }

        // Fetch the last message for this user or admin
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$id} 
                OR outgoing_msg_id = {$id}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);

        // Check if $row2 is not null
        if ($row2 !== null) {
            $unread = ($row2['status'] == 'unread') ? true : false;
            $result = mysqli_num_rows($query2) > 0 ? $row2['msg'] : "No message available";
            $msg = $unread ? "<b>$result</b>" : $result;
        } else {
            $msg = "No message available";
        }

        // Truncate the message if it's too long
        $msg = (strlen($msg) > 28) ? substr($msg, 0, 28) . '...' : $msg;

        // Determine if the message is from the current user
        $you = ($outgoing_id == $id) ? "You: " : "";

        // Determine the online status
        $offline = ($row['status'] == "Offline now") ? "offline" : "";

        // Use the correct profile image
        $profile_image = isset($row['profile_image']) ? $row['profile_image'] : 'uploads/default.png';

        // Determine correct name fields based on user type
        $firstName = isset($row['first_name']) ? $row['first_name'] : (isset($row['firstname']) ? $row['firstname'] : "Unknown");
        $lastName = isset($row['last_name']) ? $row['last_name'] : (isset($row['lastname']) ? $row['lastname'] : "User");

        // Generate the HTML output
        $output .= '<a href="chat.php?user_id=' . $id . '&user_type=' . $row['type'] . '">
                        <div class="content">
                            <img src="../' . $profile_image . '" alt="">
                            <div class="details">
                                <span>' . $firstName . " " . $lastName . '</span>
                                <p>' . $you . $msg . '</p>
                            </div>
                        </div>
                        <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                    </a>';
    }
?>
