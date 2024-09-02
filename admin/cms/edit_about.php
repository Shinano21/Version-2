<?php
include "../dbcon.php";
$data = $_POST["submit"];

$result = $conn->query("SELECT COUNT(*) FROM about");
$row = $result->fetch_assoc();

if (isset($_POST["submit"])) {
    $header = $_POST["header"];
    if ($header == "Header"){
        $header = file_get_contents($_FILES["bg_img"]["tmp_name"]);
        // If no rows existed, insert new row
        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `about` (`header_pic`) VALUES (?)";
        } else {
            $sql = "UPDATE `about` SET `header_pic` = ?";
        }
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $header);
        mysqli_stmt_execute($stmt);
    } else if ($header == "Welcome Section"){
        $sectionHead = $_POST["section_head"];
        $sectionSubhead = $_POST["section_subhead"];
        $sectionBody = $_POST["section_body"];
        $sectionPic = file_get_contents($_FILES["section_img"]["tmp_name"]);
        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `about` (`section_head`, `section_subhead`, `section_body`, `section_pic`)
            VALUES (?, ?, ?, ?)";
        } else {
            $sql = "UPDATE `about` SET `section_head` = ?, `section_subhead` = ?, `section_body` = ?, `section_pic` = ?";
        }
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $sectionHead, $sectionSubhead, $sectionBody, $sectionPic);
        mysqli_stmt_execute($stmt);
    } else if ($header == "Mission and Vision") {
        $mission = $_POST["mission"];
        $vision = $_POST["vision"];
        $missionPic = file_get_contents($_FILES["mission_pic"]["tmp_name"]);
        $visionPic = file_get_contents($_FILES["vision_pic"]["tmp_name"]);
        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `about` (`mission`, `vision`, `mission_pic`, `vision_pic`)
            VALUES (?, ?, ?, ?)";
        } else {
            $sql = "UPDATE `about` SET `mission` = ?, `vision` = ?, `mission_pic` = ?, `vision_pic` = ?";
        }
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $mission, $vision, $missionPic, $visionPic);
        mysqli_stmt_execute($stmt);
    } 
    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Display a pop-up success message using JavaScript
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsAboutSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script>';
    } else {
        // Redirect with an error message or appropriate handling
        header("Location: update_error.php");
        exit();
    }
    

}

?>