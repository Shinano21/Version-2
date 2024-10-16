<!DOCTYPE html>



<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Style will be from outside directory named chat_style.css -->
  <link rel="stylesheet" href="admin_chat_styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <!-- <link rel="stylesheet" href="../css/home.css"> -->
  <link rel="stylesheet" href="global.css">
  <title>Messages | CareVisio</title>
  <link rel="shortcut icon" href="../src/favicon.png">
  <style>
  
  </style>

</head>

<body>

  <!-- Code for the toggle button  -->
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
      var toggleButton = document.getElementById('toggle-button');
      var contactsPanel = document.getElementById('contacts-panel');
      // Hide or show the contacts panel 
      toggleButton.addEventListener('click', function () {
        contactsPanel.classList.toggle('show');
      });
    });
  </script>
 
<?php

include "dbcon.php";

session_start();
if (!isset($_GET['user_id'])) {

  $user_id =   $_SESSION['unique_id'] ;
  // chat.php should always be at the outside part of the directory 

  header("Location: chat.php?user_id=$user_id");
  exit();
}

if(!isset($_SESSION["user"])){
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/head.php"; ?>
</head>

<body onload="display_ct();">
    <?php
    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "System Administrator") {
        include "partials/admin_sidebar.php";
    } else {
        include "partials/sidebar.php";
    }
    ?>

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                        <div id="ccc"
                            style="position:relative;margin:1%;height:50px;position:absolute;top:0;left:5%;width:50%;">
                            <img src="../src/brgy.png" style="height:50px;">
                            <b><span style="margin-left: 3px;margin-top: 8px;position: absolute;">Brgy. Bagumbayan
                                    Health Center</span></b><br>
                            <span id="ct" style="margin-left: 67px;margin-top: -23px;position: absolute;">Brgy.
                                Bagumbayan Health Center</span>
                        </div>
                        <script>
                        function display_c() {
                            var refresh = 1000; // Refresh rate in milli seconds
                            mytime = setTimeout('display_ct()', refresh)
                        }

                        function display_ct() {
                            var x = new Date()
                            var x1 = x.toUTCString(); // changing the display to UTC string
                            document.getElementById('ct').innerHTML = x1;
                            tt = display_c();
                        }
                        </script>
                    </div>
                    <div class="float-right">
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">


                            </div>
                        </div>

                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <a href='#' onclick='redirectToHead()' style='text-decoration: none; color: inherit;font-size:25px;'><i class="ti-comments"></i></a>
                            </div>
                        </div>
                        <script>
                            function redirectToHead() {
                                window.location.href = '../chat.php';
                            }
                        </script>
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">
                                    <b2><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"] ?></b2>
                                    <i class="ti-angle-down f-s-10"></i>
                                    <b2 style="color: gray;cursor:text;display:block">
                                    <?php echo $_SESSION["user_type"] ?>
                                </b2>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">

                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#" onclick=" window.location.href='edit_admin_profile.php';">
                                                    <i class="ti-user"></i>
                                                    <span>Edit Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" onclick=" window.location.href='logout.php';">
                                                    <i class="ti-power-off"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <button id="toggle-button">&#9776;</button> 

    <div class="content-wrap">
    <div class="main">
        <div class="container-fluid" id="container-fluid">
            <section id="main-content">
                <!-- Chat section -->
                <div id="messenger-container">
                    <div id="contacts-panel">
                        <ul id="contacts-list">
                            <div class="user-content">
                                <?php 
                                if (isset($_SESSION['unique_id'])) {
                                    $unique_id = $_SESSION['unique_id'];
                                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '$unique_id'");
                                    if (mysqli_num_rows($sql) > 0) {
                                        $row = mysqli_fetch_assoc($sql);
                                    } else {
                                        $row = null; // No user found, $row set to null
                                    }
                                } else {
                                    $row = null; // Session not set, $row set to null
                                }
                                ?>
                               <?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carevisio";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users
$sql = "SELECT * FROM users"; // Adjust the query as needed, such as filtering by active status, etc.
$result = $conn->query($sql);
?>

<div class="users-list">
    <?php
    if ($result->num_rows > 0) {
        // Loop through each user and display their information
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="user-details">
                <!-- Display User Image -->
                <?php
                if (!empty($row['profile_image'])) {
                    // Ensure the image exists before displaying
                    echo "<img class='user-avatar' src='" . htmlspecialchars($row['profile_image']) . "' alt='User Avatar'>";
                } else {
                    echo "<img class='user-avatar' src='../user/images/defaultDP.png' alt='Default User Avatar'>";
                }
                ?>
                
                <div class="user-info">
                    <!-- Display User Name -->
                    <span class="user-name">
                        <?php echo htmlspecialchars($row['first_name'] . " " . $row['last_name']); ?>
                    </span>
                    
                    <!-- Display User Status -->
                    <span class="user-status">
                        <p>
                            <?php 
                            // Display status if available, else show a default status
                            echo !empty($row['status']) ? htmlspecialchars($row['status']) : "Status not available"; 
                            ?>
                        </p>
                    </span>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No users found.</p>";
    }
    ?>
</div>

<?php
$conn->close();
?>

                            </div>

                            <!-- Add more contacts as needed -->
                            <section class="users">
                                <br>
                                <div class="chats-text">
                                    <h1>Chats</h1>
                                    <div class="search">
                                        <i class="fas fa-search search-icon"></i>
                                        <input class="text" type="text" placeholder="Search">
                                    </div>
                                    <div class="messages-text">
                                        <p><i class="fas fa-comment" style="margin-right: 10px;"></i> Messages</p>
                                    </div>
                                    <hr style="margin-left:5px; margin-top: 20px; width: 420px;">
                                    <div class="all-chat-text">All Chats</div>
                                    <div class="users-list"></div>
                                </div>
                            </section>
                        </ul>
                    </div> 

                    <div id="message-panel">
                        <?php if ($_GET['user_id'] == $_SESSION['unique_id']) : ?>
                            <div id="select-user-message">
                                <div class="centered-content">
                                    <img src="../user/images/send.png" alt="Send Image">
                                    <p>Select a conversation or start a new one</p>
                                </div>
                            </div>
                        <?php else : ?>
                            <?php
                            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                            if (!is_numeric($user_id)) {
                                echo '<div id="error-message">Invalid user ID</div>';
                                header("refresh:1;url=chat.php");
                                exit();
                            }
                            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '$user_id'");
                            if ($sql && mysqli_num_rows($sql) > 0) {
                                $row = mysqli_fetch_assoc($sql);
                            } else {
                                echo '<script>window.location.href = "chat.php";</script>';
                                exit();
                            }
                            ?>
                            <section class="chat-area">
                                <header>
                                    <img src="../user/images/<?php echo $row['img']; ?>" alt="">
                                    <div class="details">
                                        <span><?php echo htmlspecialchars($row['first_name']. " " . $row['last_name']); ?></span>
                                        <p><?php echo htmlspecialchars($row['status']); ?></p>
                                    </div>
                                </header>

                                <!-- Display the conversations here  -->
                                <div class="chat-box"></div>
                            </section>

                            <!-- Message chat text box and send button -->
                            <div id="message-input">
                                <form action="#" class="typing-area">
                                    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($user_id); ?>" hidden>
                                    <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                                    <button><i class="fab fa-telegram-plane"></i></button>
                                </form>
                            </div> 
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

    </div>  
      </body>
          <script src="javascript/users.js"></script>
          <script src="javascript/chat.js"></script>

        <script>
            function display_c() {
                var refresh = 1000; // Refresh rate in milliseconds
                mytime = setTimeout('display_ct()', refresh);
            }

            function display_ct() {
                var x = new Date();
                
                // Set the time zone to Philippine Time (PHT)
                var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
                var timeString = x.toLocaleTimeString('en-US', options);

                // Extract the date part in the format "Day, DD Mon YYYY"
                var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });

                // Combine date and time in the desired format
                var x1 = datePart + ' - ' + timeString;

                document.getElementById('ct').innerHTML = x1;
                tt = display_c();
            }

            // Initial call to start displaying time
            display_c();
        </script>
        <!-- jquery vendor -->
        <script src="js/lib/jquery.min.js"></script>
        <script src="js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="js/lib/menubar/sidebar.js"></script>
        <!-- <script src="js/lib/preloader/pace.min.js"></script> -->
        <!-- sidebar -->

        <script src="js/lib/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
        <!-- bootstrap -->

        <script src="js/lib/weather/jquery.simpleWeather.min.js"></script>
        <script src="js/lib/weather/weather-init.js"></script>
        <script src="js/lib/circle-progress/circle-progress.min.js"></script>
        <script src="js/lib/circle-progress/circle-progress-init.js"></script>
        <script src="js/lib/chartist/chartist.min.js"></script>
        <script src="js/lib/sparklinechart/jquery.sparkline.min.js"></script>
        <script src="js/lib/sparklinechart/sparkline.init.js"></script>
        <script src="js/lib/owl-carousel/owl.carousel.min.js"></script>
        <script src="js/lib/owl-carousel/owl.carousel-init.js"></script>
        <!-- scripit init-->
        <!-- <script src="js/dashboard2.js"></script> -->


        <style>
          
        </style> 
         <script type="text/javascript">
          document.addEventListener('DOMContentLoaded', function () {
            var toggleButton = document.getElementById('toggle-button');
            var contactsPanel = document.getElementById('contacts-panel');

            // Hide the contacts panel initially
            if (window.innerWidth <= 600) {
              
                contactsPanel.style.display = 'none';
            }

            // Hide or show the contacts panel
            toggleButton.addEventListener('click', function () {
              contactsPanel.style.display = (contactsPanel.style.display === 'none') ? 'block' : 'none';
            });
          });
  </script>