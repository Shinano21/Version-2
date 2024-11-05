<?php 
  include_once "navbar.php";
  include_once "dbcon.php";

  if (!isset($_GET['user_id'])) {
    $user_id = $_SESSION['unique_id'];
    echo "<script>window.location.href='chat.php?user_id=$user_id';</script>";
    exit();
  }

  if (!isset($_SESSION['unique_id'])) {
    header("location: ../admin/login.php");
    echo "<script>window.location.href='../login.php';</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages - TechCare</title>
  <link rel="stylesheet" href="user_chat_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link rel="stylesheet" href="global.css">
  <link rel="shortcut icon" href="../src/favicon.png" type="image/x-icon">

  <style>
    body.chat-page {
      overflow-y: hidden;
    }
    body.chat-page::-webkit-scrollbar {
      width: 0;
    }
  </style>
</head>

<body>
  <div id="messenger-container" style="margin-top: 80px;">
    <button id="toggle-button" style="margin-top: 680px;">&#9776;</button>
    <div id="contacts-panel">
      <ul id="contacts-list">
        <div class="user-content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql) > 0) {
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <div class="user-details">
            <img class="user-avatar" src="../uploads/<?php echo basename($row['profile_image']); ?>" alt="User Avatar">
            <div class="user-info">
              <span class="user-name"><?php echo $row['first_name']. " " . $row['last_name']; ?></span>
              <span class="user-status"><p><?php echo $row['status']; ?></p></span>
            </div>
          </div>
        </div>

        <section class="users">
          <br>
          <div class="chats-text"><h1> Chats </h1></div>
          <div class="search">
            <i style="margin-left: 40px;" class="fas fa-search search-icon"></i>
            <input style="padding-left: 35px;" type="text" placeholder=" Search">
            <button style="background-color: #f0f0f0;"></button>
          </div>
          <div class="messages-text"><p><i class="fas fa-comment"></i>&nbsp;&nbsp;Messages</p></div>
          <hr style="margin-left:5px; margin-top: 20px; width: 420px;">
          <div class="all-chat-text"><p>All Chats<p></div>
          <div class="users-list"></div>
        </section>
      </ul>
    </div>

    <div id="message-panel">
      <?php if ($_GET['user_id'] == $_SESSION['unique_id']) : ?>
        <div id="select-user-message">
          <div class="centered-content">
            <img src="images/send.png" alt="Send Image">
            <p>Select a conversation or start a new one</p>
          </div>
        </div>
      <?php else : ?>
        <?php
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $user_type = isset($_GET['user_type']) ? $_GET['user_type'] : 'user';

          // Select from the appropriate table based on the user type
          if ($user_type == 'admin') {
              $sql = mysqli_query($conn, "SELECT * FROM administrator WHERE id = {$user_id}");
          } else {
              $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          }

          if ($sql && mysqli_num_rows($sql) > 0) {
              $row = mysqli_fetch_assoc($sql);
          } else {
              echo "<script>setTimeout(function(){ window.location.href='chat.php'; }, 1000);</script>";
              exit();
          }
        ?>

        <section class="chat-area">
        <header>
    <?php
        if (!empty($row['profile_image'])) {
            echo "<img src='../uploads/" . basename($row['profile_image']) . "' alt='User Avatar'>";
        } else {
            echo "<img src='images/defaultDP.png' alt='Default User Avatar'>";
        }
    ?>
    <div class="details">
        <?php 
            // Check if the user is an admin or a regular user
            if (isset($row['first_name']) && isset($row['last_name'])) {
                echo "<span>" . $row['first_name'] . " " . $row['last_name'] . "</span>";
            } elseif (isset($row['firstname']) && isset($row['lastname'])) {
                echo "<span>" . $row['firstname'] . " " . $row['lastname'] . "</span>";
            } else {
                echo "<span>User not found</span>"; // Fallback message
            }
        ?>
        <p><?php echo $row['status']; ?></p>     
    </div>
</header>


          <div class="chat-box"></div>
        </section>

        <div id="message-input">
          <form action="#" class="typing-area">
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
            <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
            <button><i class="fab fa-telegram-plane"></i></button>
          </form>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
      var toggleButton = document.getElementById('toggle-button');
      var contactsPanel = document.getElementById('contacts-panel');
      toggleButton.addEventListener('click', function () {
        contactsPanel.classList.toggle('show');
      });
    });
  </script>
  <script src="javascript/users.js"></script>
  <script src="javascript/chat.js"></script>

</body>
</html>
