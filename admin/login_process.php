<?php
include "dbcon.php";
session_start();

if (isset($_POST["submit"])) {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user = $_POST["user"];
    $password = ($_POST["password"]);

    $sql = "SELECT * FROM `administrator` WHERE email='$user' AND `a_status`='Active'";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row["password"];

           
            if (password_verify($password, $storedPassword)) {
                $_SESSION["fname"] = $row["fname"];
                $_SESSION["mname"] = $row["mname"];
                $_SESSION["lname"] = $row["lname"];
                $_SESSION["user"] = $row["email"];
                $_SESSION["user_type"] = $row["user_type"];
                $_SESSION["unique_id"] = $row["unique_id"];
                
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                header("Location: home.php");
                
                if (isset($_POST["remember"])) {
                    // Set a cookie to remember the user for 30 days (example duration)
                    setcookie("user_email", $user, time() + (30 * 24 * 60 * 60), "/");
                    setcookie("user_password", $password, time() + (30 * 24 * 60 * 60), "/");
                }

                header("Location: home.php");
                exit();
            } else {
                
                header("Location: index.php?error=INCORRECT PASSWORD");
                exit();
            }
        } else {
            
            header("Location: index.php?error=USER NOT FOUND");
            exit();
        }
    } else {
        
        header("Location: index.php?error=DATABASE ERROR");
        exit();
    }
}
?>
