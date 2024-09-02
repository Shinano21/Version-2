<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {

        $shortMess = $_POST["short_mess"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $address = $_POST["address"];
        $fbAcc = $_POST["fb_acc"];
        $fbLink = $_POST["fb_link"];

        $result = $conn->query("SELECT COUNT(*) FROM contact_us");
        $row = $result->fetch_assoc();

        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `contact_us` (`short_mess`, `email`, `contact`, `address`, `fb_name`, `fb_link`) 
            VALUES (?, ?, ?, ?, ?, ?)";
        } else {
            $sql = "UPDATE `contact_us` SET `short_mess` = ?, `email` = ?, `contact` = ?, `address` = ?, `fb_name` = ?, `fb_link` = ?";
        }
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $shortMess, $email, $contact, $address, $fbAcc, $fbLink);
        mysqli_stmt_execute($stmt);        
    
    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Display a pop-up success message using JavaScript
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsContactUsSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script>';
    } else {
        // Redirect with an error message or appropriate handling
        header("Location: update_error.php");
        exit();
    }
    

}

?>