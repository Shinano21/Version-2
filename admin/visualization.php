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
    <title>Visualization | CareVisio</title>
    <?php include "partials/head.php"; ?>
</head>

<body onload="display_ct();">

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
                                <h1>Data Visualization</h1>
                                <h7></h7>

                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Data Visualization</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5>Demographic Map</h5>
                                <br>
                                <select name="group" id="groupSelect" class="form-select"
                                    style="border: solid 2px rgba(0,0,0,0.5); font-size: 1rem; border-radius:5px; padding: 7px; margin: 0 0 15px;">
                                    <option value="" selected>Select Filter</option>
                                    <optgroup label="Filter By Age">
                                        <option value="inf">0-11 Months</option>
                                        <option value="tod">1-5</option>
                                        <option value="kids">6-12</option>
                                        <option value="teen">13-19</option>
                                        <option value="twenty">20-29</option>
                                        <option value="thirty">30-39</option>
                                        <option value="forty">40-49</option>
                                        <option value="fifty">50-59</option>
                                        <option value="sixty">60-69</option>
                                        <option value="seventy">70-79</option>
                                        <option value="oldies">80+</option>
                                    </optgroup>
                                    <optgroup label="Filter By Sex">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="both">Both</option>
                                    </optgroup>
                                    <optgroup label="Filter By Purok">
                                        <option value="Purok 1">Purok 1</option>
                                        <option value="Purok 2">Purok 2</option>
                                        <option value="Purok 3">Purok 3</option>
                                        <option value="Purok 4">Purok 4</option>
                                        <option value="Purok 5">Purok 5</option>
                                        <option value="Purok 6">Purok 6</option>
                                        <option value="All">All Purok</option>
                                    </optgroup>
                                </select>
                                <div id="map" style="height: 500px; width: 100%;"></div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="panel-title" id="pieTitle">
                                        <h4
                                            style="margin:0; width:100%; background-color: #5C54F3; font-size: 1rem; color:white; padding: 7px; border-radius: 10px;">
                                        </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div>
                                        <select name="group" id="pieSelect" class="form-select"
                                            style="border: solid 2px rgba(0,0,0,0.5); font-size: 1rem; border-radius:5px; padding: 7px; margin: 0 0 20px;">
                                            <optgroup label="Filter By">
                                                <option value="age group" selected>Age Group</option>
                                                <option value="sex">Sex</option>
                                                <option value="zone">Purok</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="panel-title" id="donutTitle">
                                        <h4></h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div>
                                        <select name="group" id="donutSelect" class="form-select"
                                            style="border: solid 2px rgba(0,0,0,0.5); font-size: 1rem; border-radius:5px; padding: 7px; margin: 0 0 15px;">
                                            <optgroup label="Filter By">
                                            <optgroup label="PWD">
                                                <option value="zone" selected>By Purok</option>
                                                <option value="sex">By Sex</option>
                                            </optgroup>
                                            </optgroup>
                                            <optgroup label="4Ps Beneficiary">
                                                <option value="zone">By Purok</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <canvas id="doughnutChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="panel-title">
                                        <h4>Educational Attainment Chart</h4>
                                    </div>
                                </div>
                                <div class="panel-body" style="height: 400px;">
                                    <canvas id="singleBarChart" style="height: 100%; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="panel-title" id="dbarTitle">
                                        <h4>Interactive Bar Chart</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <select name="group" id="barSelect" class="form-select"
                                        style="border: solid 2px rgba(0,0,0,0.5); font-size: 1rem; border-radius:5px; padding: 7px; margin: 0 0 15px;">
                                        <optgroup label="Filter By">
                                        <optgroup label="Civil Status" data-value="civil_status">
                                            <option value="civil_status" selected>Civil Status</option>
                                            <option value="sex">Civil Status and Sex</option>
                                            <option value="zone">Civil Status and Purok</option>
                                        </optgroup>
                                        </optgroup>
                                        <optgroup label="Age Group" data-value="bday">
                                            <option value="bday">Age Group</option>
                                            <option value="sex">Age Group and Sex</option>
                                            <option value="zone">Age Group and Purok</option>
                                        </optgroup>
                                        <optgroup label="Labor Force Status" data-value="labor_status">
                                            <option value="labor_status">Labor Status</option>
                                            <option value="sex">Labor Status and Sex</option>
                                            <option value="zone">Labor Status and Purok</option>
                                        </optgroup>
                                        <optgroup label="Voter Status" data-value="voter_status">
                                            <option value="voter_status">Voter Status</option>
                                            <option value="zone">Voter Status and Purok</option>
                                        </optgroup>
                                        <optgroup label="COVID-19 Vaccine Status" data-value="vac_status">
                                            <option value="vac_status">Vaccine Status</option>
                                            <option value="zone">Vaccine Status and Purok</option>
                                        </optgroup>
                                    </select>
                                    <canvas id="barChart"></canvas>
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
    </script>
    <script type="module" src="map.js"></script>

    <!-- jquery vendor -->
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="js/lib/chart-js/bar-chart.js"></script>
    <script src="js/lib/chart-js/pie-chart.js"></script>
    <script src="js/lib/chart-js/donut-chart.js"></script>
    <script src="js/lib/chart-js/dbar-chart.js"></script>
    <script src="js/lib/bootstrap.min.js"></script>
    <!-- scripit init-->
</body>

</html>