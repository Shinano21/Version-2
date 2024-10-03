<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/global.css">
<style>
    .nav {
        display: flex;
        align-items: center;
        width: 100%;
        height: 80px;
        background-color: rgb(92, 84, 243);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 2000;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
      }
      .nav-container{
        display: flex;
        justify-content: space-between;
        height: 100%;
        width: 100%;
        margin: 10px;
        align-items: center;
      }
      .logo{
        height: 90%;
        align-items: center;
        padding: 15px;
        margin-left: 5vw;
      }
      .logo img{
        height: 100%;
        width: auto;
      }
      .nav-links{
        height: 100%;
        display: flex;
        align-items: center;
        padding: 15px;
        margin-right: 5vw;
        z-index: 1;
      }
      .nav-links a{
        color: white;
        margin: 0px 15px;
        text-transform: uppercase;
        text-decoration: none;
        font-weight: 500;
      }
      .nav-links a:hover{
        color: #a2d1ff;
      }
      .signUp {
        height: 100%;
        display: flex;
        color: black !important;
        padding: 7px 30px;
        text-decoration: none;
        align-items: center;
        background-color: white;
        border: 1px solid white;
        border-radius: 10px;
        color: var(--black);
      }
      .signUp:hover,
      .signUp:active,
      .signUp:focus {
        color: white !important;
        background-color: transparent;
      }
    .nav-links a.active {
        color: white;
    }
    .nav-container .menu-icon {
        display: none; /* Initially hide on larger screens */
        font-size: 24px;
        cursor: pointer;
    }
    .menu-icon i {
        color: white;
    }

@media only screen and (max-width: 768px) {
    .nav-links {
        visibility: hidden;
        opacity: 0;
        flex-direction: column;
        position: absolute;
        top: 80px;
        left: 0;
        width: 100%;
        height: 37%;
        background-color: rgb(92, 84, 243);
        text-align: center;
        transition: visibility 0s, opacity 0.5s ease;
        z-index: 1000;
    }
    .nav-links.active {
        visibility: visible;
        opacity: 1;
        transition: opacity 0.5s ease;
        background-color: white;
    }
    .nav-links a {
        margin: 15px 0;
        color: black;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
    }
    .nav-links a.active {
        color: #3A8EF6;
        font-weight: 500;
    }
    .nav-container .menu-icon {
        display: block;
        margin-right: 20px;
        cursor: pointer;
    }
    .logo {
        height: 80%;
        padding-left: 0;
    }
    .nav-links a.signUp {
        height: 0;
        color: black;
        padding: 0;
        background-color: none;
        border: none;
        border-radius: 0;
        margin: 15px 0;
        font-weight: 500;
        font-size: 14px;
    }
    .nav-links a.signUp:hover,
    .nav-links a.signUp:active,
    .nav-links a.signUp:focus {
        color: #3A8EF6 !important;
    }
}

</style>
</head>
<body>
<header class="nav">
    <?php include "user/data/logo.php" ?>
    <div class="nav-container">
    <a class="logo" href="index.php">
    <?php
    // Assuming $navbarLogo stores the logo file name (like "logo.png")
    if (!empty($navbarLogo)) {
        echo "<img src='/Version-2/admin/uploads/{$navbarLogo}' alt='Logo' />";
    } else {
        echo "No image available";
    }
    ?>
</a>


        <div class="nav-links">
            <a href="index.php"
                <?php if(strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) echo 'class="active"'; ?>>HOME</a>
            <a href="aboutUs.php"
                <?php if(strpos($_SERVER['REQUEST_URI'], 'aboutUs.php') !== false) echo 'class="active"'; ?>>ABOUT
                US</a>
            <a href="programs.php"
                <?php if(strpos($_SERVER['REQUEST_URI'], 'programs.php') !== false || strpos($_SERVER['REQUEST_URI'], 'programContent.php') !== false) echo 'class="active"'; ?>>PROGRAMS</a>
            <a href="contactUs.php"
                <?php if(strpos($_SERVER['REQUEST_URI'], 'contactUs.php') !== false) echo 'class="active"'; ?>>CONTACT
                US</a>
            <a href="user/login.php" class="signUp">LOG IN</a>
        </div>
        <div class="menu-icon">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let navbar = document.querySelector('.nav-links');
        let menuIcon = document.querySelector('.menu-icon');

        menuIcon.onclick = () => {
            navbar.classList.toggle('active');
        };
    });

</script>
</body>
</html>