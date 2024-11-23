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
                                            <input type="text" value="<?php if(isset($_GET["id"])){
                                                echo $brgy;
                                            }?>"  name="brgy">
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
                        #map {
                            width: 100%;
                            height: 60vh;
                            box-shadow: 0px 0px 2px gray;
                        }

                        #resident_form {
                            margin: 0 auto;
                            padding: 20px;
                            width: 80vw;
                            height: auto;

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
    </script>
    <?php include "partials/scripts.php"?>
</body>

</html>