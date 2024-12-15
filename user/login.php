<?php
include "dbcon.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - CareVisio</title>
    <link rel="shortcut icon" href="images/techcareLogo2.png" type="image/x-icon">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(90deg, #c4f1d3, #a7c7f2);
        }

        #main {
            width: 50%;
            height: 80vh;
            display: flex;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        #left {
            flex: 1;
            background: url('../src/v78_4.png') no-repeat center center;
            background-size: cover;
        }

        #right {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        #title p {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #888;
            margin: 0 0 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .text {
            margin-bottom: 20px;
            color: #666;
        }

        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 90%;
            padding: 12px;
            background-color: #4D869C;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #034efc;
        }

        #dsd {
            font-size: 12px;
            margin-top: 30px;
            text-align: center;
        }
        #dsd2 {
            font-size: 12px;
            text-align: center;
        }

        #dsd a {
            text-decoration: none;
            font-weight: 600;
            color: #4D869C;
        }

        #dsd a:hover {
            text-decoration: underline;
        }
        #dsd2 a {
            text-decoration: none;
            font-weight: 600;
            color: #4D869C;
        }

        #dsd2 a:hover {
            text-decoration: underline;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            #main {
                flex-direction: column;
                width: 90%;
                height: auto;
            }

            #left {
                height: 200px;
            }

            #right {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            .text {
                font-size: 14px;
            }

            input[type="email"],
            input[type="password"],
            input[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
<div id="main">
    <div id="left"></div>
    <div id="right">
        <div id="title">
            <p>Legazpi</p>
        </div>
        <div id="lgn-form">
            <h1>Welcome Back!</h1>
            <p class="text">Enter your details to login</p>

            <form action="loginprocess.php" method="post">
                <input type="email" id="user" placeholder="Email" name="user" required>
                <input type="password" id="password" placeholder="Password" name="password" required>
                <!-- Show Password Checkbox -->
                <div>
                    <input type="checkbox" id="show-password">
                    <label for="show-password">Show Password</label>
                </div>
                <input type="submit" value="Login" name="submit">
            </form>

            <p id="dsd">Don't have an account? <a href="../signup.php">Sign up here</a></p>
            <p id="dsd2">Forgot Password? <a href="Forgot.html">Forgot Password</a></p>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    document.getElementById('show-password').addEventListener('change', function () {
        const passwordField = document.getElementById('password');
        passwordField.type = this.checked ? 'text' : 'password';
    });
</script>

</body>

</html>
