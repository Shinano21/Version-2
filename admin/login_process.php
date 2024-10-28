<?php
include "dbcon.php";
session_start();

if (isset($_POST["submit"])) {
    $user = $_POST["user"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `administrator` WHERE email=? AND a_status='Active'";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $storedPassword = $row["password"];

                if (password_verify($password, $storedPassword)) {
                    $_SESSION["firstname"] = $row["firstname"];
                    $_SESSION["midname"] = $row["midname"];
                    $_SESSION["lastname"] = $row["lastname"];
                    $_SESSION["user"] = $row["email"];
                    $_SESSION["user_type"] = $row["user_type"];
                    $_SESSION["unique_id"] = $row["id"]; // Using 'id' as unique identifier

                    // Update the administrator's status
                    $status = "Active now";
                    $admin_id = $row['id'];
                    $sql2 = "UPDATE administrator SET status = ? WHERE id = ?";
                    $stmt2 = mysqli_prepare($conn, $sql2);
                    mysqli_stmt_bind_param($stmt2, "si", $status, $admin_id);
                    mysqli_stmt_execute($stmt2);

                    if (isset($_POST["remember"])) {
                        setcookie("user_email", $user, time() + (30 * 24 * 60 * 60), "/");
                        // Do not store password in a cookie for security reasons
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
            header("Location: index.php?error=USER NOT FOUND");
            exit();
        }
    } else {
        header("Location: index.php?error=DATABASE ERROR");
        exit();
    }
}
?>
