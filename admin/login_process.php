<?php
include "dbcon.php";
session_start();

if (isset($_POST["submit"])) {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

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
                    $_SESSION["unique_id"] = $row["id"];
                    
                    $status = "Active now";
                    $unique_id = mysqli_real_escape_string($conn, $row['id']);
                    $sql2 = "UPDATE users SET status = ? WHERE unique_id = ?";
                    $stmt2 = mysqli_prepare($conn, $sql2);
                    mysqli_stmt_bind_param($stmt2, "ss", $status, $unique_id);
                    mysqli_stmt_execute($stmt2);

                    if (isset($_POST["remember"])) {
                        // Set a cookie to remember the user for 30 days (example duration)
                        setcookie("user_email", $user, time() + (30 * 24 * 60 * 60), "/");
                        // Storing password in a cookie is not secure
                        // setcookie("user_password", $password, time() + (30 * 24 * 60 * 60), "/");
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
