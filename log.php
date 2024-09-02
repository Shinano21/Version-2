<?php
// include "dbcon.php";
// if(isset($_POST["submit"])){
//     $fname = $_POST["fname"];
//     $mname = $_POST["mname"];
//     $lname = $_POST["lname"];
//     $bday = $_POST["bday"];
//     $email = $_POST["email"];
//     $pass = md5($_POST["password"]);
//     $cpass = md5($_POST["cpassword"]);

//     if($pass != $cpass) {
//         header("Location:signup.php?error=Password does not match!&fname=$fname&mname=$mname&lname=$lname&bday=$bday&email=$email&password=$password");
    
//     }
    
//     else{
//         $sql = "SELECT * FROM users where email ='$email'";
//         $result = mysqli_query($conn, $sql);
        
//         if (mysqli_num_rows($result) > 0) {
//             header("Location:signup.php?error=User email is already exist!&fname=$fname&mname=$mname&lname=$lname&bday=$bday&email=$email&exist")

   
//     }
    
//     else{
//     $sql= "
//     INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `email`, `password`) VALUES (NULL, '$fname', '$mname', '$lname', '$email', '$pass');";
    
//         if (mysqli_query($conn, $sql)) {
//             header("Location:home.php");
//     }
// }
//     }
// }
include "dbcon.php";

if (isset($_POST["submit"])) {
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $mname = mysqli_real_escape_string($conn, $_POST["mname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $bday = mysqli_real_escape_string($conn, $_POST["bday"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);
    $cpass = mysqli_real_escape_string($conn, $_POST["cpassword"]);
    $user_type = mysqli_real_escape_string($conn, $_POST["type"]);
    $time = time(); 
    $ran_id = rand(time(), 100000000);
    // Handle image upload
    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        // Specify the target directory for storing uploaded images
        $target_dir = "user/images/";
        
        // Specify allowed image file extensions
        $allowed_extensions = ["jpeg", "jpg", "png"];

        // Get the file extension
        $img_explode = explode('.', $img_name);
        $img_ext = strtolower(end($img_explode));

        // Check if the file extension is allowed
        if (in_array($img_ext, $allowed_extensions)) {
            // Generate a unique name for the image
            $new_img_name = uniqid() . '.' . $img_ext;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($tmp_name, $target_dir . $new_img_name)) {
                // Continue with your existing code
            } else {
                echo "Image upload failed!";
                exit();
            }
        } else {
            echo "Please upload a valid image file (jpeg, jpg, png).";
            exit();
        }
    }

    if ($pass != $cpass) {
        header("Location: signup.php?error=Password does not match!&fname=$fname&mname=$mname&lname=$lname&bday=$bday&email=$email&password=$pass");
        exit();
    }
    
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        header("Location: signup.php?error=User email already exist!&fname=$fname&mname=$mname&lname=$lname&bday=$bday&email=$email&exist");
        exit();
    }
    
    $sql = "INSERT INTO `users` (`fname`, `mname`, `lname`, `email`, `password`, `img`, `unique_id`, `user_type`) VALUES ('$fname', '$mname', '$lname', '$email', '$hashedPassword', '$new_img_name', $ran_id, '$user_type')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: user/login.php");
        exit(); 
    } else {
        header("Location: signup.php?error=Database error");
        exit();
    }
}
?>