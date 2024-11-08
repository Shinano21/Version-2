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
                            <img src="src/pp.png" id="previewImage">
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
                            <label>Barangay</label>
                            <br>
                            <input type="text" value="Bagumbayan" readonly name="brgy">
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <label>City Municipality</label>
                            <br>
                            <input type="text" value="Daraga" name="city" readonly>
                        </th>
                        <th>
                            <label>Province</label>
                            <br>
                            <input type="text" value="Albay" name="province" readonly>
                        </th>
                        <th>
                            <label>Zip code</label>
                            <br>
                            <input type="text" value="4501" name="zipcode" readonly>
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
                        <th>
                            <label>Covid-19 Vaccination Status</label>
                            <br>
                            <select name="covid" required>
                                <option value="Fully Vaccinated">Fully Vaccinated</option>
                                <option value="First Dose Vaccinated">First Dose Vaccinated</option>
                                <option value="Unvaccinated">Unvaccinated</option>
                                <option value="Not Applicable">Not Applicable</option>
                            </select>
                        </th>
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
                const map = L.map('map').setView([13.142307, 123.71827], 16); // Set the initial view and zoom level
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(
                    map); // Add a basemap (OpenStreetMap)

                // Create a marker with a draggable option
                const marker = L.marker([13.142307, 123.71827], {
                    draggable: true
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
                    } else {
                        previewImage.src = 'residents_img/pp.png';
                    }
                });
                </script>

        </div>
    </form>
    <style>
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
    </script>

    <?php include "partials/scripts.php"; ?>

</body>

</html>