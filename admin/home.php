<?php

session_start();

include "dbcon.php";
if(!isset($_SESSION["user"])){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard | TechCare</title>
    <?php include "partials/head.php"; ?>
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


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>DASHBOARD</h1>
                                <span>Welcome back, <?php echo $_SESSION["firstname"] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Home</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row" id="main-data">

                        <a href="#" class="asddasd a1">
                            <div class="dash3">
                                <div class="dvi">
                                    <h6>Population</h6>
                                    <?php
                                    $sql = "SELECT COUNT(*) as `total` FROM `residents` WHERE `status` = 'active'";

                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $totalResidents = $row['total'];
                                        echo "<h3>". $totalResidents."</h3>";
                                    } else {
                                        echo "Cannot read numbers of population";
                                    }
                                ?>
                                </div>

                                <div class="dvi dasd"><img src="src/a1.png">
                                    <br>
                                    <h7><b>Total Population</b></h7>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="asddasd a2">
                            <div class="dash3">
                                <div class="dvi">
                                    <h6>Female</h6>
                                    <?php
                                $sql = "SELECT COUNT(*) as total_female FROM residents WHERE sex = 'Female' AND `status` = 'active'";

                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    $totalfeMaleResidents = $row['total_female'];
                                    echo " <h3>".$totalfeMaleResidents ."</h3>";
                                } else {
                                    echo "Error: Cannot read total male " ;
                                }
                            ?>
                                </div>

                                <div class="dvi dasd"><img src="src/a2.png">
                                    <br>
                                    <h7><b>Total Female</b></h7>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="asddasd a3">
                            <div class="dash3">
                                <div class="dvi">
                                    <h6>Male</h6>
                                    <?php
                            $sql = "SELECT COUNT(*) as total_male FROM residents WHERE sex = 'Male' AND `status` = 'active'";

                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $totalMaleResidents = $row['total_male'];
                                echo " <h3>".$totalMaleResidents ."</h3>";
                            } else {
                                echo "Error: Cannot read total male " ;
                            }
                        ?>
                                </div>

                                <div class="dvi dasd"><img src="src/a3.png">
                                    <br>
                                    <h7><b>Total Male</b></h7>
                                </div>
                            </div>
                        </a>


                        <a href="#" class="asddasd a4">
                            <div class="dash3">
                                <div class="dvi">
                                    <h6>Infants</h6>
                                    <?php
                            $sql = "SELECT COUNT(*) as total_infants FROM residents WHERE DATEDIFF(NOW(), bday) <= 365 AND `status` = 'active'";

                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $totalInfants = $row['total_infants'];
                                echo " <h3>".$totalInfants ."</h3>";
                            } else {
                                echo "Error: Cannot read total infants " ;
                            }
                        ?>
                                </div>

                                <div class="dvi dasd"><img src="src/a4.png">
                                    <br>
                                    <h7><b>Total Infants</b></h7>
                                </div>
                            </div>
                        </a>


                        <a href="#" class="asddasd a5">
                            <div class="dash3">
                                <div class="dvi">
                                    <h6>Children (1-4 yrs)</h6>
                                    <?php
                                        $sql = "SELECT COUNT(*) AS total_children FROM residents 
                                        WHERE DATEDIFF(NOW(), bday) >= 365 AND DATEDIFF(NOW(), bday) <= 1460 AND `status` = 'active'";
                                        

                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            $totalChildren = $row['total_children'];
                                            echo " <h3>".$totalChildren ."</h3>";
                                        } else {
                                            echo "Error: Cannot read total children " ;
                                        }
                                    ?>
                                </div>

                                <div class="dvi dasd"><img src="src/a5.png">
                                    <br>
                                    <h7><b>Total Children </b></h7>
                                </div>
                            </div>
                        </a>


                        <a href="#" class="asddasd a6">
                            <div class="dash3">
                                <div class="dvi">
                                    <h6>Senior Citizens</h6>
                                    <?php
                $sql = "SELECT COUNT(*) as total_senior FROM residents 
                WHERE DATEDIFF(NOW(), bday) > 21900 AND `status` = 'active'";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $totalSenior = $row['total_senior'];
                    echo " <h3>".$totalSenior ."</h3>";
                } else {
                    echo "Error: Cannot read total seniors " ;
                }
            ?>
                                </div>

                                <div class="dvi dasd"><img src="src/a6.png">
                                    <br>
                                    <h7><b>Total Senior Citizens</b></h7>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="row">
                        <div class="tab">
                            Population per Purok
                            <br>
                            <br>
                            <table>
                                <tr>
                                    <th>
                                        <h6>Purok</h6>
                                    </th>
                                    <th>
                                        <h6>Total Population</h6>
                                    </th>
                                </tr>
                                <?php include("partials/show_purok.php") ?>
                            </table>
                        </div>

                        <div class="tab">
                            Number of records
                            <br>
                            <br>
                            <table>
                                <tr>
                                    <th>
                                        <h6>Records</h6>
                                    </th>
                                    <th>
                                        <h6>Total </h6>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Residents</th>
                                    <th>
                                    <?php
                                        $sql = "SELECT COUNT(*) as total_records FROM residents";

                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            $totalRecords = $row['total_records'];
                                            echo $totalRecords;
                                        } else {
                                            echo "Error: Cannot read total records." ;
                                        }
                                    ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Immunization and Nutrition</th>
                                    <th>
                                    <?php
                                        $sql = "SELECT COUNT(*) as total_records FROM immunization";

                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            $totalRecords = $row['total_records'];
                                            echo $totalRecords;
                                        } else {
                                            echo "Error: Cannot read total records." ;
                                        }
                                    ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Nutrition and Deworming</th>
                                    <th>
                                    <?php
                                        $sql = "SELECT COUNT(*) as total_records FROM nutrition";

                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            $totalRecords = $row['total_records'];
                                            echo $totalRecords;
                                        } else {
                                            echo "Error: Cannot read total records." ;
                                        }
                                    ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Family Planning</th>
                                    <th>
                                    <?php
                                        $sql = "SELECT COUNT(*) as total_records FROM family_planning";

                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            $totalRecords = $row['total_records'];
                                            echo $totalRecords;
                                        } else {
                                            echo "Error: Cannot read total records." ;
                                        }
                                    ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Anti-flu Vaccination</th>
                                    <th>
                                    <?php
                                        $sql = "SELECT COUNT(*) as total_records FROM influenza_vaccination";

                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            $totalRecords = $row['total_records'];
                                            echo $totalRecords;
                                        } else {
                                            echo "Error: Cannot read total records." ;
                                        }
                                    ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Anti-pneumonia Vaccination</th>
                                    <th>
                                    <?php
                                        $sql = "SELECT COUNT(*) as total_records FROM anti_pneumonia";

                                        $result = mysqli_query($conn, $sql);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            $totalRecords = $row['total_records'];
                                            echo $totalRecords;
                                        } else {
                                            echo "Error: Cannot read total records." ;
                                        }
                                    ?>
                                    </th>
                                </tr>

                            </table>
                        </div>
                    </div>


                    <style>
                        #main-data{
                            background-color: white;
                        }
                        body{
                            background-color: #CDE8E5;

                        }
                    table {
                        width: 100%;
                        box-shadow: 0px 0px 2px gray;
                    }

                    th,
                    tr {
                        width: 50%;

                    }

                    tr:nth-child(even) {
                        background-color: rgb(243, 244, 245);
                    }

                    table,
                    th,
                    tr {
                        padding: 5px;
                    }

                    .row>.tab {
                        width: 48%;
                        margin: 1%;
                        height: auto;
                        padding: 20px;
                        background-color: white;
                        float: left;
                        border-radius: 20px;
                    }

                    .asddasd {
                        display: block;
                        width: 31%;
                        margin: 1%;
                        height: 150px;
                        box-shadow: 0px 0px 2px gray;
                        border-radius: 20px;
                    }

                    .dash3 {
                        width: 100%;
                        height: 100%;

                        border-radius: 10px;

                    }

                    .dvi>img {
                        height: 50%;
                        width: 50%;
                        border-radius: 50%;
                        margin: 5% 0 20% 0;
                    }

                    .dvi {
                        width: 50%;

                        height: 100%;
                        float: left;
                        padding: 20px;
                        border-radius: 10px;
                    }

                    .dvi {
                        font-size: 0.82rem;
                        color: black;
                    }

                    .dasd {
                        text-align: right;
                    }

                    .a1 {
                        background-color: #CDE8E5;
                    }

                    .a2 {
                        background-color: #EEF7FF;
                    }

                    .a3 {
                        background-color: #CDE8E5;
                    }

                    .a4 {
                        background-color: #EEF7FF;
                    }

                    .a5 {
                        background-color: #CDE8E5;
                    }

                    .a6 {
                        background-color: #EEF7FF;
                    }
                    </style>


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

    <style>
        .main .page-header h1 {
        font-size: 30px;
        }
.main .page-header h1 span {
  font-size: 16px;
}
    </style>
    <!-- jquery vendor -->
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <!-- bootstrap -->




    <script src="js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="js/lib/weather/weather-init.js"></script>
    <script src="js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="js/lib/chartist/chartist.min.js"></script>
    <script src="js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/lib/owl-carousel/owl.carousel-init.js"></script>
    <!-- scripit init-->
    <script src="js/dashboard2.js"></script>
</body>

</html>