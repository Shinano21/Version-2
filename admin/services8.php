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
    <title>Hypertension Records | TechCare</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/tables.css">
    <style>
        body {
            background-color: #CDE8E5;
            font-family: Arial, sans-serif;
        }
        .content-wrap {
            margin: 20px;
        }
        .addBtn, .printBtn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-right: 10px;
        }
        .addBtn:hover, .printBtn:hover {
            background-color: #0056b3;
        }
        /* .searchBar {
            padding: 5px;
            font-size: 14px;
        } */
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .filters select {
            padding: 5px;
            font-size: 14px;
        }
        .tableResidents {
            width: 100%;
            border-collapse: collapse;
        }
        .tableResidents th, .tableResidents td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .tableResidents th {
            background-color: #f1f1f1;
        }
        .tableResidents td {
            background-color: #f1f1f1;
        }
        .head th { text-align: center; }
   
        .buttons2 {
    display: flex;
    justify-content: space-between; /* Ensures the left section and right section are far apart */
    align-items: center; /* Vertically aligns both sections */
    width: 100%; /* Ensures the container spans the full width */
    margin-bottom: 10px;
}

.showEntries {
    display: flex;
    align-items: center; /* Vertically aligns "Show" text and input field */
    gap: 5px; /* Adds spacing between "Show", input, and "entries" text */
}

.showEntries p {
    margin: 0;
    font-size: 14px;
}

.numberInput {
    border: 1px solid black;
    background-color: white;
    padding: 0px;
    font-size: 14px;
    border-radius: 4px;
    width: 60px; /* Keeps the input field compact */
    text-align: center; /* Centers the number inside the input */
}

.searchTable {
    display: flex;
    align-items: center; /* Vertically aligns search label and input */
    gap: 5px; /* Adds spacing between the label and the search bar */
}

.searchBar {
    padding: 5px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 200px; /* Adjusts the width of the search input field */
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
                        <h6>Manage Hypertension Checkup Details</h6>
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
                                    <label for="monthSelect">Filter by Month:</label>
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
                                    <label for="yearSelect">Year:</label>
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
                                <a href="template/list8.php" target="_blank">
                                            <button class="printBtn"><span class="fa fa-print"></span>&nbsp;&nbsp;Print Records</button>
                                        </a>


                            </div>

                            <div class="tab">
                            <div class="buttons2">
                            <div class="showEntries">
                                    <p>Show
                                    <input type="number" value="15" class="numberInput"></input>
                                    entries</p>
                                </div>
                                <div class="searchTable">
                                    <label for="searchInput">Search:</label>
                                    <input type="text" id="searchInput" class="searchBar" placeholder="Enter keyword">
                                </div>
                            </div>

                                <table id="residentTable" class="tableResidents">
                                    <thead class="head">
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Checkup Date</th>
                                            <th>Medicine Type</th>
                                            <th>Blood Pressure</th>
                                            <th>Remarks</th>
                                            <th style="text-align: center;">Action</th>
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

        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#residentTable tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>

    <?php include "partials/scripts.php"; ?>
</body>
</html>
