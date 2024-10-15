<?php
// User login process
include "dbcon.php";
session_start();
if (isset($_POST["submit"])) {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user = $_POST["user"];
    $password = ($_POST["password"]);

    $sql = "SELECT * FROM `users` WHERE email='$user';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row["password"];

        if (password_verify($password, $storedPassword)) {
            // Use different session variables for users
            $_SESSION["user_firstname"] = $row["first_name"];
            $_SESSION["user_lastname"] = $row["last_name"];
            $_SESSION["user_email"] = $row["email"];
            $_SESSION["user_unique_id"] = $row["unique_id"];
            $status = "Active now";
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=Incorrect Password");
            exit();
        }
    } else {
        header("Location: login.php?error=User Not Found");
        exit();
    }
}

?>
