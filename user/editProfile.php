<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - CareVisio</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="../css/editProfile.css">

    <link rel="shortcut icon" href="../src/favicon.png" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php' ?>
    <?php 
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
        }
    ?>
    <!-- Banner -->
    <div class="banner">
        <p><a href="index.php" style="text-decoration: none;"> Home &nbsp;</a></p>
        <p>/ Update Profile</p>
    </div>

    <!-- Content -->
    <div class="editForm">
        <div class="information">
            <div class="photoBackdrop">
                <div class="rect"></div>
                <div class="image">
                    <img src='images/<?php echo $row['img']; ?>' alt='profile'>    
                </div>
            </div>
            <form action="updateProfile.php" method="post" enctype="multipart/form-data">
                <div class="form">
                    <div class="formInput">
                        <p>First Name</p>
                        <input type="text" name="fname" value="<?php echo $row['fname']; ?>" placeholder="Your first name here"
                            required>
                    </div>
                    <div class="formInput">
                        <p>Middle Name</p>
                        <input type="text" name="mname" value="<?php echo $row['mname']; ?>"
                            placeholder="Your middle name here">
                    </div>
                    <div class="formInput">
                        <p>Last Name</p>
                        <input type="text" name="lname" value="<?php echo $row['lname']; ?>" placeholder="Your last name here"
                            required>
                    </div>
                    <div class="formInput">
                        <p>Birth Date</p>
                        <input type="date" name="bday" value="<?php echo $row['bday']; ?>" required>
                    </div>
                    <div class="formInput">
                        <p>Select Profile Picture</p>
                        <input type="file" name="profile_pic" placeholder="Choose File" value="<?php echo $row['img']; ?>" required>
                    </div>
                </div>
                <button type="submit" name="submit">Update Profile</button>
            </form>
        </div>

        <div class="password">
            <h3>Change Password</h3>
            <form action="updatePassword.php" method="post" enctype="multipart/form-data"
                onsubmit="return validateForm()">
                <div class="form">
                    <div class="formInput">
                        <p>Old Password</p>
                        <input type="password" name="old_password" placeholder="Enter previous password" required>
                    </div>
                    <div class="formInput">
                        <p>New Password</p>
                        <input type="password" name="new_password" id="new_password" placeholder="Enter new password"
                            required>
                    </div>
                    <div class="formInput">
                        <p>Confirm Password</p>
                        <input type="password" name="confirm_password" id="confirm_password"
                            placeholder="Confirm new password" required>
                        <span id="passwordMismatch" style="color: red; display: none;">Passwords do not match</span>
                    </div>
                </div>
                <button type="submit" name="submit">Update Password</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>
    <script>
    function validateForm() {
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (newPassword !== confirmPassword) {
            document.getElementById('passwordMismatch').style.display = 'block';
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
    </script>

    <!-- ===============================scripts================================== -->
</body>

</html>