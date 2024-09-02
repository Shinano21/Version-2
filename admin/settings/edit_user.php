<?php
session_start();

include '../dbcon.php';

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] !== "System Administrator") {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <link rel="shortcut icon" href="src/logo2.png">
    <title>CareVisio | Manage Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
    <?php include '../partials/header.php' ?>
    <div class="contentBg">
        <div class="contentBox">
            <div class="title">
                <p>Edit Admin User</p>
            </div>

            <?php

            // Check if the ID is provided in the URL
            if (isset($_GET['id'])) {
                $userId = $_GET['id'];

                // Retrieve user data from the database
                $sql = "SELECT * FROM administrator WHERE id = ?";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "i", $userId);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        // Populate the form fields with the user's current data
                        ?>
            <div class="form">
                <form action="settings/update_user.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" name="fname" value="<?php echo $row['firstname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Middle Name</label>
                        <input type="text" name="mname" value="<?php echo $row['midname']; ?>"
                            placeholder="Enter middle name">
                    </div>
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" name="lname" value="<?php echo $row['lastname']; ?>"
                            placeholder="Enter last name" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Number</label>
                        <input type="tel" name="contact" value="<?php echo $row['cpnumber']; ?>"
                            placeholder="Enter contact number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?php echo $row['email']; ?>"
                            placeholder="Enter email address" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="<?php echo $row['password']; ?>"
                            placeholder="Enter password" required>
                    </div>
                    <div class="position">
                        <label for="position">Position:</label>
                        <select name="position" id="position" required>
                            <option value="">Select a position</option>
                            <option value="System Administrator"
                                <?php if ($row['user_type'] === 'System Administrator') echo 'selected'; ?>>System Admin
                            </option>
                            <option value="Barangay Secretary"
                                <?php if ($row['user_type'] === 'Barangay Secretary') echo 'selected'; ?>>Barangay
                                Secretary</option>
                            <option value="Barangay Healthworker"
                                <?php if ($row['user_type'] === 'Barangay Healthworker') echo 'selected'; ?>>Barangay
                                Healthworker</option>
                        </select>
                    </div>
                    <div class="photo">
                        <label for="imageInput">Photo:</label>
                        <input type="file" id="imageInput" name="image" accept="image/*" required>
                        <div class="preview">
                            <img id="preview" src="#" alt="Preview"
                                style="display:none; max-width:250px; max-height:250px;">
                        </div>
                    </div>
                    <div class="subBtn">
                        <button type="submit" name="submit">Update</button>
                    </div>
                </form>
            </div>
            <?php
                    } else {
                        echo "User not found!";
                    }
                } else {
                    echo "Database error!";
                }
            } else {
                echo "No user ID provided!";
            }
            ?>
        </div>
    </div>
</body>

</html>