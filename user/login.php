<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - TechCare</title>
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
        input[type="password"],
        input[type="text"] {
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

        #dsd a,
        #dsd2 a {
            text-decoration: none;
            font-weight: 600;
            color: #4D869C;
        }

        #dsd a:hover,
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
        .showpass{
            display: flex;
            font-size: 13px;
            justify-content: start;
            align-items: center;
            margin-top: 5px;
        }
/* Error Popup Styling */
#error-popup {
    font-family: "Poppins", sans-serif;
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff0f0; /* Light red background for error */
    border: 5px solid #ff4d4d; /* Bright red border */
    padding: 20px 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    border-radius: 15px; /* Smooth corners */
    text-align: center;
    max-width: 300px; /* Limit popup width */
    width: 80%; /* Responsive width */
    box-sizing: border-box;
    z-index: 1000; /* Ensure it's on top */
}

#error-popup img {
    max-width: 60px; /* Fixed size for icon */
    height: auto; /* Maintain aspect ratio */
    margin-bottom: 15px; /* Space below the image */
}

#error-popup h2 {
    color: #d9534f; /* Darker red for heading */
    font-size: 24px; /* Larger heading size */
    margin: 0 0 10px 0; /* Add spacing below the heading */
}

#error-popup p {
    font-size: 16px;
    color: #333;
    margin: 0 0 20px 0; /* Add spacing below the message */
    line-height: 1.5; /* Improve readability */
}

#error-popup button {
    background-color: #d9534f; /* Dark red button */
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

#error-popup button:hover {
    background-color: #c9302c; /* Darker red on hover */
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
                
                <!-- Password Field -->
                <input type="password" id="password" placeholder="Password" name="password" required>
                
                <!-- Show Password Toggle -->
                <div class="showpass">
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

<!-- Error Popup -->
<div id="error-popup">
    <img src="../src/cross.png" alt="Error Icon" />
    <p id="error-message"></p>
        <button onclick="closePopup()">Close</button>
    </div>

<!-- JavaScript for Show Password -->
<script>
    document.getElementById('show-password').addEventListener('change', function () {
        const passwordField = document.getElementById('password');
        passwordField.type = this.checked ? 'text' : 'password';
    });
</script>

<script>
        // Function to show the popup
        function showPopup(message) {
            const errorPopup = document.getElementById('error-popup');
            const errorMessage = document.getElementById('error-message');
            errorMessage.textContent = message;
            errorPopup.style.display = 'block';
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById('error-popup').style.display = 'none';
        }

        // Check for error messages in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        if (error) {
            showPopup(error);
        }
    </script>
</body>

</html>
