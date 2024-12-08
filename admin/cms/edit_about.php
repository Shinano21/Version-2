<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $result = $conn->query("SELECT COUNT(*) FROM about");
    $row = $result->fetch_assoc();

    $uploadDir = "uploads/"; // Directory to save uploaded files

    $header = $_POST["header"];
    if ($header == "Header") {
        // Handle background image
        $headerFileName = $_FILES["bg_img"]["name"];
        $headerFilePath = $uploadDir . basename($headerFileName);
        
        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES["bg_img"]["tmp_name"], $headerFilePath)) {
            if ($row['COUNT(*)'] == 0) {
                $sql = "INSERT INTO `about` (`header_pic`) VALUES (?)";
            } else {
                $sql = "UPDATE `about` SET `header_pic` = ?";
            }
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $headerFileName);
            mysqli_stmt_execute($stmt);
        }
    } else if ($header == "Welcome Section") {
        $sectionHead = $_POST["section_head"];
        $sectionSubhead = $_POST["section_subhead"];
        $sectionBody = $_POST["section_body"];
        $sectionFileName = $_FILES["section_img"]["name"];
        $sectionFilePath = $uploadDir . basename($sectionFileName);

        if (move_uploaded_file($_FILES["section_img"]["tmp_name"], $sectionFilePath)) {
            if ($row['COUNT(*)'] == 0) {
                $sql = "INSERT INTO `about` (`section_head`, `section_subhead`, `section_body`, `section_pic`)
                        VALUES (?, ?, ?, ?)";
            } else {
                $sql = "UPDATE `about` SET `section_head` = ?, `section_subhead` = ?, `section_body` = ?, `section_pic` = ?";
            }
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $sectionHead, $sectionSubhead, $sectionBody, $sectionFileName);
            mysqli_stmt_execute($stmt);
        }
    }  else if ($header == "Mission and Vision") {
        $mission = $_POST["mission"];
        $vision = $_POST["vision"];
    
        // Retrieve existing file paths from the database
        $result = $conn->query("SELECT mission_pic, vision_pic FROM about LIMIT 1");
        $existingData = $result->fetch_assoc();
        $existingMissionPic = $existingData['mission_pic'] ?? '';
        $existingVisionPic = $existingData['vision_pic'] ?? '';
    
        // Handle file uploads
        $missionFileName = $_FILES["mission_pic"]["name"] ? $_FILES["mission_pic"]["name"] : $existingMissionPic;
        $visionFileName = $_FILES["vision_pic"]["name"] ? $_FILES["vision_pic"]["name"] : $existingVisionPic;
        $missionFilePath = $uploadDir . basename($missionFileName);
        $visionFilePath = $uploadDir . basename($visionFileName);
    
        // Move uploaded files if new files are provided
        if (!empty($_FILES["mission_pic"]["tmp_name"])) {
            move_uploaded_file($_FILES["mission_pic"]["tmp_name"], $missionFilePath);
        }
        if (!empty($_FILES["vision_pic"]["tmp_name"])) {
            move_uploaded_file($_FILES["vision_pic"]["tmp_name"], $visionFilePath);
        }
    
        // Insert or update data in the database
        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `about` (`mission`, `vision`, `mission_pic`, `vision_pic`)
                    VALUES (?, ?, ?, ?)";
        } else {
            $sql = "UPDATE `about` SET `mission` = ?, `vision` = ?, `mission_pic` = ?, `vision_pic` = ?";
        }
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $mission, $vision, $missionFileName, $visionFileName);
        mysqli_stmt_execute($stmt);
    }
    

    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsAboutSettings.php";';
        echo '</script>';
    } else {
        header("Location: update_error.php");
        exit();
    }
}
?>
