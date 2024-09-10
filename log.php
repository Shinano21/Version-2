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
// include "dbcon.php";

// if (isset($_POST["submit"])) {
//     $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
//     $mname = mysqli_real_escape_string($conn, $_POST["mname"]);
//     $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
//     $bday = mysqli_real_escape_string($conn, $_POST["bday"]);
//     $email = mysqli_real_escape_string($conn, $_POST["email"]);
//     $pass = mysqli_real_escape_string($conn, $_POST["password"]);
//     $cpass = mysqli_real_escape_string($conn, $_POST["cpassword"]);
//     $user_type = mysqli_real_escape_string($conn, $_POST["type"]);
//     $time = time(); 
//     $ran_id = rand(time(), 100000000);
//     // Handle image upload
//     if (isset($_FILES['image'])) {
//         $img_name = $_FILES['image']['name'];
//         $img_type = $_FILES['image']['type'];
//         $tmp_name = $_FILES['image']['tmp_name'];

//         // Specify the target directory for storing uploaded images
//         $target_dir = "user/images/";
        
//         // Specify allowed image file extensions
//         $allowed_extensions = ["jpeg", "jpg", "png"];

//         // Get the file extension
//         $img_explode = explode('.', $img_name);
//         $img_ext = strtolower(end($img_explode));

//         // Check if the file extension is allowed
//         if (in_array($img_ext, $allowed_extensions)) {
//             // Generate a unique name for the image
//             $new_img_name = uniqid() . '.' . $img_ext;

//             // Move the uploaded file to the target directory
//             if (move_uploaded_file($tmp_name, $target_dir . $new_img_name)) {
//                 // Continue with your existing code
//             } else {
//                 echo "Image upload failed!";
//                 exit();
//             }
//         } else {
//             echo "Please upload a valid image file (jpeg, jpg, png).";
//             exit();
//         }
//     }

//     if ($pass != $cpass) {
//         header("Location: signup.php?error=Password does not match!&fname=$fname&mname=$mname&lname=$lname&bday=$bday&email=$email&password=$pass");
//         exit();
//     }
    
//     $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

//     $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
//     $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

//     if (mysqli_num_rows($checkEmailResult) > 0) {
//         header("Location: signup.php?error=User email already exist!&fname=$fname&mname=$mname&lname=$lname&bday=$bday&email=$email&exist");
//         exit();
//     }
    
//     $sql = "INSERT INTO `users` (`fname`, `mname`, `lname`, `email`, `password`, `img`, `unique_id`, `user_type`) VALUES ('$fname', '$mname', '$lname', '$email', '$hashedPassword', '$new_img_name', $ran_id, '$user_type')";
    
//     if (mysqli_query($conn, $sql)) {
//         header("Location: user/login.php");
//         exit(); 
//     } else {
//         header("Location: signup.php?error=Database error");
//         exit();
//     }
// }
//



include "dbcon.php"; // Include database connection

$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $first_name = htmlspecialchars(trim($_POST['fname']));
    $middle_name = isset($_POST['mname']) ? htmlspecialchars(trim($_POST['mname'])) : null;
    $last_name = htmlspecialchars(trim($_POST['lname']));
    $birthday = $_POST['bday'];
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['cpassword'];
    $user_type = 'resident'; // Define user type as 'resident'

    // Image handling
    $image = $_FILES['image'];
    $target_dir = "uploads/"; // Define the directory to store images
    $target_file = $target_dir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Validate password match
    if ($password !== $confirm_password) {
        $message = "Passwords do not match!";
        header("Location: signup.php?message=" . urlencode($message) . "&fname=$first_name&lname=$last_name&mname=$middle_name&bday=$birthday&email=$email");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $sql = "SELECT * FROM accounts WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = "An account with this email already exists!";
        header("Location: signup.php?message=" . urlencode($message) . "&fname=$first_name&lname=$last_name&mname=$middle_name&bday=$birthday&email=$email");
        exit();
    }

    // Check if the uploaded file is an image
    $check = getimagesize($image["tmp_name"]);
    if ($check === false) {
        $message = "File is not an image!";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($image["size"] > 5000000) {
        $message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats (JPG, JPEG, PNG, GIF)
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if upload is okay
    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded.";
        header("Location: signup.php?message=" . urlencode($message) . "&fname=$first_name&lname=$last_name&mname=$middle_name&bday=$birthday&email=$email");
        exit();
    } else {
        // Try to move the uploaded file to the target directory
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            // Insert the user into the database
            $sql = "INSERT INTO accounts (first_name, middle_name, last_name, birthday, email, password, user_type, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $first_name, $middle_name, $last_name, $birthday, $email, $hashed_password, $user_type, $target_file);
            
            if ($stmt->execute()) {
                $message = "success";
                header("Location: signup.php?message=" . urlencode($message));
                exit();
            } else {
                $message = "There was an error creating your account. Please try again.";
                error_log("Error creating account: " . $stmt->error); // Log the error for debugging
                header("Location: signup.php?message=" . urlencode($message));
                exit();
            }
        } else {
            $message = "Sorry, there was an error uploading your file.";
            header("Location: signup.php?message=" . urlencode($message) . "&fname=$first_name&lname=$last_name&mname=$middle_name&bday=$birthday&email=$email");
            exit();
        }
    }

    $stmt->close();
}

$conn->close();
?>

