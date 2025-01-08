<?php
session_start();
include "dbcon.php";

// Redirect if the user is not logged in or if the user is a System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Get filter parameters
$filterMonth = isset($_GET['month']) ? $_GET['month'] : '';
$filterYear = isset($_GET['year']) ? $_GET['year'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-name" content="focus" />
    <title>Animal Bite Records | TechCare</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/tables.css">
    <style>
              body{
               background-color: #CDE8E5;
            }
        /* Dropdown Styling */
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
if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "System Administrator") {
    include "partials/admin_sidebar.php";
} else {
    include "partials/sidebar.php";
}
?>
<?php include "partials/header.php" ?>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row" id="header-row">
                <div class="title-page">
                    <h1>Animal Bite Records</h1>
                    <h6>Animal Bite Patients</h6>
                </div>
                <div class="bc-page">
                    <ol class="bc">
                        <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Services</li>
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
                                <option value="" <?= empty($filterMonth) ? 'selected' : '' ?>>All Months</option>
                                <?php
                                for ($month = 1; $month <= 12; $month++) {
                                    $monthName = date("F", mktime(0, 0, 0, $month, 1));
                                    $selected = ($filterMonth == $month) ? 'selected' : '';
                                    echo "<option value='$month' $selected>$monthName</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="yearFilter">
                            <span for="yearSelect">Year:</span>
                            <select id="yearSelect" class="yearSelect">
                                <option value="" <?= empty($filterYear) ? 'selected' : '' ?>>All Years</option>
                                <?php
                                $currentYear = date('Y');
                                for ($year = $currentYear; $year >= 1500; $year--) {
                                    $selected = ($filterYear == $year) ? 'selected' : '';
                                    echo "<option value='$year' $selected>$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="services/services6.php">
                            <button class="addBtn">
                                <span class="fa fa-plus"></span>&nbsp;&nbsp;Record
                            </button>
                        </a>
                        <div class="dropdown">
                            <button class="printBtn">
                                <span class="fa fa-print"></span>&nbsp;&nbsp;Print Records
                            </button>
                            <div class="dropdown-content">
                                <a href="template/services6.php" target="_blank">Print Reports</a>
                                <a href="template/list6.php" target="_blank">Print Records</a>
                            </div>
                        </div>
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

                        <table id="residentTable" class="tableResidents">
                            <thead class="head">
                                <tr>
                                    <th class="names" style="display: flex; justify-content:center">Full Name</th>
                                    <th>Birth Date</th>
                                    <th>Bite Date</th>
                                    <th>Bite Location</th>
                                    <th>Bitten Location</th>
                                    <th>Treatment Center</th>
                                    <th>Remarks</th>
                                    <th class="lastCol">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php include "data/showAnimalBites.php" ?>
                            </tbody>   
                        </table>
                        <div class="showPages">
                            <p>Showing 1 to X of X entries</p>
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
    function display_ct() {
        var refresh = 1000; // Refresh rate in milliseconds
        setTimeout(display_ct, refresh);
        var x = new Date();
        var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
        var timeString = x.toLocaleTimeString('en-US', options);
        var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });
        var x1 = datePart + ' - ' + timeString;
        document.getElementById('ct').innerHTML = x1;
    }
    display_ct();

    // Filter records based on dropdown selections
    document.getElementById('monthSelect').addEventListener('change', applyFilters);
    document.getElementById('yearSelect').addEventListener('change', applyFilters);

    function applyFilters() {
        const month = document.getElementById('monthSelect').value;
        const year = document.getElementById('yearSelect').value;

        // Construct the URL with filter parameters
        const url = `services6.php?month=${month}&year=${year}`;
        window.location.href = url;
    }
</script>
<script>
    // Event listener for the search input
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const searchValue = this.value;

        // Create an AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'data/showAnimalBites.php', true); // Correct path to the PHP file
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // On successful response
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.querySelector('#residentTable tbody').innerHTML = xhr.responseText; // Update table
            } else {
                console.error('Error fetching data');
            }
        };

        // Send the search value to the PHP backend
        xhr.send('search=' + encodeURIComponent(searchValue));
    });
</script>
<!-- Script imports -->
<script src="../js/lib/jquery.min.js"></script>
<script src="../js/lib/jquery.nanoscroller.min.js"></script>
<script src="../js/lib/menubar/sidebar.js"></script>
<script src="../js/lib/preloader/pace.min.js"></script>
<script src="../js/scripts.js"></script>
<?php include "partials/scripts.php" ?>
</body>
</html>
