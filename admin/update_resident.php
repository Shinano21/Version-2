<?php
include "dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idToUpdate = $_POST["id"]; // ID to update

    // Retrieve all other form fields (excluding ID)
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $mname = mysqli_real_escape_string($conn, $_POST["mname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $suffix = mysqli_real_escape_string($conn, $_POST["suffix"]);
    $sex = mysqli_real_escape_string($conn, $_POST["sex"]);
    $dateOfBirth = mysqli_real_escape_string($conn, $_POST["date"]);
    $placeOfBirth = mysqli_real_escape_string($conn, $_POST["bday"]);
    $religion = mysqli_real_escape_string($conn, $_POST["religion"]);
    $citizenship = mysqli_real_escape_string($conn, $_POST["citizenship"]);
    $street = mysqli_real_escape_string($conn, $_POST["street"]);
    $zone = mysqli_real_escape_string($conn, $_POST["zone"]);
    $brgy = mysqli_real_escape_string($conn, $_POST["brgy"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $province = mysqli_real_escape_string($conn, $_POST["province"]);
    $zipcode = mysqli_real_escape_string($conn, $_POST["zipcode"]);
    $contact = mysqli_real_escape_string($conn, $_POST["contact"]);
    $educational = mysqli_real_escape_string($conn, $_POST["educational"]);
    $occupation = mysqli_real_escape_string($conn, $_POST["occupation"]);
    $civilStatus = mysqli_real_escape_string($conn, $_POST["civilStatus"]);
    $laborStatus = mysqli_real_escape_string($conn, $_POST["labor"]);
    $voterStatus = mysqli_real_escape_string($conn, $_POST["voter"]);
    $pwdStatus = mysqli_real_escape_string($conn, $_POST["pwd"]);
    $fourPStatus = mysqli_real_escape_string($conn, $_POST["forp"]);
    $status = mysqli_real_escape_string($conn, $_POST["Status"]);
    $longitude = mysqli_real_escape_string($conn, $_POST["longitude"]);
    $latitude = mysqli_real_escape_string($conn, $_POST["Latitude"]);

    // Handle image upload
    $new_img_name = ''; // Initialize to avoid undefined variable errors
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        // Specify the target directory
        $target_dir = "residents_img/";

        // Get the file extension
        $img_explode = explode('.', $img_name);
        $img_ext = strtolower(end($img_explode));

        // Check for allowed extensions
        $allowed_extensions = ["jpeg", "jpg", "png"];
        if (in_array($img_ext, $allowed_extensions)) {
            // Generate a unique name for the image
            $new_img_name = uniqid() . '.' . $img_ext;

            // Move the file to the target directory
            if (!move_uploaded_file($tmp_name, $target_dir . $new_img_name)) {
                echo "Image upload failed!";
                exit();
            }
        } else {
            echo "Please upload a valid image file (jpeg, jpg, png).";
            exit();
        }
    }

// Build the SQL query
$profile_column = $new_img_name ? "`profile` = '$new_img_name'" : ""; // No trailing comma

$sql = "UPDATE `residents` SET 
            `fname` = '$fname',
            `mname` = '$mname',
            `lname` = '$lname',
            `suffix` = '$suffix',
            `sex` = '$sex',
            `bday` = '$dateOfBirth',
            `pob` = '$placeOfBirth',
            `religion` = '$religion',
            `citizenship` = '$citizenship',
            `street` = '$street',
            `zone` = '$zone',
            `brgy` = '$brgy',
            `mun` = '$city',
            `province` = '$province',
            `zipcode` = '$zipcode',
            `contact` = '$contact',
            `educational` = '$educational',
            `occupation` = '$occupation',
            `civil_status` = '$civilStatus',
            `labor_status` = '$laborStatus',
            `voter_status` = '$voterStatus',
            `pwd_status` = '$pwdStatus',
            `four_p` = '$fourPStatus',
            `status` = '$status',
            `longitude` = '$longitude',
            `latitude` = '$latitude'";

// Append the profile column only if an image was uploaded
if (!empty($profile_column)) {
    $sql .= ", $profile_column";
}

// Add the WHERE clause
$sql .= " WHERE `id` = '$idToUpdate'";




    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header("Location: residents.php?update=Success&id=" . $idToUpdate);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
