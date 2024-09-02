<?php
include "../dbcon.php";
$data = $_POST["submit"];

$result = $conn->query("SELECT COUNT(*) FROM logo");
$row = $result->fetch_assoc();
if (isset($_POST["submit"])) {
    $header = $_POST["header"];
    if ($header == "Navbar Logo"){
        $navbarLogo = file_get_contents($_FILES["navbar_logo"]["tmp_name"]);
        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `logo` (`navbar_logo`)
            VALUES (?)";
        } else {
            $sql = "UPDATE `logo` SET `navbar_logo` = ?";
        }
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $navbarLogo);
        mysqli_stmt_execute($stmt);
    } else if ($header == "Footer"){
        $centerName = $_POST["center_name"];
        $shortDesc = $_POST["short_desc"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $address = $_POST["address"];
        $centerLogo = file_get_contents($_FILES["center_logo"]["tmp_name"]);
        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `logo` (`center_name`, `short_desc`, `email`, `contact`, `address`, `logo_pic`)
            VALUES (?, ?, ?, ?, ?, ?)";
        } else {
            $sql = "UPDATE `logo` SET `center_name` = ?, `short_desc` = ?, `email` = ?, `contact` = ?, `address` = ?, `logo_pic` = ?";
        }
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $centerName, $shortDesc, $email, $contact, $address, $centerLogo);
        mysqli_stmt_execute($stmt);        
    }
    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Display a pop-up success message using JavaScript
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsLogoandFooterSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script>';
    } else {
        // Redirect with an error message or appropriate handling
        header("Location: update_error.php");
        exit();
    }
    

}

?>