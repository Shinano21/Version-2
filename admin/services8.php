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
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .printBtn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .printBtn:hover {
            background-color: #0056b3;
        }
    </style>
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
                                <select id="monthSelect" class="monthSelect" onchange="applyFilters()">
                                    <option value="" selected>All Months</option>
                                    <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        $monthName = date("F", mktime(0, 0, 0, $month, 1));
                                        $selected = (isset($_GET['month']) && $_GET['month'] == $month) ? "selected" : "";
                                        echo "<option value='$month' $selected>$monthName</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="yearFilter">
                                <span for="yearSelect">Year:</span>
                                <select id="yearSelect" class="yearSelect" onchange="applyFilters()">
                                    <option value="" selected>All Years</option>
                                    <?php
                                    $currentYear = date('Y');
                                    for ($year = $currentYear; $year >= 1500; $year--) {
                                        $selected = (isset($_GET['year']) && $_GET['year'] == $year) ? "selected" : "";
                                        echo "<option value='$year' $selected>$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="buttons">
                            <a href="services/services8.php">
                                <button class="addBtn"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add Record</button>
                            </a>
                            <div class="dropdown">
                                <button class="printBtn">
                                    <span class="fa fa-print"></span>&nbsp;&nbsp;Print Records
                                </button>
                                <div class="dropdown-content">
                                    <a href="template/services8.php" target="_blank">Print Services</a>
                                    <a href="template/list8.php" target="_blank">Print List</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab">
                            <table id="residentTable" class="tableResidents">
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
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        function applyFilters() {
            const month = document.getElementById('monthSelect').value;
            const year = document.getElementById('yearSelect').value;
            const url = new URL(window.location.href);
            if (month) url.searchParams.set('month', month);
            else url.searchParams.delete('month');
            if (year) url.searchParams.set('year', year);
            else url.searchParams.delete('year');
            window.location.href = url.toString();
        }

        function display_ct() {
            var refresh = 1000;
            setTimeout(display_ct, refresh);
            var x = new Date();
            var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var timeString = x.toLocaleTimeString('en-US', options);
            var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });
            var x1 = datePart + ' - ' + timeString;
            document.getElementById('ct').innerHTML = x1;
        }
        display_ct();
    </script>

    <?php include "partials/scripts.php"; ?>
</body>
</html>
