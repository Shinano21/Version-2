<?php
include "dbcon.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file was uploaded without errors
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
    $covidVaccinationStatus = $_POST["covid"];
    $status = $_POST["Status"];

    // Geographic Information
    $longitude = $_POST["longitude"];
    $latitude = $_POST["Latitude"];

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
            if (move_uploaded_file($tmp_name, $target_dir . $new_img_name)) {
                // Continue with your existing code
            } else {
                echo "Image upload failed!";
                exit();
            }
        } else {
            echo "Please upload a valid image file (jpeg, jpg, png).";
            exit();
        }
    }
  
$sql = "INSERT INTO `residents` (`fname`, `mname`, `lname`, `suffix`, `sex`, `bday`, `pob`, `religion`, `citizenship`, `street`, `zone`, `brgy`, `mun`, `province`, `zipcode`, `contact`, `educational`, `occupation`, `civil_status`, `labor_status`, `voter_status`, `pwd_status`, `four_p`, `vac_status`, `status`, `longitude`, `latitude`, `profile`) VALUES ('$fname', '$mname', '$lname', '$suffix', '$sex', '$dateOfBirth', '$placeOfBirth', '$religion', '$citizenship', '$street', '$zone', '$brgy', '$city', '$province', '$zipcode', '$contact', '$educational', '$occupation', '$civilStatus', '$laborStatus', '$voterStatus', '$pwdStatus', '$fourPStatus', '$covidVaccinationStatus', '$status', '$longitude', '$latitude', '$new_img_name')";

// Execute the query
if (mysqli_query($conn, $sql)) {
    header("Location: residents.php?added=Saved Successfully");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

?>