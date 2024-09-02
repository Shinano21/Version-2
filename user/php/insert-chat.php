<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "dbcon.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $status = 'unread';
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, status)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$status}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>