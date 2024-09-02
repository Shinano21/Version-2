<?php
include "../dbcon.php";
$data = $_POST["submit"];

$result = $conn->query("SELECT COUNT(*) FROM home");
$row = $result->fetch_assoc();
if (isset($_POST["submit"])) {
    $header = $_POST["header"];
    if ($header == "Hero Section"){
        $center_name = $_POST["center_name"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $open_hours = $_POST["open_hours"];
        $bg_img = file_get_contents($_FILES["bg_img"]["tmp_name"]);
        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `home` (`center_name`, `address`, `email`, `contact`, `open_hours`, `bg_img`)
            VALUES (?, ?, ?, ?, ?, ?)";
        } else {
            $sql = "UPDATE `home` SET `center_name` = ?, `address` = ?, `email` = ?, `contact` = ?, `open_hours` = ?, `bg_img` = ?";
        }
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $center_name, $address, $email, $contact, $open_hours, $bg_img);
        mysqli_stmt_execute($stmt);
    } else if ($header == "About Us"){
        $short_desc = $_POST["short_desc"];
        $mission = $_POST["mission"];
        $vision = $_POST["vision"];
        $goal = $_POST["goal"];
        $chairman = $_POST["chairman"];
        $chairman_pic = file_get_contents($_FILES["chairman_pic"]["tmp_name"]);
        $chairman_comm = $_POST["chairman_comm"];
        $chairman_comm_pic = file_get_contents($_FILES["chairman_comm_pic"]["tmp_name"]);
        $section_pic = file_get_contents($_FILES["section_pic"]["tmp_name"]);
        if ($row['COUNT(*)'] == 0) {
            $sql = "INSERT INTO `home` (`short_desc`, `mission`, `vision`, `goal`, `chairman`, `chairman_pic`, `chairman_comm`, `chairman_comm_pic`, `section_pic`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        } else {
            $sql = "UPDATE `home` SET `short_desc` = ?, `mission` = ?, `vision` = ?, `goal` = ?, `chairman` = ?, `chairman_pic` = ?, `chairman_comm` = ?, `chairman_comm_pic` = ?, `section_pic` = ?";
        }
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssss", $short_desc, $mission, $vision, $goal, $chairman, $chairman_pic, $chairman_comm, $chairman_comm_pic, $section_pic);
        mysqli_stmt_execute($stmt);
    } else {
        $contact_mess = $_POST["contact_mess"];
        $office_hrs = $_POST["office_hrs"];
        $sql = "UPDATE `home` SET `contact_mess` = ?, `office_hrs` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $contact_mess, $office_hrs);
        mysqli_stmt_execute($stmt);
    }
    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Display a pop-up success message using JavaScript
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsHomeSettings.php";';  // Optional: Redirect after displaying the alert
        echo '</script>';
    } else {
        // Redirect with an error message or appropriate handling
        header("Location: update_error.php");
        exit();
    }
    

}

?>