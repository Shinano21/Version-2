<?php
include "../dbcon.php";
$data = $_POST["submit"];

$result = $conn->query("SELECT COUNT(*) FROM logo");
$row = $result->fetch_assoc();

if (isset($_POST["submit"])) {
    $header = $_POST["header"];

    if ($header == "Navbar Logo") {
        // Check if an image is uploaded
        if (isset($_FILES["navbar_logo"]) && $_FILES["navbar_logo"]["error"] == 0) {
            // Validate the file type (for example, only allowing PNG or JPG)
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($_FILES["navbar_logo"]["name"], PATHINFO_EXTENSION));

            if (in_array($fileExtension, $allowedExtensions)) {
                $uploadDirectory = "../uploads/"; // Folder to save the image (moved to the parent directory for better structure)
                $fileName = basename($_FILES["navbar_logo"]["name"]);
                $uploadFile = $uploadDirectory . $fileName;

                // Move the uploaded file to the uploads folder
                if (move_uploaded_file($_FILES["navbar_logo"]["tmp_name"], $uploadFile)) {
                    $navbarLogoPath = $uploadFile;  // Save the file path

                    if ($row['COUNT(*)'] == 0) {
                        // Insert if no records exist
                        $sql = "INSERT INTO `logo` (`navbar_logo`) VALUES (?)";
                    } else {
                        // Update the existing record
                        $sql = "UPDATE `logo` SET `navbar_logo` = ? WHERE `id` = 1";  // Assuming a single row in the logo table, we update based on the `id`
                    }

                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $navbarLogoPath); // Bind the file path
                    mysqli_stmt_execute($stmt);
                } else {
                    // Handle file upload failure
                    echo '<script>';
                    echo 'alert("File upload failed!");';
                    echo '</script>';
                }
            } else {
                // Handle invalid file type
                echo '<script>';
                echo 'alert("Invalid file type. Only JPG, JPEG, PNG allowed.");';
                echo '</script>';
            }
        } else {
            // Handle if no file is uploaded
            echo '<script>';
            echo 'alert("Please upload a logo image.");';
            echo '</script>';
        }
    } else if ($header == "Footer") {
        // Handle footer information
        $centerName = $_POST["center_name"];
        $shortDesc = $_POST["short_desc"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $address = $_POST["address"];
        
        // Handle the center logo image upload (if provided)
        if (isset($_FILES["center_logo"]) && $_FILES["center_logo"]["error"] == 0) {
            $centerLogoFile = basename($_FILES["center_logo"]["name"]);
            $centerLogoPath = "../uploads/" . $centerLogoFile;

            // Validate file extension
            $fileExtension = strtolower(pathinfo($_FILES["center_logo"]["name"], PATHINFO_EXTENSION));
            if (in_array($fileExtension, $allowedExtensions)) {
                // Move the uploaded file
                if (move_uploaded_file($_FILES["center_logo"]["tmp_name"], $centerLogoPath)) {
                    if ($row['COUNT(*)'] == 0) {
                        $sql = "INSERT INTO `logo` (`center_name`, `short_desc`, `email`, `contact`, `address`, `logo_pic`) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                    } else {
                        // Update the existing record (again using the `id` to target the correct record)
                        $sql = "UPDATE `logo` SET `center_name` = ?, `short_desc` = ?, `email` = ?, `contact` = ?, 
                                `address` = ?, `logo_pic` = ? WHERE `id` = 1";
                    }

                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ssssss", $centerName, $shortDesc, $email, $contact, $address, $centerLogoPath);
                    mysqli_stmt_execute($stmt);
                } else {
                    echo '<script>';
                    echo 'alert("Center logo upload failed!");';
                    echo '</script>';
                }
            } else {
                echo '<script>';
                echo 'alert("Invalid file type. Only JPG, JPEG, PNG allowed.");';
                echo '</script>';
            }
        }
    }

    // Check if the update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo '<script>';
        echo 'alert("Saved successfully!");';
        echo 'window.location.href = "../wsLogoandFooterSettings.php";';  // Optional: Redirect after alert
        echo '</script>';
    } else {
        // If no rows affected, possibly an error
        echo '<script>';
        echo 'alert("No changes were made.");';
        echo '</script>';
    }
}
?>
