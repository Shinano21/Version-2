<?php
include "../dbcon.php";

if (isset($_POST["submit"])) {
    $header = $_POST["header"];
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    // Handling Navbar Logo Upload
    if ($header == "Navbar Logo") {
        if (isset($_FILES["navbar_logo"]) && $_FILES["navbar_logo"]["error"] == 0) {
            $fileExtension = strtolower(pathinfo($_FILES["navbar_logo"]["name"], PATHINFO_EXTENSION));

            if (in_array($fileExtension, $allowedExtensions)) {
                $fileName = basename($_FILES["navbar_logo"]["name"]);
                $uploadDirectory = "../uploads/";
                $uploadFile = $uploadDirectory . $fileName;

                if (move_uploaded_file($_FILES["navbar_logo"]["tmp_name"], $uploadFile)) {
                    // Check if we already have a record in the logo table
                    $existingRecordQuery = "SELECT * FROM logo LIMIT 1"; // Fetch the first record
                    $result = $conn->query($existingRecordQuery);
                    
                    if ($result->num_rows > 0) {
                        // Update existing record
                        $sql = "UPDATE `logo` SET `navbar_logo` = ? WHERE `id` = (SELECT MIN(`id`) FROM logo)";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $fileName);
                    } else {
                        // Insert new record
                        $sql = "INSERT INTO `logo` (`navbar_logo`) VALUES (?)";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $fileName);
                    }

                    mysqli_stmt_execute($stmt);
                } else {
                    echo '<script>alert("File upload failed!");</script>';
                }
            } else {
                echo '<script>alert("Invalid file type. Only JPG, JPEG, PNG allowed.");</script>';
            }
        } else {
            echo '<script>alert("Please upload a logo image.");</script>';
        }
    }

    // Handling Footer Form Data
    else if ($header == "Footer") {
        $centerName = $_POST["center_name"];
        $shortDesc = $_POST["short_desc"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $address = $_POST["address"];
        
        // Fetch existing logo from the database in case no new logo is uploaded
        $existingLogo = null;
        $existingLogoQuery = "SELECT `logo_pic` FROM `logo` LIMIT 1";
        $existingLogoResult = $conn->query($existingLogoQuery);
        if ($existingLogoResult && $existingLogoResult->num_rows > 0) {
            $existingLogo = $existingLogoResult->fetch_assoc()["logo_pic"];
        }

        // Check if a new logo is uploaded
        $centerLogoFile = $existingLogo; // Default to the existing logo
        if (isset($_FILES["center_logo"]) && $_FILES["center_logo"]["error"] == 0) {
            $fileExtension = strtolower(pathinfo($_FILES["center_logo"]["name"], PATHINFO_EXTENSION));
            if (in_array($fileExtension, $allowedExtensions)) {
                $centerLogoFile = basename($_FILES["center_logo"]["name"]);
                $centerLogoPath = "../uploads/" . $centerLogoFile;

                if (!move_uploaded_file($_FILES["center_logo"]["tmp_name"], $centerLogoPath)) {
                    echo '<script>alert("Center logo upload failed!");</script>';
                }
            } else {
                echo '<script>alert("Invalid file type for center logo. Only JPG, JPEG, PNG allowed.");</script>';
            }
        }

        // Check if we already have a record in the logo table
        $existingRecordQuery = "SELECT * FROM logo LIMIT 1";
        $result = $conn->query($existingRecordQuery);
        
        if ($result->num_rows > 0) {
            // Update existing record
            $sql = "UPDATE `logo` SET `center_name` = ?, `short_desc` = ?, `email` = ?, `contact` = ?, `address` = ?, `logo_pic` = ? WHERE `id` = (SELECT MIN(`id`) FROM logo)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $centerName, $shortDesc, $email, $contact, $address, $centerLogoFile);
        } else {
            // Insert new record
            $sql = "INSERT INTO `logo` (`center_name`, `short_desc`, `email`, `contact`, `address`, `logo_pic`) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $centerName, $shortDesc, $email, $contact, $address, $centerLogoFile);
        }

        mysqli_stmt_execute($stmt);
    }

    // Final Check
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo '<script>alert("Saved successfully!"); window.location.href = "../wsLogoandFooterSettings.php";</script>';
    } else {
        echo '<script>alert("No changes were made.");</script>';
    }
}
?>
