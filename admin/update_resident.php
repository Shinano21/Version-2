<?php
include "dbcon.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $idToUpdate = $_POST["id"]; // Update the record with ID 9

    // Retrieve all other form fields (excluding ID)
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    $suffix = $_POST["suffix"];
    $sex = $_POST["sex"];
    $dateOfBirth = $_POST["date"];
    $placeOfBirth = mysqli_real_escape_string($conn, $_POST["bday"]);
    $religion = $_POST["religion"];
    $citizenship = $_POST["citizenship"];
    $street = $_POST["street"];
    $zone = $_POST["zone"];
    $brgy = $_POST["brgy"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $zipcode = $_POST["zipcode"];
    $contact = $_POST["contact"];
    $educational = mysqli_real_escape_string($conn, $_POST["educational"]);
    $occupation = $_POST["occupation"];
    $civilStatus = $_POST["civilStatus"];
    $laborStatus = $_POST["labor"];
    $voterStatus = $_POST["voter"];
    $pwdStatus = $_POST["pwd"];
    $fourPStatus = $_POST["forp"];
    $covidVaccinationStatus = $_POST["covid"];
    $status = $_POST["Status"];
    $longitude = $_POST["longitude"];
    $latitude = $_POST["Latitude"];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
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
            echo "Please upload an image file (jpeg, jpg, png).";
            exit();
        }
    }
   
    if($uniqueName==""){

 $sql = "UPDATE `residents` SET `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `suffix` = '$suffix', `sex` = '$sex', `bday` = '$dateOfBirth', `pob` = '$placeOfBirth', `religion` = '$religion', `citizenship` = '$citizenship', `street` = '$street', `zone` = '$zone', `brgy` = '$brgy', `mun` = '$city', `province` = '$province', `zipcode` = '$zipcode', `contact` = '$contact', `educational` = '$educational', `occupation` = '$occupation', `civil_status` = '$civilStatus', `labor_status` = '$laborStatus', `voter_status` = '$voterStatus', `pwd_status` = '$pwdStatus', `four_p` = '$fourPStatus', `vac_status` = '$covidVaccinationStatus', `status` = '$status', `longitude` = '$longitude', `latitude` = '$latitude', `profile` = '$new_img_name' WHERE `residents`.`id` = '$idToUpdate';";

 // Execute the query
 if (mysqli_query($conn, $sql)) {
    header("Location: residents.php?update=Success&id=". $idToUpdate);
 } else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 }
    }else{

    $sql = "UPDATE `residents` SET `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `suffix` = '$suffix', `sex` = '$sex', `bday` = '$dateOfBirth', `pob` = '$placeOfBirth', `religion` = '$religion', `citizenship` = '$citizenship', `street` = '$street', `zone` = '$zone', `brgy` = '$brgy', `mun` = '$city', `province` = '$province', `zipcode` = '$zipcode', `contact` = '$contact', `educational` = '$educational', `occupation` = '$occupation', `civil_status` = '$civilStatus', `labor_status` = '$laborStatus', `voter_status` = '$voterStatus', `pwd_status` = '$pwdStatus', `four_p` = '$fourPStatus', `vac_status` = '$covidVaccinationStatus', `status` = '$status', `longitude` = '$longitude', `latitude` = '$latitude', `profile` = '$new_img_name' WHERE `residents`.`id` = '$idToUpdate';";
    // Execute the query
    if (mysqli_query($conn, $sql)) {
         header("Location: residents.php?update=Successfully Updated&id=". $idToUpdate);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
}
?>