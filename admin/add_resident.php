<?php
include "dbcon.php";
include "phpqrcode/qrlib.php"; // Include PHP QR Code library

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect resident data from the form
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    $suffix = $_POST["suffix"];
    $sex = $_POST["sex"];
    $dateOfBirth = $_POST["date"];
    $placeOfBirth = mysqli_real_escape_string($conn, $_POST["bday"]);
    $religion = $_POST["religion"];
    $citizenship = $_POST["citizenship"];

    // Address Information
    $street = $_POST["street"];
    $zone = $_POST["zone"];
    $brgy = $_POST["brgy"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $zipcode = $_POST["zipcode"];

    // Contact Information
    $contact = $_POST["contact"];

    // Educational and Occupational Information
    $educational = mysqli_real_escape_string($conn, $_POST["educational"]);
    $occupation = $_POST["occupation"];
    $civilStatus = $_POST["civilStatus"];
    $laborStatus = $_POST["labor"];
    $voterStatus = $_POST["voter"];
    $pwdStatus = $_POST["pwd"];
    $fourPStatus = $_POST["forp"];
    // $covidVaccinationStatus = $_POST["covid"];
    $status = $_POST["Status"];

    // Geographic Information
    $longitude = $_POST["longitude"];
    $latitude = $_POST["Latitude"];

    $id_card_no = $_POST['id_card_no'];

    // Initialize the image variable
    $new_img_name = NULL;

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        // Specify the target directory for storing uploaded images
        $target_dir = "residents_img/";
        
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
            if (!move_uploaded_file($tmp_name, $target_dir . $new_img_name)) {
                echo "Image upload failed!";
                exit();
            }
        } else {
            echo "Please upload a valid image file (jpeg, jpg, png).";
            exit();
        }
    }

    // Prepare SQL query to insert resident data into the database
    $sql = "INSERT INTO `residents` 
    (`fname`, `mname`, `lname`, `suffix`, `sex`, `bday`, `pob`, `religion`, `citizenship`, `street`, `zone`, `brgy`, `mun`, `province`, `zipcode`, `contact`, `educational`, `occupation`, `civil_status`, `labor_status`, `voter_status`, `pwd_status`, `four_p`, `vac_status`, `status`, `longitude`, `latitude`, `id_card_no`, `profile`, `qr_code`) 
    VALUES 
    ('$fname', '$mname', '$lname', '$suffix', '$sex', '$dateOfBirth', '$placeOfBirth', '$religion', '$citizenship', '$street', '$zone', '$brgy', '$city', '$province', '$zipcode', '$contact', '$educational', '$occupation', '$civilStatus', '$laborStatus', '$voterStatus', '$pwdStatus', '$fourPStatus', '$covidVaccinationStatus', '$status', '$longitude', '$latitude', '$id_card_no', '$new_img_name', NULL)";
    
    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Get the last inserted resident ID
        $resident_id = mysqli_insert_id($conn);

      // Generate QR Code
$qrContent = $id_card_no;  // QR code content, based on id_card_no

// Directory to save QR codes (you can leave this out from the database, as you're storing just the file name)
$qrDir = 'qrcodes/';
if (!file_exists($qrDir)) {
    mkdir($qrDir, 0777, true); // Ensure the directory exists
}

// File name for the QR code (only the file name, no folder path)
$qrFileName = $id_card_no . '_qrcode.png'; // Save only the file name

// Generate the QR code
QRcode::png($qrContent, $qrDir . $qrFileName, QR_ECLEVEL_L, 10); // Save QR code with full path

// Update the resident record with the file name only (no directory path)
$update_sql = "UPDATE residents SET qr_code='$qrFileName' WHERE id='$resident_id'";
mysqli_query($conn, $update_sql);



        // Redirect or display a success message
        header("Location: residents.php?added=Saved Successfully");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
