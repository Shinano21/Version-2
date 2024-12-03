<?php 
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "dbcon.php";
    $outgoing_id = $_SESSION["unique_id"];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?)
            OR (outgoing_msg_id = ? AND incoming_msg_id = ?) ORDER BY msg_id";

    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "iiii", $outgoing_id, $incoming_id, $incoming_id, $outgoing_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                // Output the chat message
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    // Mark the message as read
                    $msg_id = $row['msg_id'];
                    mysqli_query($conn, "UPDATE messages SET status = 'read' WHERE msg_id = $msg_id");

                    $output .= '<div class="chat incoming">
                                <img src="../uploads/'.$row['profile_image'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages yet.</div>';
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle the error if the prepared statement fails
        die("SQL statement preparation failed");
    }

    echo $output;
} else {
    header("location: ../login.php");
}
?>
