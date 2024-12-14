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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>Immunization and Nutrition Records | TechCare</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/tables.css">
    <style>
         body{
               background-color: #CDE8E5;
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
    <!-- /# sidebar -->
    <?php include "partials/header.php"?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                        <h1>Immunization and Nutrition Services Records</h1>
                        <h6>Infants Age 0-11 months old and Children 12 months old</h6>
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
                                    <option value="" selected>All Months</option>
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
                            <a href="services/services1.php"><button class="addBtn"><span class="fa fa-plus"></span>&nbsp;&nbsp;Record</button></a>
                            <a href="template/services1.php" target="_blank"><button class="printBtn"><span class="fa fa-print">&nbsp;&nbsp;</span>Print Records</button></a>
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
                                        <th>Date of Registration</th>
                                        <th>Date of Birth</th>
                                        <th>SE Status</th>
                                        <th>Sex</th>
                                        <th>Zone</th>
                                        <th class="lastCol">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php include "data/showImmunization.php"?>
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
                    let regDate = rowData[1]; // Assuming the "Date of Registration" column is the 2nd column (index 1)

                    if (selectedYear === "") {
                        return (
                            rowData.some(data => data.includes(searchTerm)) &&
                            (selectedMonth === "" || getMonthFromDate(regDate) === parseInt(selectedMonth, 10))
                        );
                    } else {
                        let [regYear, regMonth] = regDate.split('-').map(num => parseInt(num, 10));
                        return (
                            rowData.some(data => data.includes(searchTerm)) &&
                            (regYear === parseInt(selectedYear, 10)) &&
                            (selectedMonth === "" || regMonth === parseInt(selectedMonth, 10))
                        );
                    }
                });

                return rows;
            }

            // Function to get the month from a date string
            function getMonthFromDate(dateString) {
                return new Date(dateString).getMonth() + 1; // Months are zero-indexed, so we add 1
            }

            // Function to calculate total pages
            function totalPages() {
                let filteredData = filterData();
                let totalEntries = filteredData.length;
                return Math.ceil(totalEntries / entriesPerPage);
            }

            originalData = Array.from(residentTable.querySelectorAll('tbody tr'));
            updateTable();
        });
    </script>
    <script>
        // Function to handle printing with selected year
        function printImmunization() {
            let selectedYear = yearSelect.value;
            // Construct the URL for services1.php with selected year
            let printURL = `template/services1.php?year=${selectedYear}`;

            // Open a new window/tab for printing
            window.open(printURL, '_blank');
            }
        // Event listener for the print button
        document.querySelector('.printBtn').addEventListener('click', printImmunization);
    </script>

    <?php include "partials/scripts.php"?>
</body>
</html>