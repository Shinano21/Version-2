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
    <title>Edit Admin User Account | CareVisio</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/settings.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .contentBgd{
            width: 100%;
            height: 100%;
            justify-content: center;
        }
    </style>
</head>

<body onload="display_ct();">

    <?php include "partials/admin_sidebar.php"?>
    <!-- Sidebar -->
    <?php include "partials/header.php" ?>
    <!-- Header -->

    <div class="content-wrap">
        <div class="main">

            <div class="container-fluid">
                <section id="main-content">
                    <div class="contentBgd">
                        <div class="contentBox">
                            <div class="titles">
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
                                            <form action="asUpdate_user.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                                <div class="form-group">
                                                    <label for="name">First Name</label>
                                                    <input type="text" name="fname" value="<?php echo $row['firstname']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Middle Name</label>
                                                    <input type="text" name="mname" value="<?php echo $row['midname']; ?>" placeholder="Enter middle name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Last Name</label>
                                                    <input type="text" name="lname" value="<?php echo $row['lastname']; ?>" placeholder="Enter last name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact">Contact Number</label>
                                                    <input type="tel" name="contact" value="<?php echo $row['cpnumber']; ?>" placeholder="Enter contact number" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" value="<?php echo $row['email']; ?>" placeholder="Enter email address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" value="<?php echo $row['password']; ?>" placeholder="Enter password" required>
                                                </div>
                                                <div class="position">
                                                    <label for="position">Position:</label>
                                                    <select name="position" id="position" required>
                                                        <option value="">Select a position</option>
                                                        <option value="System Administrator" <?php if ($row['user_type'] === 'System Administrator') echo 'selected'; ?>>
                                                            System Admin
                                                        </option>
                                                        <option value="Barangay Nurse" <?php if ($row['user_type'] === 'Barangay Nurse') echo 'selected'; ?>>
                                                            Barangay Nurse
                                                        </option>
                                                        <option value="Barangay Health Worker" <?php if ($row['user_type'] === 'Barangay Health Worker') echo 'selected'; ?>>
                                                            Barangay Health Worker
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="position">
                                                    <label for="position">
                                                        Account Status: <span style="color: <?php echo ($row['a_status'] == 'Deactivated') ? 'red' : 'green'; ?>;">
                                                            <?php echo $row['a_status']; ?>
                                                        </span>
                                                    </label>
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

                        <div class="contentBox" style="display: block;">
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
                                            <form action="asBan_user.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                                <div class="position">
                                                    <label for="status">Manage Account Status</label>
                                                    <select name="status" id="status" required>
                                                        <option value="">Select an option</option>
                                                        <option value="Deactivated">Deactivate</option>
                                                        <option value="Active">Reactivate</option>
                                                    </select>
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
                </section>
                
            </div>
        </div>
    </div>
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
    <?php include "partials/scripts.php"; ?>
    <script src="js/preview.js"></script>
</body>

</html>
