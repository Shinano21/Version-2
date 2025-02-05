<?php
session_start();

include "dbcon.php";
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Resident Record | CareVisio</title>
    <?php include "partials/head.php"; ?>
</head>

<body onload="display_ct();">

    <?php
    $fname = $mname = $lname = $suffix = $sex = $dateOfBirth = $placeOfBirth = $religion = $citizenship = $street = $zone = $brgy = $city = $province = $zipcode = $contact = $educational = $occupation = $civilStatus = $laborStatus = $voterStatus = $pwdStatus = $fourPStatus = $covidVaccinationStatus = $status = $longitude = $latitude = "";
    $pro = "";
    if(isset($_GET["id"])){
        $idx = $_GET["id"];
        $sql = "SELECT * FROM residents WHERE id = $idx";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch and store data in variables
        $row = mysqli_fetch_assoc($result);
        $fname = $row['fname'];
        $mname = $row['mname'];
        $lname = $row['lname'];
        $suffix = $row['suffix'];
        $sex = $row['sex'];
        $dateOfBirth = $row['bday'];
        $placeOfBirth = $row['pob'];
        $religion = $row['religion'];
        $citizenship = $row['citizenship'];
        $street = $row['street'];
        $zone = $row['zone'];
        $brgy = $row['brgy'];
        $city = $row['mun'];
        $province = $row['province'];
        $zipcode = $row['zipcode'];
        $contact = $row['contact'];
        $educational = $row['educational'];
        $occupation = $row['occupation'];
        $civilStatus = $row['civil_status'];
        $laborStatus = $row['labor_status'];
        $voterStatus = $row['voter_status'];
        $pwdStatus = $row['pwd_status'];
        $fourPStatus = $row['four_p'];
        $covidVaccinationStatus = $row['vac_status'];
        $status = $row['status'];
        $longitude = $row['longitude'];
        $latitude = $row['latitude'];
        $pro = $row["profile"];
        
    
        // Now, you have all the data in variables for further use.
    } else {
        echo "No results found.";
    }
    }

    ?>

    <?php
        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "System Administrator") {
            include "partials/admin_sidebar.php";
        } else {
            include "partials/sidebar.php";
        }
    ?>
    <!-- /# sidebar -->
    <?php include "partials/header.php"?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                 <a href="residents.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Residents Records</h7>
                                </a>
                                <h1>UPDATE - RESIDENT FORM</h1>

                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="residents.php">Resident Records</a></li>
                                    <li class="breadcrumb-item active">Update - RESIDENT FORM</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <form enctype="multipart/form-data" method="post" action="update_resident.php">
                            <div id="resident_form">

                                <table>
                                <tr>
                <th colspan="4" style="text-align: center; font-size: 1.2em; padding: 10px; background-color: #f1f1f1; font-weight: bold;">
                    Personal Info Section
                </th>
            </tr>
                                    <tr>
                                        <th rowspan="3">
                                            <img id="previewImage" src="residents_img/pp.png">
                                        </th>
                                        <th>
                                            <label>Firstname</label>
                                            <br>
                                            <input type="text" name="fname" required value="<?php if(isset($_GET["id"])){
                                                echo $fname;
                                            }?>">
                                        </th>
                                        <th>
                                            <label>Middlename</label>
                                            <br>
                                            <input type="text" name="mname" value="<?php if(isset($_GET["id"])){
                                                echo $mname;
                                            }?>">
                                        </th>
                                        <th>
                                            <label>Lastname</label>
                                            <br>
                                            <input type="text" name="lname" required value="<?php if(isset($_GET["id"])){
                                                echo $lname;
                                            }?>">
                                        </th>
                                    </tr>
                                    <tr>
                                        <!--<th></th>-->
                                        <th>
                                            <label>Suffix</label>
                                            <br>
                                            <input type="text" name="suffix" value="<?php if(isset($_GET["id"])){
                                                echo $suffix;
                                            }?>">
                                        </th>
                                        <th>
                                            <label>Sex</label>
                                            <br>
                                            <select name="sex">
                                                <?php  if(isset($_GET["id"])){
                                                    echo "<option selected value='$sex'>" .$sex. "</option>";
                                                }?>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>

                                            </select>
                                        </th>
                                        <th>
                                            <label>Date of Birth</label>
                                            <br>
                                            <input type="date" name="date" required value="<?php if(isset($_GET["id"])){
                                                echo $dateOfBirth;
                                            }?>">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>Age</label>
                                            <br>
                                            <input type="text" name="bday" value="<?php 
                                                if(isset($_GET["id"])) {
                                                    // Calculate age based on the date of birth
                                                    $dob = new DateTime($dateOfBirth);
                                                    $today = new DateTime();
                                                    $age = $today->diff($dob)->y;
                                                    echo $age;
                                                }
                                            ?>">
                                        </th>
                                        <th>
                                            <label>Place of Birth</label>
                                            <br>
                                            <input type="text" name="bday" value="<?php if(isset($_GET["id"])){
                                                echo $placeOfBirth;
                                            }?>">
                                        </th>
                                        <th>
                                            <label>Religion</label>
                                            <br>
                                            <input type="text" name="religion" value="<?php if(isset($_GET["id"])){
                                                echo $religion;
                                            }?>">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="margin:10%;">
                                            <br>
                                            <br>
                                            <button type="button" id="uplBtn">Select Image</button>
                                            <input type="file" id="upl" name="image" accept="image/*" style="display: none;">
                                        </th>
                                        <th>
                                            <label>Citizenship</label>
                                            <br>
                                            <input type="text" name="citizenship" value="<?php if(isset($_GET["id"])){
                                                echo $citizenship;
                                            }?>">
                                        </th>
                                        <tr>
                        <td colspan="4" style="height: 40px;"></td>
                    </tr>
                    <tr>
                <th colspan="4" style="text-align: center; font-size: 1.2em; padding: 10px; background-color: #f1f1f1; font-weight: bold;">
                    Address Section
                </th>
            </tr>
                                        <th>
                                            <label>Street name</label>
                                            <br>
                                            <input type="text" name="street" value="<?php if(isset($_GET["id"])){
                                                echo $street;
                                            }?>">
                                        </th>
                                        <th>
                                            <label>Zone</label>
                                            <br>
                                            <select id="purokSelect" name="zone">
                                                <?php  echo "<option value='$zone'>" .$zone. "</option>"; ?>
                                                <option value="Purok 1">Purok 1</option>
                                                <option value="Purok 2">Purok 2</option>
                                                <option value="Purok 3">Purok 3</option>
                                                <option value="Purok 4">Purok 4</option>
                                                <option value="Purok 5">Purok 5</option>
                                                <option value="Purok 6">Purok 6</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                        <label for="brgy">Barangay</label><br>
                                        <input type="text" id="brgySearch" placeholder="Search Barangay"  onfocus="showDropdown()"
    onkeyup="filterBarangay()"
    onblur="hideDropdown()">
<br>
<select id="brgy" name="brgy" size="10" onchange="selectBarangay()"  style="display: none; position: absolute; z-index: 10; width: 100%;">
<option value="Bgy. 1 Em's Barrio" <?php if(isset($brgy) && $brgy == "Bgy. 1 Em's Barrio") echo "selected"; ?>>Bgy. 1 Em's Barrio</option>
    <option value="Bgy. 2 Em's Barrio South" <?php if(isset($brgy) && $brgy == "Bgy. 2 Em's Barrio South") echo "selected"; ?>>Bgy. 2 Em's Barrio South</option>
    <option value="Bgy. 3 Em's Barrio East" <?php if(isset($brgy) && $brgy == "Bgy. 3 Em's Barrio East") echo "selected"; ?>>Bgy. 3 Em's Barrio East</option>
    <option value="Bgy. 4 Sagpon Pob." <?php if(isset($brgy) && $brgy == "Bgy. 4 Sagpon Pob.") echo "selected"; ?>>Bgy. 4 Sagpon Pob.</option>
    <option value="Bgy. 5 Sagmin Pob." <?php if(isset($brgy) && $brgy == "Bgy. 5 Sagmin Pob.") echo "selected"; ?>>Bgy. 5 Sagmin Pob.</option>
    <option value="Bgy. 6 Bañadero Pob." <?php if(isset($brgy) && $brgy == "Bgy. 6 Bañadero Pob.") echo "selected"; ?>>Bgy. 6 Bañadero Pob.</option>
    <option value="Bgy. 7 Baño" <?php if(isset($brgy) && $brgy == "Bgy. 7 Baño") echo "selected"; ?>>Bgy. 7 Baño</option>
    <option value="Bgy. 8 Bagumbayan" <?php if(isset($brgy) && $brgy == "Bgy. 8 Bagumbayan") echo "selected"; ?>>Bgy. 8 Bagumbayan</option>
    <option value="Bgy. 9 Pinaric" <?php if(isset($brgy) && $brgy == "Bgy. 9 Pinaric") echo "selected"; ?>>Bgy. 9 Pinaric</option>
    <option value="Bgy. 10 Cabugao" <?php if(isset($brgy) && $brgy == "Bgy. 10 Cabugao") echo "selected"; ?>>Bgy. 10 Cabugao</option>
    <option value="Bgy. 11 Maoyod Pob." <?php if(isset($brgy) && $brgy == "Bgy. 11 Maoyod Pob.") echo "selected"; ?>>Bgy. 11 Maoyod Pob.</option>
    <option value="Bgy. 12 Tula-tula" <?php if(isset($brgy) && $brgy == "Bgy. 12 Tula-tula") echo "selected"; ?>>Bgy. 12 Tula-tula</option>
    <option value="Bgy. 13 Ilawod West Pob." <?php if(isset($brgy) && $brgy == "Bgy. 13 Ilawod West Pob.") echo "selected"; ?>>Bgy. 13 Ilawod West Pob.</option>
    <option value="Bgy. 14 Ilawod Pob." <?php if(isset($brgy) && $brgy == "Bgy. 14 Ilawod Pob.") echo "selected"; ?>>Bgy. 14 Ilawod Pob.</option>
    <option value="Bgy. 15 Ilawod East Pob." <?php if(isset($brgy) && $brgy == "Bgy. 15 Ilawod East Pob.") echo "selected"; ?>>Bgy. 15 Ilawod East Pob.</option>
    <option value="Bgy. 16 Kawit-East Washington Drive" <?php if(isset($brgy) && $brgy == "Bgy. 16 Kawit-East Washington Drive") echo "selected"; ?>>Bgy. 16 Kawit-East Washington Drive</option>
    <option value="Bgy. 17 Rizal Street., Ilawod" <?php if(isset($brgy) && $brgy == "Bgy. 17 Rizal Street., Ilawod") echo "selected"; ?>>Bgy. 17 Rizal Street., Ilawod</option>
    <option value="Bgy. 18 Cabagñan West" <?php if(isset($brgy) && $brgy == "Bgy. 18 Cabagñan West") echo "selected"; ?>>Bgy. 18 Cabagñan West</option>
    <option value="Bgy. 19 Cabagñan" <?php if(isset($brgy) && $brgy == "Bgy. 19 Cabagñan") echo "selected"; ?>>Bgy. 19 Cabagñan</option>
    <option value="Bgy. 20 Cabagñan East" <?php if(isset($brgy) && $brgy == "Bgy. 20 Cabagñan East") echo "selected"; ?>>Bgy. 20 Cabagñan East</option>
    <option value="Bgy. 21 Binanuahan West" <?php if(isset($brgy) && $brgy == "Bgy. 21 Binanuahan West") echo "selected"; ?>>Bgy. 21 Binanuahan West</option>
    <option value="Bgy. 22 Binanuahan East" <?php if(isset($brgy) && $brgy == "Bgy. 22 Binanuahan East") echo "selected"; ?>>Bgy. 22 Binanuahan East</option>
    <option value="Bgy. 23 Imperial Court Subd." <?php if(isset($brgy) && $brgy == "Bgy. 23 Imperial Court Subd.") echo "selected"; ?>>Bgy. 23 Imperial Court Subd.</option>
    <option value="Bgy. 24 Rizal Street" <?php if(isset($brgy) && $brgy == "Bgy. 24 Rizal Street") echo "selected"; ?>>Bgy. 24 Rizal Street</option>
    <option value="Bgy. 25 Lapu-lapu" <?php if(isset($brgy) && $brgy == "Bgy. 25 Lapu-lapu") echo "selected"; ?>>Bgy. 25 Lapu-lapu</option>
    <option value="Bgy. 26 Dinagaan" <?php if(isset($brgy) && $brgy == "Bgy. 26 Dinagaan") echo "selected"; ?>>Bgy. 26 Dinagaan</option>
    <option value="Bgy. 27 Victory Village South" <?php if(isset($brgy) && $brgy == "Bgy. 27 Victory Village South") echo "selected"; ?>>Bgy. 27 Victory Village South</option>
    <option value="Bgy. 28 Victory Village North" <?php if(isset($brgy) && $brgy == "Bgy. 28 Victory Village North") echo "selected"; ?>>Bgy. 28 Victory Village North</option>
    <option value="Bgy. 29 Sabang" <?php if(isset($brgy) && $brgy == "Bgy. 29 Sabang") echo "selected"; ?>>Bgy. 29 Sabang</option>
    <option value="Bgy. 30 Pigcale" <?php if(isset($brgy) && $brgy == "Bgy. 30 Pigcale") echo "selected"; ?>>Bgy. 30 Pigcale</option>
    <option value="Bgy. 31 Centro-Baybay" <?php if(isset($brgy) && $brgy == "Bgy. 31 Centro-Baybay") echo "selected"; ?>>Bgy. 31 Centro-Baybay</option>
    <option value="Bgy. 32 San Roque" <?php if(isset($brgy) && $brgy == "Bgy. 32 San Roque") echo "selected"; ?>>Bgy. 32 San Roque</option>
    <option value="Bgy. 33 PNR-Peñaranda St.-Iraya" <?php if(isset($brgy) && $brgy == "Bgy. 33 PNR-Peñaranda St.-Iraya") echo "selected"; ?>>Bgy. 33 PNR-Peñaranda St.-Iraya</option>
    <option value="Bgy. 34 Oro Site-Magallanes St." <?php if(isset($brgy) && $brgy == "Bgy. 34 Oro Site-Magallanes St.") echo "selected"; ?>>Bgy. 34 Oro Site-Magallanes St.</option>
    <option value="Bgy. 35 Tinago" <?php if(isset($brgy) && $brgy == "Bgy. 35 Tinago") echo "selected"; ?>>Bgy. 35 Tinago</option>
    <option value="Bgy. 36 Kapantawan" <?php if(isset($brgy) && $brgy == "Bgy. 36 Kapantawan") echo "selected"; ?>>Bgy. 36 Kapantawan</option>
    <option value="Bgy. 37 Bitano" <?php if(isset($brgy) && $brgy == "Bgy. 37 Bitano") echo "selected"; ?>>Bgy. 37 Bitano</option>
    <option value="Bgy. 38 Gogon" <?php if(isset($brgy) && $brgy == "Bgy. 38 Gogon") echo "selected"; ?>>Bgy. 38 Gogon</option>
    <option value="Bgy. 39 Bonot" <?php if(isset($brgy) && $brgy == "Bgy. 39 Bonot") echo "selected"; ?>>Bgy. 39 Bonot</option>
    <option value="Bgy. 40 Cruzada" <?php if(isset($brgy) && $brgy == "Bgy. 40 Cruzada") echo "selected"; ?>>Bgy. 40 Cruzada</option>
    <option value="Bgy. 41 Bogtong" <?php if(isset($brgy) && $brgy == "Bgy. 41 Bogtong") echo "selected"; ?>>Bgy. 41 Bogtong</option>
    <option value="Bgy. 42 Rawis" <?php if(isset($brgy) && $brgy == "Bgy. 42 Rawis") echo "selected"; ?>>Bgy. 42 Rawis</option>
    <option value="Bgy. 43 Tamaoyan" <?php if(isset($brgy) && $brgy == "Bgy. 43 Tamaoyan") echo "selected"; ?>>Bgy. 43 Tamaoyan</option>
    <option value="Bgy. 44 Pawa" <?php if(isset($brgy) && $brgy == "Bgy. 44 Pawa") echo "selected"; ?>>Bgy. 44 Pawa</option>
    <option value="Bgy. 45 Dita" <?php if(isset($brgy) && $brgy == "Bgy. 45 Dita") echo "selected"; ?>>Bgy. 45 Dita</option>
    <option value="Bgy. 46 San Joaquin" <?php if(isset($brgy) && $brgy == "Bgy. 46 San Joaquin") echo "selected"; ?>>Bgy. 46 San Joaquin</option>
<option value="Bgy. 47 Arimbay" <?php if(isset($brgy) && $brgy == "Bgy. 47 Arimbay") echo "selected"; ?>>Bgy. 47 Arimbay</option>
<option value="Bgy. 48 Bagong Abre" <?php if(isset($brgy) && $brgy == "Bgy. 48 Bagong Abre") echo "selected"; ?>>Bgy. 48 Bagong Abre</option>
<option value="Bgy. 49 Bigaa" <?php if(isset($brgy) && $brgy == "Bgy. 49 Bigaa") echo "selected"; ?>>Bgy. 49 Bigaa</option>
<option value="Bgy. 50 Padang" <?php if(isset($brgy) && $brgy == "Bgy. 50 Padang") echo "selected"; ?>>Bgy. 50 Padang</option>
<option value="Bgy. 51 Buyuan" <?php if(isset($brgy) && $brgy == "Bgy. 51 Buyuan") echo "selected"; ?>>Bgy. 51 Buyuan</option>
<option value="Bgy. 52 Matanag" <?php if(isset($brgy) && $brgy == "Bgy. 52 Matanag") echo "selected"; ?>>Bgy. 52 Matanag</option>
<option value="Bgy. 53 Bonga" <?php if(isset($brgy) && $brgy == "Bgy. 53 Bonga") echo "selected"; ?>>Bgy. 53 Bonga</option>
<option value="Bgy. 54 Mabinit" <?php if(isset($brgy) && $brgy == "Bgy. 54 Mabinit") echo "selected"; ?>>Bgy. 54 Mabinit</option>
<option value="Bgy. 55 Estanza" <?php if(isset($brgy) && $brgy == "Bgy. 55 Estanza") echo "selected"; ?>>Bgy. 55 Estanza</option>
<option value="Bgy. 56 Taysan" <?php if(isset($brgy) && $brgy == "Bgy. 56 Taysan") echo "selected"; ?>>Bgy. 56 Taysan</option>
<option value="Bgy. 57 Dap-dap" <?php if(isset($brgy) && $brgy == "Bgy. 57 Dap-dap") echo "selected"; ?>>Bgy. 57 Dap-dap</option>
<option value="Bgy. 58 Buragwis" <?php if(isset($brgy) && $brgy == "Bgy. 58 Buragwis") echo "selected"; ?>>Bgy. 58 Buragwis</option>
<option value="Bgy. 59 Puro" <?php if(isset($brgy) && $brgy == "Bgy. 59 Puro") echo "selected"; ?>>Bgy. 59 Puro</option>
<option value="Bgy. 60 Lamba" <?php if(isset($brgy) && $brgy == "Bgy. 60 Lamba") echo "selected"; ?>>Bgy. 60 Lamba</option>
<option value="Bgy. 61 Maslog" <?php if(isset($brgy) && $brgy == "Bgy. 61 Maslog") echo "selected"; ?>>Bgy. 61 Maslog</option>
<option value="Bgy. 62 Homapon" <?php if(isset($brgy) && $brgy == "Bgy. 62 Homapon") echo "selected"; ?>>Bgy. 62 Homapon</option>
<option value="Bgy. 63 Mariawa" <?php if(isset($brgy) && $brgy == "Bgy. 63 Mariawa") echo "selected"; ?>>Bgy. 63 Mariawa</option>
<option value="Bgy. 64 Bagacay" <?php if(isset($brgy) && $brgy == "Bgy. 64 Bagacay") echo "selected"; ?>>Bgy. 64 Bagacay</option>
<option value="Bgy. 65 Imalnod" <?php if(isset($brgy) && $brgy == "Bgy. 65 Imalnod") echo "selected"; ?>>Bgy. 65 Imalnod</option>
<option value="Bgy. 66 Banquerohan" <?php if(isset($brgy) && $brgy == "Bgy. 66 Banquerohan") echo "selected"; ?>>Bgy. 66 Banquerohan</option>
<option value="Bgy. 67 Bariis" <?php if(isset($brgy) && $brgy == "Bgy. 67 Bariis") echo "selected"; ?>>Bgy. 67 Bariis</option>
<option value="Bgy. 68 San Francisco" <?php if(isset($brgy) && $brgy == "Bgy. 68 San Francisco") echo "selected"; ?>>Bgy. 68 San Francisco</option>
<option value="Bgy. 69 Buenavista" <?php if(isset($brgy) && $brgy == "Bgy. 69 Buenavista") echo "selected"; ?>>Bgy. 69 Buenavista</option>
<option value="Bgy. 70 Cagbacong" <?php if(isset($brgy) && $brgy == "Bgy. 70 Cagbacong") echo "selected"; ?>>Bgy. 70 Cagbacong</option>


</select>
                                        </th>
                                        <th>
                                            <label>City Municipality</label>
                                            <br>
                                            <input type="text" value="Legazpi" name="city">
                                        </th>
                                        <th>
                                            <label>Province</label>
                                            <br>
                                            <input type="text" value="Albay" name="province">
                                        </th>
                                        <th>
                                            <label>Zip code</label>
                                            <br>
                                            <input type="text" value="4500" name="zipcode">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>Contact Number</label>
                                            <br>
                                            <input type="text" name="contact" value="<?php if(isset($_GET["id"])){
                                                echo $contact;
                                            }?>">
                                        </th>
                                        <tr>
                        <td colspan="4" style="height: 40px;"></td>
                    </tr>
                    <tr>
                <th colspan="4" style="text-align: center; font-size: 1.2em; padding: 10px; background-color: #f1f1f1; font-weight: bold;">
                    Socio-Demographic Section
                </th>
            </tr>
                                        <th>
                                            <label>Educational Attainment</label>
                                            <br>

                                            <select name="educational">
                                                <?php  echo "<option selected value='$educational'>" .$educational. "</option>"; ?>
                                                <option value="Preschool">Preschool</option>
                                                <option value="Elementary">Elementary</option>
                                                <option value="Elementary Graduate">Elementary Graduate</option>
                                                <option value="Junior High School">Junior High School</option>
                                                <option value="Junior High School Graduate">Junior High School Graduate
                                                </option>
                                                <option value="Senior High School">Senior High School</option>
                                                <option value="Senior High School Graduate">Senior High School Graduate
                                                </option>
                                                <option value="Undergraduate">Undergraduate</option>
                                                <option value="Some College Units">Some College Units</option>
                                                <option value="College Degree">College Degree</option>
                                                <option value="Some Masteral Units">Some Masteral Units</option>
                                                <option value="Master's Degree">Master's Degree</option>
                                                <option value="Some Doctoral Units">Some Doctoral Units</option>
                                                <option value="Doctoral Degree">Doctoral Degree</option>
                                                <option value="No Formal Education">No Formal Education</option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>Occupation</label>
                                            <br>
                                            <input type="text" value="<?php if(isset($_GET["id"])){
            echo $occupation;
        }?>" name="occupation">
                                        </th>
                                        <th>
                                            <label>Civil Status</label>
                                            <br>
                                            <select id="civilStatus" name="civilStatus">
                                                <?php  echo "<option selected value='$civilStatus'>" .$civilStatus. "</option>"; ?>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Separated">Separated</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>Labor force status</label>
                                            <br>
                                            <select name="labor">
                                                <?php  echo "<option selected value='$laborStatus'>" .$laborStatus. "</option>"; ?>
                                                <option value="Employed">Employed</option>
                                                <option value="Unemployed">Unemployed</option>
                                                <option value="Not in the Labor Force">Not in the Labor Force</option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>Voter status</label>
                                            <br>
                                            <select name="voter">
                                                <?php  echo "<option selected value='$voterStatus'>" .$voterStatus. "</option>"; ?>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>PWD status</label>
                                            <br>
                                            <select name="pwd">
                                                <?php  echo "<option selected value='$pwdStatus'>" .$pwdStatus. "</option>"; ?>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>4P's Beneficiary</label>
                                            <br>
                                            <select name="forp">
                                                <?php  echo "<option selected value='$fourPStatus'>" .$fourPStatus. "</option>"; ?>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </th>
                                        
                                    </tr>
                                    <tr>
                                        <!-- <th>
                                            <label>Covid-19 Vaccination Status</label>
                                            <br>
                                            <select name="covid">
                                               
                                                <option value="Fully Vaccinated">Fully Vaccinated</option>
                                                <option value="First Dose Vaccinated">First Dose Vaccinated</option>
                                                <option value="Unvaccinated">Unvaccinated</option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>
                                        </th> -->
                                        
                                        <th>
                                            <label>Status</label>
                                            <br>
                                            <select name="Status">
                                                <?php  echo "<option selected value='$status'>" .$status. "</option>"; ?>
                                                <option value="Active" selected>Active</option>
                                                <option value="Dead">Dead</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label>Longitude</label>
                                            <br>
                                            <input type="text" name="longitude" id="logi" value="<?php if(isset($_GET["id"])){
            echo $longitude;
        }?>">
                                        </th>
                                        <th>
                                            <label>Latitude</label>
                                            <br>
                                            <input type="text" name="Latitude" id="lati" value="<?php if(isset($_GET["id"])){
            echo $latitude;
        }?>">
                                        </th>

                                    </tr>
                                </table>
                                <br>
                                <input type="number" value="<?php if(isset($_GET["id"])){
            echo $_GET["id"];
        }?>" readonly style="display:none;" name="id">
                                <div id="map" style="height: 400px; width: 100%;"></div>
                                <br>
                                <button class="aa save" type="submit" onclick="submitForm()"> SAVE</button>
                                <a href="residents.php"><button class="aa cancel" id="cancel1" type="button">
                                        CANCEL</button></a>

                                <!--<p id="coordinates">Coordinates: 13.142307, 123.71827</p>-->

                                <script>
                                let getlongitude = document.getElementById('logi').value;
                                let getlatitude = document.getElementById('lati').value;
                                const map = L.map('map').setView([13.142307, 123.71827],
                                    12); // Set the initial view and zoom level
                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(
                                    map); // Add a basemap (OpenStreetMap)

                                // Create a marker with a draggable option
                                const marker = L.marker([getlatitude, getlongitude], {
                                    draggable: true
                                }).addTo(map);

                                map.addControl(L.control.fullscreen());

               //this fetches the coordinates from the database
               fetch('fetch_coordinates.php')
    .then(response => response.json())
    .then(boundaries => {
        boundaries.forEach(boundary => {
            // Parse GeoJSON data for the boundary
            const geoJsonData = {
                type: "Feature",
                properties: {
                    purokName: boundary.purok_name,
                    barangayName: boundary.barangay_name,
                    color: boundary.color
                },
                geometry: boundary.boundary_coordinates
            };

            // Add the boundary as a polygon to the map
            L.geoJSON(geoJsonData, {
                style: function (feature) {
                    return {
                        fillColor: feature.properties.color,
                        color: feature.properties.color, // Border color
                        weight: 2, // Border width
                        fillOpacity: 0.5 // Fill opacity
                    };
                },
                onEachFeature: function (feature, layer) {
                    // Add popup with Purok and Barangay names
                    layer.bindPopup(
                        `<b>Purok:</b> ${feature.properties.purokName}<br>
                         `
                    );
                }
            }).addTo(map);
        });
    })
    .catch(error => console.error('Error fetching boundary data:', error));

                                // Update the <p> element with the marker's coordinates
                                function updateCoordinates(lat, lng) {
                                    //  const coordinatesElement = document.getElementById('coordinates');
                                    const longitude = document.getElementById('logi');
                                    const latitude = document.getElementById('lati');
                                    //coordinatesElement.textContent = `Coordinates: ${lat}, ${lng}`;
                                    longitude.value = lng;
                                    latitude.value = lat;
                                }

                                // Initialize the <p> element with the default coordinates
                                updateCoordinates(marker.getLatLng().lat, marker.getLatLng().lng);

                                // Update the <p> element when the marker is dragged
                                marker.on('dragend', function(event) {
                                    updateCoordinates(event.target.getLatLng().lat, event.target.getLatLng()
                                        .lng);
                                });
                                
                                const imageUpload = document.getElementById('upl');
                                const uploadButton = document.getElementById('uplBtn');
                                const previewImage = document.getElementById('previewImage');
                                const fileNameDisplay = document.getElementById('fileNameDisplay');

                                // Display the saved image when updating
                                const savedImage = '<?php echo isset($_GET["id"]) ? 'residents_img/' . $pro : ''; ?>';

                                // Set the preview image source
                                if (savedImage) {
                                    previewImage.src = savedImage;
                                } else {
                                    previewImage.src = 'residents_img/pp.png';
                                }

                                uploadButton.addEventListener('click', function() {
                                    imageUpload.click();
                                });

                                imageUpload.addEventListener('change', function() {
                                    const selectedFile = imageUpload.files[0];

                                    if (selectedFile) {
                                        const objectURL = URL.createObjectURL(selectedFile);
                                        previewImage.src = objectURL;

                                        // Display the selected file name
                                        fileNameDisplay.textContent = selectedFile.name;
                                    }
                                    // No else condition here, to retain the saved image if no new image is selected
                                });

                                </script>
                                <script>
                                    function submitForm() {
                                        const formData = new FormData(document.getElementById('yourFormId'));

                                        // Make AJAX request to submit formData
                                        fetch('update_resident.php', {
                                            method: 'POST',
                                            body: formData
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                // If the response status is not in the range 200-299 (i.e., not successful)
                                                throw new Error('Network response was not ok');
                                            }
                                            // Assuming the server returns JSON data
                                            return response.json(); // Parse response body as JSON
                                        })
                                        .then(data => {
                                            // Handle successful response
                                            // 'data' contains the parsed JSON response from the server
                                            console.log(data); // Log the response data or perform further actions
                                        })
                                        .catch(error => {
                                            // Handle error occurred during the request
                                            console.error('Error:', error);
                                        });
                                    }
                                </script>

                            </div>
                        </form>
                        <style>
                            body{
                            background-color: #CDE8E5;

                        }
                        #map {
                            width: 100%;
                            height: 60vh;
                            box-shadow: 0px 0px 2px gray;
                        }

                        #resident_form {
                            margin: 0 auto;
                            padding: 20px;
                            width: 80vw;
                            height: 100%;

                            background-color: white;



                        }

                        #resident_form>table {
                            margin: 0 auto;

                            width: 100%;

                        }

                        label~input,
                        label~select {
                            width: 98%;
                            padding: 5px;
                            border: none;
                            box-shadow: 0px 0px 3px gray;
                            border-radius: 4px;
                        }

                        th {
                            position: relative;
                        }

                        th>img {
                            width: 98%;
                            height: 120%;
                            padding: 5px;
                            position: absolute;
                            top: 0;
                            left: 0;

                        }

                        th>button {
                            font-weight: bold;
                            color: white;
                            width: 98%;
                            padding: 10px;
                            border: none;
                            border-radius: 5px;
                            background-color: rgb(102, 105, 211);
                            box-shadow: 0px 0px 2px gray;
                            cursor: pointer;
                        }

                        .aa {
                            padding: 10px 20px;
                            border: none;
                            color: white;
                            float: right;
                            margin: 1%;
                            border-radius: 5px;
                        }

                        .cancel {
                            background-color: rgb(107, 178, 243);
                        }

                        .save {
                            background-color: rgb(102, 105, 211);
                        }

                        .row {

                            overflow-x: hidden;
                        }
                        </style>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        function display_c() {
            var refresh = 1000; // Refresh rate in milliseconds
            mytime = setTimeout('display_ct()', refresh);
        }

        function display_ct() {
            var x = new Date();
            
            // Set the time zone to Philippine Time (PHT)
            var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var timeString = x.toLocaleTimeString('en-US', options);

            // Extract the date part in the format "Day, DD Mon YYYY"
            var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });

            // Combine date and time in the desired format
            var x1 = datePart + ' - ' + timeString;

            document.getElementById('ct').innerHTML = x1;
            tt = display_c();
        }

        // Initial call to start displaying time
        display_c();

 // Show the dropdown when the user focuses on the input field
 function showDropdown() {
        const select = document.getElementById('brgy');
        select.style.display = 'block';
    }

    // Hide the dropdown when the user blurs (clicks outside) the input field
    function hideDropdown() {
        setTimeout(() => {
            const select = document.getElementById('brgy');
            select.style.display = 'none';
        }, 200); // Slight delay to allow the selection to process
    }

    // Filter barangays based on the input value
    function filterBarangay() {
        const searchInput = document.getElementById('brgySearch').value.toLowerCase();
        const select = document.getElementById('brgy');
        const options = select.options;

        for (let i = 0; i < options.length; i++) {
            const optionText = options[i].text.toLowerCase();
            options[i].style.display = optionText.includes(searchInput) ? '' : 'none';
        }
    }

    // Set the selected barangay in the input field and hide the dropdown
    function selectBarangay() {
        const select = document.getElementById('brgy');
        const input = document.getElementById('brgySearch');
        input.value = select.options[select.selectedIndex].text;

        // Hide the dropdown after selection
        select.style.display = 'none';
    }
    </script>
    <?php include "partials/scripts.php"?>
</body>

</html>