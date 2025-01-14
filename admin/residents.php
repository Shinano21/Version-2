<?php
session_start();

include "dbcon.php";

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Function to generate a unique ID card number
function generateUniqueID($conn) {
    do {
        // Generate a random 8-digit number prefixed with "ID-"
        $random_id_card_no =  mt_rand(10000000, 99999999);

        // Check if this ID already exists in the database
        $query = "SELECT COUNT(*) as count FROM residents WHERE id_card_no = '$random_id_card_no'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
    } while ($row['count'] > 0); // Repeat if the ID is already in use

    return $random_id_card_no;
}

// Generate the unique ID card number
$random_id_card_no = generateUniqueID($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Resident Records | TechCare</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/tables.css">
</head>

<body onload="display_ct();">

    <?php
    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "System Administrator") {
        include "partials/admin_sidebar.php";
    } else {
        include "partials/sidebar.php";
    }
    ?>
    <!-- /# sidebar -->
    <?php include "partials/header.php"?>

    <form enctype="multipart/form-data" method="post" action="add_resident.php">
        <div id="resident_form">
            <h4>RESIDENT FORM</h2>
                <span id="exitas">&#x2715;</span>
                <table>
                    <tr>
                        <th rowspan="3">
                            <img src="src/user.png" id="previewImage">
                            <input type="file" id="imageUpload" name="image" accept="image/*" style="display:none;">
                        </th>
                        <th>
                            <label>Firstname</label>
                            <br>
                            <input type="text" name="fname" required>
                        </th>
                        <th>
                            <label>Middlename</label>
                            <br>
                            <input type="text" name="mname">
                        </th>
                        <th>
                            <label>Lastname</label>
                            <br>
                            <input type="text" name="lname" required>
                        </th>
                    </tr>
                    <tr>
                        <!--<th></th>-->
                        <th>
                            <label>Suffix</label>
                            <br>
                            <input type="text" name="suffix">
                        </th>
                        <th>
                            <label>Sex</label>
                            <br>
                            <select name="sex" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </th>
                        <th>
                            <label>Date of Birth</label>
                            <br>
                            <input type="date" name="date" required>
                        </th>
                    </tr>
                    <tr>
                        <!--<th></th>-->
                        <th>
                            <label>Place of Birth</label>
                            <br>
                            <input type="text" name="bday" required>
                        </th>
                        <th>
                            <label>Religion</label>
                            <br>
                            <input type="text" name="religion">
                        </th>
                        <th>
                            <label>Citizenship</label>
                            <br>
                            <input type="text" name="citizenship" required>
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
                            <label>Street name</label>
                            <br>
                            <input type="text" name="street">
                        </th>
                        <th>
                            <label>Zone</label>
                            <br>
                            <select id="purokSelect" name="zone" required>
                                <option value="Purok 1">Purok 1</option>
                                <option value="Purok 2">Purok 2</option>
                                <option value="Purok 3">Purok 3</option>
                                <option value="Purok 4">Purok 4</option>
                                <option value="Purok 5">Purok 5</option>
                                <option value="Purok 6">Purok 6</option>
                            </select>
                        </th>
                        <th>
                        <label for="brgy">Barangay</label><br>
<input type="text" id="brgySearch" placeholder="Search Barangay" onkeyup="filterBarangay()">
<br>
<select id="brgy" name="brgy" size="10" onchange="selectBarangay()">
<option value="Bgy. 1 Em's Barrio">Bgy. 1 Em's Barrio</option>
    <option value="Bgy. 2 Em's Barrio South">Bgy. 2 Em's Barrio South</option>
    <option value="Bgy. 3 Em's Barrio East">Bgy. 3 Em's Barrio East</option>
    <option value="Bgy. 4 Sagpon Pob.">Bgy. 4 Sagpon Pob.</option>
    <option value="Bgy. 5 Sagmin Pob.">Bgy. 5 Sagmin Pob.</option>
    <option value="Bgy. 6 Bañadero Pob.">Bgy. 6 Bañadero Pob.</option>
    <option value="Bgy. 7 Baño">Bgy. 7 Baño</option>
    <option value="Bgy. 8 Bagumbayan">Bgy. 8 Bagumbayan</option>
    <option value="Bgy. 9 Pinaric">Bgy. 9 Pinaric</option>
    <option value="Bgy. 10 Cabugao">Bgy. 10 Cabugao</option>
    <option value="Bgy. 11 Maoyod Pob.">Bgy. 11 Maoyod Pob.</option>
    <option value="Bgy. 12 Tula-tula">Bgy. 12 Tula-tula</option>
    <option value="Bgy. 13 Ilawod West Pob.">Bgy. 13 Ilawod West Pob.</option>
    <option value="Bgy. 14 Ilawod Pob.">Bgy. 14 Ilawod Pob.</option>
    <option value="Bgy. 15 Ilawod East Pob.">Bgy. 15 Ilawod East Pob.</option>
    <option value="Bgy. 16 Kawit-East Washington Drive">Bgy. 16 Kawit-East Washington Drive</option>
    <option value="Bgy. 17 Rizal Street., Ilawod">Bgy. 17 Rizal Street., Ilawod</option>
    <option value="Bgy. 18 Cabagñan West">Bgy. 18 Cabagñan West</option>
    <option value="Bgy. 19 Cabagñan">Bgy. 19 Cabagñan</option>
    <option value="Bgy. 20 Cabagñan East">Bgy. 20 Cabagñan East</option>
    <option value="Bgy. 21 Binanuahan West">Bgy. 21 Binanuahan West</option>
    <option value="Bgy. 22 Binanuahan East">Bgy. 22 Binanuahan East</option>
    <option value="Bgy. 23 Imperial Court Subd.">Bgy. 23 Imperial Court Subd.</option>
    <option value="Bgy. 24 Rizal Street">Bgy. 24 Rizal Street</option>
    <option value="Bgy. 25 Lapu-lapu">Bgy. 25 Lapu-lapu</option>
    <option value="Bgy. 26 Dinagaan">Bgy. 26 Dinagaan</option>
    <option value="Bgy. 27 Victory Village South">Bgy. 27 Victory Village South</option>
    <option value="Bgy. 28 Victory Village North">Bgy. 28 Victory Village North</option>
    <option value="Bgy. 29 Sabang">Bgy. 29 Sabang</option>
    <option value="Bgy. 30 Pigcale">Bgy. 30 Pigcale</option>
    <option value="Bgy. 31 Centro-Baybay">Bgy. 31 Centro-Baybay</option>
    <option value="Bgy. 32 San Roque">Bgy. 32 San Roque</option>
    <option value="Bgy. 33 PNR-Peñaranda St.-Iraya">Bgy. 33 PNR-Peñaranda St.-Iraya</option>
    <option value="Bgy. 34 Oro Site-Magallanes St.">Bgy. 34 Oro Site-Magallanes St.</option>
    <option value="Bgy. 35 Tinago">Bgy. 35 Tinago</option>
    <option value="Bgy. 36 Kapantawan">Bgy. 36 Kapantawan</option>
    <option value="Bgy. 37 Bitano">Bgy. 37 Bitano</option>
    <option value="Bgy. 38 Gogon">Bgy. 38 Gogon</option>
    <option value="Bgy. 39 Bonot">Bgy. 39 Bonot</option>
    <option value="Bgy. 40 Cruzada">Bgy. 40 Cruzada</option>
    <option value="Bgy. 41 Bogtong">Bgy. 41 Bogtong</option>
    <option value="Bgy. 42 Rawis">Bgy. 42 Rawis</option>
    <option value="Bgy. 43 Tamaoyan">Bgy. 43 Tamaoyan</option>
    <option value="Bgy. 44 Pawa">Bgy. 44 Pawa</option>
    <option value="Bgy. 45 Dita">Bgy. 45 Dita</option>
    <option value="Bgy. 46 San Joaquin">Bgy. 46 San Joaquin</option>
    <option value="Bgy. 47 Arimbay">Bgy. 47 Arimbay</option>
    <option value="Bgy. 48 Bagong Abre">Bgy. 48 Bagong Abre</option>
    <option value="Bgy. 49 Bigaa">Bgy. 49 Bigaa</option>
    <option value="Bgy. 50 Padang">Bgy. 50 Padang</option>
    <option value="Bgy. 51 Buyuan">Bgy. 51 Buyuan</option>
    <option value="Bgy. 52 Matanag">Bgy. 52 Matanag</option>
    <option value="Bgy. 53 Bonga">Bgy. 53 Bonga</option>
    <option value="Bgy. 54 Mabinit">Bgy. 54 Mabinit</option>
    <option value="Bgy. 55 Estanza">Bgy. 55 Estanza</option>
    <option value="Bgy. 56 Taysan">Bgy. 56 Taysan</option>
    <option value="Bgy. 57 Dap-dap">Bgy. 57 Dap-dap</option>
    <option value="Bgy. 58 Buragwis">Bgy. 58 Buragwis</option>
    <option value="Bgy. 59 Puro">Bgy. 59 Puro</option>
    <option value="Bgy. 60 Lamba">Bgy. 60 Lamba</option>
    <option value="Bgy. 61 Maslog">Bgy. 61 Maslog</option>
    <option value="Bgy. 62 Homapon">Bgy. 62 Homapon</option>
    <option value="Bgy. 63 Mariawa">Bgy. 63 Mariawa</option>
    <option value="Bgy. 64 Bagacay">Bgy. 64 Bagacay</option>
    <option value="Bgy. 65 Imalnod">Bgy. 65 Imalnod</option>
    <option value="Bgy. 66 Banquerohan">Bgy. 66 Banquerohan</option>
    <option value="Bgy. 67 Bariis">Bgy. 67 Bariis</option>
    <option value="Bgy. 68 San Francisco">Bgy. 68 San Francisco</option>
    <option value="Bgy. 69 Buenavista">Bgy. 69 Buenavista</option>
    <option value="Bgy. 70 Cagbacong">Bgy. 70 Cagbacong</option>
</select>


                        </th>
                    </tr>
                    <tr>
                        <th>
                            <label>City Municipality</label>
                            <br>
                            <input type="text" value="Legazpi" name="city" readonly>
                        </th>
                        <th>
                            <label>Province</label>
                            <br>
                            <input type="text" value="Albay" name="province" readonly>
                        </th>
                        <th>
                            <label>Zip code</label>
                            <br>
                            <input type="text" value="4500" name="zipcode" readonly>
                        </th>
                        <th>
                            <label>Contact Number</label>
                            <br>
                            <input type="text" name="contact">
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <label>Educational Level</label>
                            <br>
                            <select name="educational" required>
                                <option value="Preschool">Preschool</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Elementary Graduate">Elementary Graduate</option>
                                <option value="Junior High School">Junior High School</option>
                                <option value="Junior High School Graduate">Junior High School Graduate</option>
                                <option value="Senior High School">Senior High School</option>
                                <option value="Senior High School Graduate">Senior High School Graduate</option>
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
                            <input type="text" name="occupation">
                        </th>
                        <th>
                            <label>Civil Status</label>
                            <br>
                            <select id="civilStatus" name="civilStatus" required>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Separated">Separated</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </th>
                        <th>
                            <label>Labor force status</label>
                            <br>
                            <select name="labor" required>
                                <option value="Employed">Employed</option>
                                <option value="Unemployed">Unemployed</option>
                                <option value="Not in the Labor Force">Not in the Labor Force</option>
                                <option value="Not Applicable">Not Applicable</option>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <label>Voter status</label>
                            <br>
                            <select name="voter" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="Not Applicable">Not Applicable</option>
                            </select>
                        </th>
                        <th>
                            <label>PWD status</label>
                            <br>
                            <select name="pwd" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </th>
                        <th>
                            <label>4P's Beneficiary</label>
                            <br>
                            <select name="forp" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </th>
                        <!-- <th>
                            <label>Covid-19 Vaccination Status</label>
                            <br>
                            <select name="covid" required>
                                <option value="Fully Vaccinated">Fully Vaccinated</option>
                                <option value="First Dose Vaccinated">First Dose Vaccinated</option>
                                <option value="Unvaccinated">Unvaccinated</option>
                                <option value="Not Applicable">Not Applicable</option>
                            </select>
                        </th> -->
                    </tr>
                    <tr>
                        <th>
                            <label>Status</label>
                            <br>
                            <select name="Status" required>
                                <option value="Active">Active</option>
                                <option value="Dead">Dead</option>
                            </select>
                        </th>
                        <th>
                            <label>Longitude</label>
                            <br>
                            <input type="text" name="longitude" id="logi" required>
                        </th>
                        <th>
                            <label>Latitude</label>
                            <br>
                            <input type="text" name="Latitude" id="lati" required>
                        </th>
                        <th>
                            <label>ID Card Number</label>
                            <br>
                            <input type="text" name="id_card_no" id="id_card_no" placeholder="<?php echo $random_id_card_no; ?>" value="<?php echo $random_id_card_no; ?>" required>
                        </th>
                    </tr>
                </table>
                <br>
                <div id="map" style="height: 400px; width: 100%;"></div>
                <br>
                <button class="aa save" type="submit"> SAVE</button>
                <button class="aa cancel" id="cancel1"> CANCEL</button>

                <!--<p id="coordinates">Coordinates: 13.142307, 123.71827</p>-->

                <script>
                const map = L.map('map').setView([13.142307, 123.71827], 12); // Set the initial view and zoom level
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(
                    map); // Add a basemap (OpenStreetMap)

                // Create a marker with a draggable option
                const marker = L.marker([13.136723639200417, 123.73407425235287], {
                    draggable: true
                }).addTo(map);

                // Add the fullscreen control
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
                    updateCoordinates(event.target.getLatLng().lat, event.target.getLatLng().lng);
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
                    previewImage.src = 'residents_img/user.png';
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
                    } else {
                        previewImage.src = 'residents_img/user.png';
                    }
                });
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
    .label-icon {
        text-align: center;
        font-size: 12px;
    }
    .label-text {
        color: black;
    }
    #resident_form {
        padding: 20px;
        width: 95vw;
        height: auto;
        box-shadow: 0px 0px 200px gray;
        background-color: white;
        position: absolute;
        z-index: 1000;
        margin: 0 2%;
        display: none;
    }
    #exitas {
        position: absolute;
        right: 0;
        top: 0;
        cursor: pointer;
        color: white;
        padding: 5px 8px;
        margin: 1%;
        background-color: gray;

    }
    #resident_form>table {
        width: 100%;
        margin: 0 auto;
        box-shadow: 0px 0px 2px gray;
    }
    label~input,
    label~select {
        width: 98%;
        padding: 5px;
        border: none;
        box-shadow: 0px 0px 4px gray;
        border-radius: 5px;
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
    </style>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                        <h1>Resident Records</h1>
                    </div>
                    <div class="bc-page">
                        <ol class="bc">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Resident Records</li>
                        </ol>
                    </div>          
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <div class="filters">
                            <div class="monthFilter">
                                <span for="monthSelect">Filter by Month:</span>
                                <select id="monthSelect" class="monthSelect">
                                    <option value="13" selected>All Months</option>
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        $monthName = date("F", mktime(0, 0, 0, $month, 1)); // Get the month name
                                        echo "<option value='$month'>$monthName</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="yearFilter">
                                <span for="yearSelect">Year:</span>
                                <select id="yearSelect" class="yearSelect">
                                    <?php
                                    $currentYear = date('Y');
                                    for ($year = $currentYear; $year >= 1500; $year--) {
                                        echo "<option value='$year'>$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="buttons">
                            <button
                                class="addBtn"
                                id="add_res"><span class="fa fa-plus"></span>&nbsp;&nbsp;Resident</button>
                            <a href="template/residents.php" target="_blank"><button
                                class="printBtn"><span
                                    class="fa fa-print">&nbsp;&nbsp;</span>Print Records</button></a>
                        </div>
                        <div class="tab">
                            <div class="showSearch">
                                <div class="showEntries">
                                    <p>Show
                                    <input type="number" class="numberInput"></input>
                                    entries</p>
                                </div>

                                <div class="searchTable">
                                    <p>Search
                                    <input type="text" id="searchInput" class="searchBar" placeholder="Enter keyword"></p>
                                </div>
                            </div>

                            <table id="residentTable" class="tableResidents">
                                <thead class="head">
                                <tr>
                                    <th class="names" style="padding-left: 10px;">Full Name</th>
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th>Birthday</th>
                                    <th>Zone</th>
                                    <th>Contact number</th>
                                    <th class="lastCol">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php include "data/showResidents.php";?>
                                </tbody>   
                            </table>
                            <div class="showPages">
                                <p>Showing 1 to 2 of 2 entries</p>
                                <div class="page-indicator">
                                    <span id="prev" class="indicator previous">Previous</span>
                                    <span class="num">1</span>
                                    <span id="next" class="indicator next">Next</span>
                                </div>
                            </div>
                        </div>
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

        let xe = document.getElementById("exitas");
        xe.addEventListener("click", function() {
            // alert("hello")
            let k = document.getElementById("resident_form").style.display = "none";
        })
        let xe2 = document.getElementById("cancel1");
        xe2.addEventListener("click", function() {
            // alert("hello")
            let k = document.getElementById("resident_form").style.display = "none";
        })
        let xes = document.getElementById("add_res");
        xes.addEventListener("click", function() {

            let k = document.getElementById("resident_form").style.display = "block";
        })
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const entriesDropdown = document.querySelector('.numberInput');
            const searchInput = document.getElementById('searchInput');
            const residentTable = document.getElementById('residentTable');
            const pageIndicator = document.querySelector('.page-indicator');
            const yearSelect = document.getElementById('yearSelect');
            const monthSelect = document.getElementById('monthSelect'); // Add monthSelect

            let currentPage = 1;
            let entriesPerPage = 15;
            let originalData = []; // Store the original data for resetting

            // Set entriesPerPage to a high number initially to load all data
            entriesDropdown.value = entriesPerPage;

            // Event listener for changing the number of entries displayed
            entriesDropdown.addEventListener('change', function () {
                entriesPerPage = parseInt(this.value, 10);
                this.value = entriesPerPage;
                currentPage = 1;
                updateTable();
            });

            // Event listener for adjusting the number in "Show entries" input field
            entriesDropdown.addEventListener('input', function () {
                entriesPerPage = parseInt(this.value, 10);
                this.value = entriesPerPage;
                currentPage = 1;
                updateTable();
            });

            // Event listener for search input
            searchInput.addEventListener('input', function () {
                currentPage = 1;
                updateTable();
            });

            // Event listener for yearSelect
            yearSelect.addEventListener('change', function () {
                currentPage = 1;
                updateTable();
            });

            // Event listener for monthSelect
            monthSelect.addEventListener('change', function () {
                currentPage = 1;
                updateTable();
            });

            // Event listener for pagination (Next)
            document.getElementById('next').addEventListener('click', function () {
                if (currentPage < totalPages()) {
                    currentPage++;
                    updateTable();
                }
            });

            // Event listener for pagination (Previous)
            document.getElementById('prev').addEventListener('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                }
            });

            // Function to update the table based on user input
            function updateTable() {
                let filteredData = filterData();
                let totalEntries = filteredData.length;
                let totalPagesCount = totalPages();

                // Update page indicator
                pageIndicator.querySelector('.num').textContent = currentPage;

                // Enable/disable pagination buttons
                document.getElementById('prev').disabled = currentPage === 1;
                document.getElementById('next').disabled = currentPage === totalPagesCount;

                // Calculate the start and end index for the current page
                let startIndex = (currentPage - 1) * entriesPerPage;
                let endIndex = Math.min(startIndex + entriesPerPage, totalEntries);

                // Display the relevant rows in the table
                let tableBody = residentTable.querySelector('tbody');
                tableBody.innerHTML = '';
                for (let i = startIndex; i < endIndex; i++) {
                    tableBody.appendChild(filteredData[i]);
                }

                // Update "Showing X to Y of Z entries" text
                let showingText = `Showing ${startIndex + 1} to ${endIndex} of ${totalEntries} entries`;
                document.querySelector('.showPages p').textContent = showingText;
            }

            // Function to filter the data based on search input and year/month
            function filterData() {
                let rows = originalData.slice();
                let searchTerm = searchInput.value.trim().toLowerCase();
                let selectedYear = yearSelect.value;
                let selectedMonth = monthSelect.value;

                rows = rows.filter(row => {
                    let rowData = Array.from(row.children).map(cell => cell.textContent.trim().toLowerCase());
                    let birthDate = rowData[3]; // Assuming the "Birthday" column is the 4th column (index 3)
                    let [birthYear, birthMonth] = birthDate.split('-').map(num => parseInt(num, 10));

                    // Check if the birth year is before the selected year or
                    // if the birth year is the selected year and the birth month is before the selected month
                    return (
                        rowData.some(data => data.includes(searchTerm)) &&
                        (birthYear < parseInt(selectedYear, 10) || (birthYear === parseInt(selectedYear, 10) && birthMonth <= parseInt(selectedMonth, 10)))
                    );
                });

                return rows;
            }

            // Function to calculate total pages
            function totalPages() {
                let filteredData = filterData();
                let totalEntries = filteredData.length;
                return Math.ceil(totalEntries / entriesPerPage);
            }

            // Initial table update
            originalData = Array.from(residentTable.querySelectorAll('tbody tr'));
            updateTable();
        });
    </script>

    <script>
        // Function to handle printing with selected month and year
        function printResidents() {
            let selectedMonth = monthSelect.value;
            let selectedYear = yearSelect.value;
            // Construct the URL for residents.php with selected month and year
            let printURL = `template/residents.php?month=${selectedMonth}&year=${selectedYear}`;

            // Open a new window/tab for printing
            window.open(printURL, '_blank');
            }
        // Event listener for the print button
        document.querySelector('.printBtn').addEventListener('click', printResidents);

          // Function to filter barangays based on input
    function filterBarangay() {
        const searchInput = document.getElementById('brgySearch').value.toLowerCase();
        const select = document.getElementById('brgy');
        const options = select.options;

        for (let i = 0; i < options.length; i++) {
            const optionText = options[i].text.toLowerCase();
            options[i].style.display = optionText.includes(searchInput) ? '' : 'none';
        }
    }

    // Function to set selected barangay in the input box
    function selectBarangay() {
        const select = document.getElementById('brgy');
        const input = document.getElementById('brgySearch');
        input.value = select.options[select.selectedIndex].text;
    }
    </script>

    <?php include "partials/scripts.php"; ?>

</body>

</html>