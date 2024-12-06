<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $result = $conn->query("SELECT COUNT(*) FROM about");
    $row = $result->fetch_assoc();

    $uploadDir = "uploads/"; // Directory to save uploaded files
    $stmt = null; // Initialize $stmt to avoid undefined variable error

    $header = $_POST["header"];
    if ($header == "Mission and Vision") {
        $mission = $_POST["mission"];
        $vision = $_POST["vision"];
        $missionFileName = $_FILES["mission_pic"]["name"];
        $visionFileName = $_FILES["vision_pic"]["name"];
        $missionFilePath = $uploadDir . basename($missionFileName);
        $visionFilePath = $uploadDir . basename($visionFileName);

        // Move uploaded files
        $missionUploaded = move_uploaded_file($_FILES["mission_pic"]["tmp_name"], $missionFilePath);
        $visionUploaded = move_uploaded_file($_FILES["vision_pic"]["tmp_name"], $visionFilePath);

        if ($missionUploaded && $visionUploaded) {
            if ($row['COUNT(*)'] == 0) {
                $sql = "INSERT INTO `about` (`mission`, `vision`, `mission_pic`, `vision_pic`)
                        VALUES (?, ?, ?, ?)";
            } else {
                $sql = "UPDATE `about` SET `mission` = ?, `vision` = ?, `mission_pic` = ?, `vision_pic` = ?";
            }
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $mission, $vision, $missionFileName, $visionFileName);
                mysqli_stmt_execute($stmt);
            } else {
                echo "Error preparing statement: " . mysqli_error($conn);
                exit();
            }
        } else {
            echo "Error uploading mission or vision images.";
            exit();
        }
    }

    // Check if the update was successful
    if ($stmt && mysqli_stmt_affected_rows($stmt) > 0) {
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsAboutSettings.php";';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Error saving data. Please try again.");';
        echo 'window.location.href = "../wsAboutSettings.php";';
        echo '</script>';
        exit();
    }
}
?>
