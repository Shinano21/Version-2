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
    <link rel="shortcut icon" href="src/logo.svg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <style>
    /* General Styling */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    html, body {
        height: 100%;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: linear-gradient(135deg, #C2FFD8 10%, #465EFB 100%);
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed; /* Ensure background is fixed */
        overflow: hidden; /* Prevent any scrolling */
        width: 100%;
    }

    /* Ensure no extra margins/padding inside the body */
    body {
        margin: 0;
        padding: 0;
    }

    main {
        display: flex;
        flex-direction: row;
        width: 100%;
        max-width: 800px; /* Adjust width as needed */
        height: 500px;
        background-color: #fff; 
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
    }

    /* Left side (Logo Section) */
    .left {
        width: 50%;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .left img {
        max-width: 60%;
        height: auto;
    }

    /* Right side (Form Section) */
    .right {
        width: 50%;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #ffffff;
        color: #333;
    }

    .right p {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #333;
    }

    /* Form Elements */
    form {
        width: 100%;
        max-width: 400px;
    }

    .input-group {
        position: relative;
        margin-bottom: 20px;
    }

    .input-group i {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        color: #999;
    }

    .input-group input {
        width: 100%;
        padding: 12px 40px;
        border: 1px solid #ccc;
        border-radius: 30px;
        background-color: #f9f9f9;
        font-size: 1rem;
        color: #333;
    }

    .input-group input:focus {
        outline: none;
        border-color: #3498db;
    }

    .rem {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .rem input {
        margin-right: 10px;
    }

    .rem label {
        color: #333;
    }

    /* Login Button */
    button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 30px;
        background-color: #3498db;
        color: white;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #5d56f4;
    }

    /* Responsiveness for smaller screens */
    @media (max-width: 768px) {
        main {
            flex-direction: column;
            height: auto;
            width: 90%; /* Adjust width on small screens */
            max-width: 600px;
        }

        .left, .right {
            width: 100%;
        }

        .right {
            padding: 20px;
        }

        form {
            max-width: 100%;
        }
    }

    @media (max-width: 480px) {
        .right p {
            font-size: 1.5rem;
        }

        button {
            padding: 10px;
            font-size: 0.9rem;
        }
    }
</style>


</head>
<body>
    <?php
    if (isset($_GET["error"])) {
        echo "<script>alert('" . $_GET["error"] . "')</script>";
    }
    ?>
    
    <main>
        <div class="left">
            <img src="src/logo.svg" alt="Logo">
        </div>
        <div class="right">
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
    </main>
</body>
</html>
