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
    <title>View Resident Record | CareVisio</title>
    <?php include "partials/head.php"; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <?php include "partials/sidebar.php"?>
    <!-- /# sidebar -->
    <?php include "partials/header.php" ?>

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
                                <h1>VIEW - RESIDENT </h1>
                            
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">View - RESIDENT</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row" >
                        <form enctype="multipart/form-data" method ="post" action="update_resident.php">
                            <div id="resident_form">
     
                            <table>
                            <tr>
                                        <th rowspan="3">
                                            <img id="previewImage" src="<?php echo isset($_GET["id"]) ? 'residents_img/' . $pro : ''; ?>">
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
                                        <th style="margin:10%;;">
                                            <br>
                                            <br>
                                            <button id="upl" type="button" style="display: none;"> + </button>
                                        </th>
                                        <th>
                                            <label>Citizenship</label>
                                            <br>
                                            <input type="text" name="citizenship" value="<?php if(isset($_GET["id"])){
                                                echo $citizenship;
                                            }?>">
                                        </th>
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
                                            <label>Barangay</label>
                                            <br>
                                            <input type="text" value="Bagumbayan" readonly name="brgy">
                                        </th>
                                        <th>
                                            <label>City Municipality</label>
                                            <br>
                                            <input type="text" value="Daraga" name="city">
                                        </th>
                                        <th>
                                            <label>Province</label>
                                            <br>
                                            <input type="text" value="Albay" name="province">
                                        </th>
                                        <th>
                                            <label>Zip code</label>
                                            <br>
                                            <input type="text" value="4501" name="zipcode">
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
                                        <th>
                                            <label>Covid-19 Vaccination Status</label>
                                            <br>
                                            <select name="covid">
                                                <?php  echo "<option selected value='$covidVaccinationStatus'>" .$covidVaccinationStatus. "</option>"; ?>
                                                <option value="Fully Vaccinated">Fully Vaccinated</option>
                                                <option value="First Dose Vaccinated">First Dose Vaccinated</option>
                                                <option value="Unvaccinated">Unvaccinated</option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>
                                        </th>
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
    <button id="viewQrCode" type="button" data-toggle="modal" data-target="#qrCodeModal">View QR Code</button>
    </form>

    <!-- Modal Structure -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="qrCodeModalLabel">QR Code</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <img id="qrCodeImage" src="" alt="QR Code" style="width: 100%;">
           </div>
       </div>
   </div>
</div>

<script>
   document.getElementById('viewQrCode').addEventListener('click', function() {
       const qrCodeFile = '<?php echo isset($row["qr_code"]) ? $row["qr_code"] : ""; ?>';
       document.getElementById('qrCodeImage').src = 'qrcodes/' + qrCodeFile;
   });
</script>

  <!--<p id="coordinates">Coordinates: 13.142307, 123.71827</p>-->

            <script>
                let getlongitude = document.getElementById('logi').value;
                let getlatitude = document.getElementById('lati').value;                
                const map = L.map('map').setView([13.142307, 123.71827], 16); // Set the initial view and zoom level
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(
                    map); // Add a basemap (OpenStreetMap)

                // Create a marker with a draggable option
                const marker = L.marker([getlatitude, getlongitude], {
                    draggable: false
                }).addTo(map);

                // Add the fullscreen control
                map.addControl(L.control.fullscreen());

                var bagumbayanBoundary = {
                    "type": "FeatureCollection",
                    "features": [{
                            "type": "Feature",
                            "properties": {
                                "color": "#FFA500", // Orange color
                                "label": "Purok 1"
                            },
                            "geometry": {
                                "type": "Polygon",
                                "coordinates": [
                                    // Coordinates for Purok 1
                                    [
                                        [123.7141550027024, 13.14462879590273, 0],
                                        [123.7147936410924, 13.14487242592892, 0],
                                        [123.7144505200243, 13.1456691599874, 0],
                                        [123.7138389145706, 13.14545715389615, 0],
                                        [123.7141550027024, 13.14462879590273, 0]
                                    ]
                                ]
                            }
                        },
                        {
                            "type": "Feature",
                            "properties": {
                                "color": "#FFFF00", // Yellow color
                                "label": "Purok 2"
                            },
                            "geometry": {
                                "type": "Polygon",
                                "coordinates": [
                                    // Coordinates for Purok 2
                                    [
                                        [123.7144912753046, 13.14376531519152, 0],
                                        [123.7151376698883, 13.14400970478769, 0],
                                        [123.7148049188556, 13.14482273361408, 0],
                                        [123.714187633768, 13.14459529487071, 0],
                                        [123.7144912753046, 13.14376531519152, 0]
                                    ]
                                ]
                            }
                        },
                        {
                            "type": "Feature",
                            "properties": {
                                "color": "#0000FF", // Blue color
                                "label": "Purok 3"
                            },
                            "geometry": {
                                "type": "Polygon",
                                "coordinates": [
                                    // Coordinates for Purok 3
                                    [
                                        [123.715179248218, 13.14199701147683, 0],
                                        [123.7151520319165, 13.14144822661097, 0],
                                        [123.7151020935692, 13.14118517530249, 0],
                                        [123.7155576408378, 13.14108199150418, 0],
                                        [123.7159358389064, 13.14108919427832, 0],
                                        [123.7168273879048, 13.14141788085385, 0],
                                        [123.7179209206734, 13.14156667777274, 0],
                                        [123.7179134786316, 13.14183877435733, 0],
                                        [123.7178883683979, 13.14228967580214, 0],
                                        [123.7177173933671, 13.142510845619, 0],
                                        [123.7169682842645, 13.14239670154525, 0],
                                        [123.7169052140216, 13.14267127915913, 0],
                                        [123.716796955338, 13.14279693151831, 0],
                                        [123.7167185653128, 13.1430515246491, 0],
                                        [123.7166189184585, 13.14305024389476, 0],
                                        [123.7162056281942, 13.14471033895911, 0],
                                        [123.7158738417275, 13.14465651270309, 0],
                                        [123.7150911417232, 13.14436321294716, 0],
                                        [123.7152458476366, 13.14399153708758, 0],
                                        [123.7145099725424, 13.14371103277861, 0],
                                        [123.715179248218, 13.14199701147683, 0]
                                    ]
                                ]
                            }
                        },
                        {
                            "type": "Feature",
                            "properties": {
                                "color": "#FF0000", // Red color
                                "label": "Purok 4"
                            },
                            "geometry": {
                                "type": "Polygon",
                                "coordinates": [
                                    // Coordinates for Purok 4
                                    [
                                        [123.7179251861722, 13.14156015577668, 0],
                                        [123.7168312713788, 13.14141107362962, 0],
                                        [123.7159407798371, 13.14108314896565, 0],
                                        [123.7155540591455, 13.14107514844368, 0],
                                        [123.715102044499, 13.14117701908361, 0],
                                        [123.7160997171048, 13.13860130034149, 0],
                                        [123.7206864039938, 13.1392964172139, 0],
                                        [123.7208777286604, 13.14018717691216, 0],
                                        [123.7179251861722, 13.14156015577668, 0]
                                    ]
                                ]
                            }
                        },
                        {
                            "type": "Feature",
                            "properties": {
                                "color": "#FF00FF", // Magenta color
                                "label": "Purok 5"
                            },
                            "geometry": {
                                "type": "Polygon",
                                "coordinates": [
                                    // Coordinates for Purok 5
                                    [
                                        [123.7179658843188, 13.14155894653338, 0],
                                        [123.7208826171201, 13.1401970173047, 0],
                                        [123.7228499255377, 13.14270794528, 0],
                                        [123.7211169363518, 13.1427962709659, 0],
                                        [123.719599955497, 13.14257809322848, 0],
                                        [123.7179658843188, 13.14155894653338, 0]
                                    ]
                                ]
                            }
                        },
                        {
                            "type": "Feature",
                            "properties": {
                                "color": "#008000", // Green color
                                "label": "Purok 6"
                            },
                            "geometry": {
                                "type": "Polygon",
                                "coordinates": [
                                    // Coordinates for Purok 6
                                    [
                                        [123.7150676951202, 13.14441296637264, 0],
                                        [123.7158490010651, 13.1446902210451, 0],
                                        [123.7162156136015, 13.14476565740763, 0],
                                        [123.7166515064527, 13.14307614672862, 0],
                                        [123.7167418750158, 13.14306998757365, 0],
                                        [123.7168067802786, 13.1428215694416, 0],
                                        [123.7169388664114, 13.1426693081532, 0],
                                        [123.7169966393262, 13.14242251194652, 0],
                                        [123.7177301963296, 13.14254286931246, 0],
                                        [123.7179213196073, 13.14229971264284, 0],
                                        [123.7179592740861, 13.14157513387572, 0],
                                        [123.7195815641706, 13.14261664589323, 0],
                                        [123.7192166351156, 13.14313575567921, 0],
                                        [123.7187390824954, 13.14347960406133, 0],
                                        [123.7182294181209, 13.1439691111114, 0],
                                        [123.7178595620684, 13.14464370444761, 0],
                                        [123.7173648932756, 13.14470386024472, 0],
                                        [123.7167314893085, 13.14574472160461, 0],
                                        [123.7164523718356, 13.14558585083147, 0],
                                        [123.7163440703565, 13.14572552548256, 0],
                                        [123.7161989510323, 13.14598465910532, 0],
                                        [123.7156110419764, 13.14575307942603, 0],
                                        [123.7154990452096, 13.14607860000216, 0],
                                        [123.7149673035632, 13.14589902940353, 0],
                                        [123.7148986827341, 13.14584831155335, 0],
                                        [123.7145734884644, 13.14571113046981, 0],
                                        [123.7150676951202, 13.14441296637264, 0]
                                    ]
                                ]
                            }
                        }
                    ]
                };

                L.geoJSON(bagumbayanBoundary, {
                    style: function(feature) {
                        return {
                            fillColor: feature.properties.color,
                            color: feature.properties.color, // border color
                            weight: 1, // border width
                            fillOpacity: 0.3 // fill opacity
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(feature.properties.label); // Display label in a popup
                    }
                }).addTo(map);

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
                    updateCoordinates(event.target.getLatLng().lat, event.target.getLatLng().lng);
                });
                const imageUpload = document.getElementById('imageUpload');
                let upload = document.getElementById("upl");
                upload.addEventListener("click", function() {
                    imageUpload.click();

                })


                const previewImage = document.getElementById('previewImage');

                // Display the saved image when updating
                const savedImage = '<?php echo isset($_GET["id"]) ? 'residents_img/' . $pro : ''; ?>';

                // Set the preview image source
                if (savedImage) {
                    previewImage.src = savedImage;
                } else {
                    previewImage.src = 'residents_img/pp.png';
                }

                </script>
  
    </div>
</form>
<style>
 #map{
            width:100%;
            height:60vh;
            box-shadow:0px 0px 2px gray;
        }
      
       #resident_form{
        margin:0 auto;
            padding:20px;
             width:80vw;
            height:auto;
          
            background-color:white; 
          
          
           
        }
        
        #resident_form >  table{
            margin:0 auto;
           
            width:100%;
         
        }
      
        label ~input, label ~select{
            width:98%;
            padding:5px;
            border:none;
            box-shadow:0px 0px 2px gray;
            border-radius:1px;
        }
        th{
            position:relative;
        }
        th>img{
            width:98%;  
            height:120%;
            padding:5px; 
            position:absolute;
            top:0;
            left:0;
           
        }
        th >button{
            font-weight:bold;
            color:white;
            width:98%;
            padding:10px;
           border:none;
           border-radius:5px;
           background-color:rgb(102,105,211);
            box-shadow:0px 0px 2px gray;
            cursor: pointer;
            display:none;
        }
        .aa{
            padding:10px 20px;
            border:none;
            color:white;
            float:right;
            margin:1%;
            border-radius:5px;
        }
        .cancel{
            background-color:rgb(107,178,243);
            display:none;
        }
        .save{
            background-color:rgb(102,105,211);
            display:none;
        }
        .row{
         
            overflow-x:hidden;
        }
    </style>
</div>
                </section>
            </div>
        </div>
    </div>
    <script>
        // Get all input and select elements
        var inputs = document.querySelectorAll('input');
        var selects = document.querySelectorAll('select');

        // Set the readonly attribute for each input element
        inputs.forEach(function(input) {
            input.setAttribute('readonly', true);
        });

        // Set the readonly attribute for each select element
        selects.forEach(function(select) {
            select.setAttribute('disabled', true);
        });
    </script>
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
    </script>
    <?php include "partials/scripts.php"?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
