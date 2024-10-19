<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "dbcon.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";

        // Update status of incoming messages to 'read'
        $update_status_sql = "UPDATE messages 
                              SET status = 'read' 
                              WHERE incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = {$incoming_id} AND status = 'unread'";
        mysqli_query($conn, $update_status_sql);

        $sql = "SELECT * FROM messages 
                LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) 
                ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="../uploads/'.basename($row['profile_image']).'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages yet.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }
?>
