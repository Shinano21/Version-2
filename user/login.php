<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - CareVisio</title>
    <link rel="stylesheet" href="../style/login_style.css">

    <link rel="shortcut icon" href="../src/favicon.png" type="image/x-icon">

    <style>
        /* Media query for smaller screens (e.g., mobile devices) */
@media only screen and (max-width: 768px) {

  #main {
    width: 85vw;
    padding: auto 30px;
  }

  #left,
  #right {
    width: 100%;
    float: none;
  }
  #left {
    height: auto;
  }
  a > img {
    width: 100%;
    margin: 0;
  }
  #left > #bhs {
    display: none;
  }

  #right #title > p {
    text-align: center;
    margin: 10px 0 0 0;
    font-size: 15px;
  }

  input[type="submit"] {
    width: 60%;
  }

  #user,
  #password {
    width: calc(100% - 20px);
    margin-left: 10px;
  }

  input[type="submit"]  {
    margin: 20px 0;
    font-size: 13px;
  }

  #user,
  #password {
    background-position: 5px 8px;
    text-indent: 30px;
    margin: 3px 0;
    width: 100%;
    font-size: 14px;
  }

  #lgn-form {
    text-indent: 0;
    text-align: center;
    margin-left: 0;
  }
  #lgn-form h1 {
    font-size: 20px;
    margin-bottom: 5px;
    margin-top: 0;
  }
  #lgn-form .text {
    font-size: 14px;
    margin-top: 0;
    margin-bottom: 20px;
  }
  #lgn-form #dsd {
    font-size: 13px;
    margin-top: 0;
    margin-bottom: 0;
  }
  .errorMessage {
    text-indent:0;
    margin-left: 0;
    text-align:left;
    width:100%;
    margin-left: 0;
    width: 100%;
    padding: 5px;
    font-size: 14px;
    margin-bottom: 15px;
    color: #D8000C;
    background-color: #FFBABA;
    background-image:none;
    text-align: center;
  }


}
    </style>
</head>

<body>
    <?php include "data/logo.php" ?>
    <form action="loginprocess.php" method="post">
        <main id="bg">

            <div id="main">
                <div id="left">
                    <a href="../index.php"><img src="../src/LOGO.svg"></a>
                    <br>
                    <img src="../src/login_img.avif" id="bhs">
                </div>
                <div id="right">
                    <div id="title">
                        <p><?php echo $centerName ?></p>
                    </div>
                    <div id="lgn-form">
                      <br>
                        <h1>Welcome Back!</h1>
                        <p class="text">Enter your details to login</p>

                        <?php if(isset($_GET["error"])): ?>
                        <p style="
                            width: 100%;
                            padding: 10px;
                            border-radius: 10px;
                            font-size: 15px;
                            margin-bottom:15px;
                            text-indent: 30px;
                            color: #D8000C;
                            background-color: #FFBABA;
                            background-image: url('https://i.imgur.com/GnyDvKN.png');
                            background-repeat: no-repeat;
                            background-position: 5px center;
                        " class="errorMessage">
                            <?php echo $_GET["error"]; ?>
                        </p>
                        <?php endif; ?>

                        <input type="email" id="user" placeholder="Email" name="user" required>
                        <input type="password" name="password" id="password" placeholder="Password" name="password" required>
                        <input type="submit" value="Login" name="submit">
                        <p id="dsd">Don't have an account? <a href="../signup.php" style="text-decoration: none;font-weight:600;">Sign up
                                here</a></p>
                    </div>
                </div>
            </div>
        </main>
    </form>
</body>

</html>