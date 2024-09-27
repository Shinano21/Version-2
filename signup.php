<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Account - TechCare</title>
     <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: linear-gradient(135deg, #c2ffd8 10%, #465efb 100%);
      }

      .create-account-container {
        display: flex;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        background-color: #ffffff;
        max-width: 800px; /* Adjust this value as needed */
        width: 90%;
        height: auto; /* Adjust this value as needed */
      }

      .create-account-image {
        flex: 1;
        overflow: hidden;
      }

      .create-account-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .create-account-form {
        padding: 40px;
        flex: 1;
      }

      .create-account-form h2 {
        margin-bottom: 20px;
        font-size: 30px;
        color: #333;
        font-weight: lighter;
      }

      .create-account-form p {
        margin-bottom: 10px;
        color: #666;
      }

      .create-account-form input[type="text"],
      .create-account-form input[type="email"],
      .create-account-form input[type="password"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      .create-account-form .button-container {
        text-align: center;
      }

      .create-account-form button {
        background-color: #4d869c;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%; /* Adjust this value as needed */
      }

      .create-account-form button:hover {
        background-color: #006f99;
      }

      .create-account-form .login-link {
        margin-top: 20px;
        text-align: center;
        font-size: 12px;
      }

      .create-account-form .login-link a {
        color: #008cba;
        text-decoration: none;
      }

      .create-account-form .login-link a:hover {
        text-decoration: underline;
      }

      .error-message,
      .success-message {
        color: red;
        margin-bottom: 10px;
        font-size: 12px;
      }

      .success-popup {
        font-family: "Poppins", sans-serif;
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #f0fff0;
        border: 8px solid #0aff44;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        text-align: center;
        max-width: 90%;
        max-height: 60vh;
        overflow: auto;
        width: 15%;
        height: auto;
        /* Adjustments for responsive design */
}
.success-popup img {
    max-width: 30%; /* Scale the image to fit within the container */
    height: auto; /* Maintain aspect ratio */
}


.success-popup h2 {
    color: #28a745;
    font-size: 28px; /* Adjusted size */
    margin-bottom: 10px; /* Adjusted spacing */
}

.success-popup p {
    font-size: 16px; /* Adjusted size */
    color: #333;
}

.success-popup button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    font-size: 14px; /* Adjusted size */
    margin-top: 20px;
    cursor: pointer;
    border-radius: 5px;
}
      .show-password {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
      }

      .show-password label {
        font-size: 12px; /* Adjust the font size here */
        font-weight: lighter; /* You can also adjust the font weight */
      }

      .show-password input {
        margin-left: 10px;
      }
      input[type="password"]::-ms-reveal,
      input[type="password"]::-ms-clear {
        display: none;
      }

      input[type="password"]::-webkit-contacts-auto-fill-button,
      input[type="password"]::-webkit-credentials-auto-fill-button {
        display: none !important;
      }
    </style>
    <script>
      function validateForm() {
        const password = document.forms["createAccount"]["password"].value;
        const email = document.forms["createAccount"]["email"].value;

        // Email regex to allow only @gmail.com or @yahoo.com
        const emailRegex = /^[^\s@]+@(gmail\.com|yahoo\.com)$/;
        const passwordRegex =
          /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&-_#])[A-Za-z\d@$!%*?&-_#]{8,}$/;

        const errorMessage = document.getElementById("error-message");

        if (!emailRegex.test(email)) {
          errorMessage.innerText =
            "Email must be a valid Gmail or Yahoo address.";
          return false;
        }

        if (!passwordRegex.test(password)) {
          errorMessage.innerText =
            "Password should be at least 8 characters and contain an uppercase letter, a lowercase letter, a number, and a special character.";
          return false;
        }

        return true;
      }

      function togglePasswordVisibility() {
        const passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
          passwordField.type = "text";
        } else {
          passwordField.type = "password";
        }
      }

      window.onload = function () {
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get("message");

        if (message === "success") {
          document.getElementById("success-popup").style.display = "block";
        } else if (message) {
          document.getElementById("error-message").innerText = message;
        }
      };
    </script>
  </head>
  <body>
 <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "carevisio";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_type = 'resident'; // Set user_type to 'resident'

        // Profile image upload handling
        $profile_image = $_FILES['profile_image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($profile_image);

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            // Check if email already exists
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $message = "An account with this email already exists!";
            } else {
                // Insert new account into the database with unique_id = 1
                $unique_id = 1; // Set unique_id to 1
                $sql = "INSERT INTO users (first_name, middle_name, last_name, birthday, email, password, user_type, profile_image, unique_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssssi", $first_name, $middle_name, $last_name, $birthday, $email, $password, $user_type, $target_file, $unique_id);
                if ($stmt->execute()) {
                    $message = "success";
                } else {
                    $message = "Error: " . $stmt->error;
                }
            }
            $stmt->close();
        } else {
            $message = "Error uploading profile image.";
        }
    }

    $conn->close();
?>


    <div class="create-account-container">
      <div class="create-account-image">
        <img src="src/manWithLaptop.jpg" alt="Working on a laptop" />
      </div>
      <div class="create-account-form">
        <h2>Create Account</h2>
        <p>Fill in your details to create an account</p>
        <form
          name="createAccount"
          method="post"
          enctype="multipart/form-data"
          onsubmit="return validateForm()"
        >
          <input
            type="text"
            name="first_name"
            placeholder="First Name"
            required
          />
          <input
            type="text"
            name="middle_name"
            placeholder="Middle Name"
          />
          <input
            type="text"
            name="last_name"
            placeholder="Last Name"
            required
          />
          <input
            type="date"
            name="birthday"
            placeholder="Birthday"
            required
          />
          <input type="email" name="email" placeholder="Email" required />
          <input
            type="password"
            name="password"
            id="password"
            placeholder="Password"
            required
          />
          <input type="file" name="profile_image" required />
          <div id="error-message" class="error-message"></div>
          <div class="show-password">
            <label for="show-password">Show Password</label>
            <input
              type="checkbox"
              id="show-password"
              onclick="togglePasswordVisibility()"
            />
          </div>
          <div class="button-container">
            <button type="submit">Create Account</button>
          </div>
          <div class="login-link">
            <p>Already have an account? <a href="user/login.php">Login</a></p>
          </div>
        </form>
      </div>
    </div>

    <?php if ($message === "success"): ?>
      <div id="success-popup" class="success-popup" style="display:block;">
        <img src="images/happy.png" alt="Success Icon" />
        <h2>Success!</h2>
        <p>Your account has been successfully created.</p>
        <button onclick="window.location.href='user/login.php'">Back to Login</button>
      </div>
    <?php elseif ($message): ?>
      <div id="error-message" class="error-message"><?php echo $message; ?></div>
    <?php endif; ?>
  </body>
</html>
