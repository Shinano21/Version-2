<?php
session_start();
include "panel.php";

if (isset($_SESSION["user"])) {
    header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | <?php echo $name; ?></title>
    <link rel="shortcut icon" href="src/logo2.png">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/global.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <?php
    if (isset($_GET["error"])) {
        echo "<script>alert('" . $_GET["error"] . "')</script>";
    }
    ?>
    <main>
        <div class="main">
            <div class="left">
                <img src="src/logo.png">
            </div>
            <div class="right">
                <img src="src/logo2.png">
                <p>SIGN IN</p>
                <form action="login_process.php" id="form" method="post">
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" id="username" name="user" value="<?php echo isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : ''; ?>">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" name="password" value="<?php echo isset($_COOKIE['user_password']) ? $_COOKIE['user_password'] : ''; ?>">
                    </div>
                    <div class="rem">
                        <input type="checkbox" name="remember">
                        <label for="remember">Remember Me (30 Days)</label>
                    </div>
                    <button type="submit" id="login" name="submit">Login</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>