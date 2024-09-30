<?php
session_start();
include "dbcon.php";

// Redirect if user is not logged in or if user type is System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hypertension Records | CareVisio</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/tables.css">
</head>
<body onload="display_ct();">

    <?php
        if ($_SESSION["user_type"] == "System Administrator") {
            include "partials/admin_sidebar.php";
        } else {
            include "partials/sidebar.php";
        }
    ?>
    <?php include "partials/header.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                        <h1>Hypertension Records</h1>
                        <h6>Hypertension Checkup Details</h6>
                    </div>
                    <div class="bc-page">
                        <ol class="bc">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Hypertension Records</li>
                        </ol>
                    </div>
                </div>

                <section id="main-content">
                    <div class="row">
                        <div class="filters">
                            <div class="monthFilter">
                                <span for="monthSelect">Filter by Month:</span>
                                <select id="monthSelect" class="monthSelect">
                                    <option value="" selected>All Months</option>
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        $monthName = date("F", mktime(0, 0, 0, $month, 1));
                                        echo "<option value='$month'>$monthName</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="yearFilter">
                                <span for="yearSelect">Year:</span>
                                <select id="yearSelect" class="yearSelect">
                                    <option value="" selected>All Years</option>
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
                            <a href="services/add_hypertension.php"><button class="addBtn"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add Record</button></a>
                            <a href="template/hypertension_records.php" target="_blank"><button class="printBtn"><span class="fa fa-print">&nbsp;&nbsp;</span>Print Records</button></a>
                        </div>

                        <div class="tab">
                            <div class="showSearch">
                                <div class="showEntries">
                                    <p>Show
                                    <input type="number" value="15" class="numberInput"></input>
                                    entries</p>
                                </div>

                                <div class="searchTable">
                                    <p>Search
                                    <input type="text" id="searchInput" class="searchBar" placeholder="Enter keyword"></p>
                                </div>
                            </div>

                            <table id="hypertensionTable" class="tableHypertension">
                                <thead class="head">
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Checkup Date</th>
                                        <th>Medicine Type</th>
                                        <th>Blood Pressure</th>
                                        <th>Remarks</th>
                                        <th class="lastCol">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php include "data/showHypertension.php"; ?>
                                </tbody>
                            </table>

                            <div class="showPages">
                                <p>Showing 1 to X of Y entries</p>
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
        // Similar JavaScript functionality as in the prenatal records for filtering, searching, and pagination
    </script>

    <?php include "partials/scripts.php"; ?>
</body>
</html>
