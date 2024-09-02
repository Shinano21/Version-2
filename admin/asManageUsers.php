<?php
session_start();

include '../dbcon.php';

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] !== "System Administrator") {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Users | CareVisio</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/settings.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body onload="display_ct();">

    <?php include "partials/admin_sidebar.php"?>
    <!-- Sidebar -->
    <?php include "partials/header.php" ?>
    <!-- Header -->

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <section id="main-content">
                    <div class="contentBg">
                        <div class="contentBox">
                            <div class="titles">
                                <p>Manage Admin</p>
                            </div>
                            <div class="addUser">
                                <a href="asAddUsers.php" class="addUs">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                    <p>Add New</p>
                                </a>
                            </div>
                            <div class="table">
                                <div class="showSearch">
                                    <div class="showEntries">
                                        <p>Show</p>
                                        <input type="number" value="10" class="numberInput" max="10"></input>
                                        <p>entries</p>
                                    </div>

                                    <div class="searchTable">
                                        <p>Search</p>
                                        <input type="text" id="searchInput" class="searchBar" placeholder="Enter keyword">
                                    </div>
                                </div>
                                <table id="userTable">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Position</th>
                                            <th>Username</th>
                                            <th>Account Status</th>
                                            <th style="text-align:center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include "asShowData.php"; ?>
                                    </tbody>

                                </table>
                            </div>
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
    <?php include "partials/scripts.php"; ?>
    <script src="js/preview.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            var entriesPerPage = 10; // default entries per page
            var currentPage = 1;

            function showEntries() {
                // Logic to display the specified number of entries per page
                var startIndex = (currentPage - 1) * entriesPerPage;
                var endIndex = startIndex + entriesPerPage;

                // Hide all rows first
                $('#userTable tbody tr').hide();

                // Filter rows based on the search keyword
                var keyword = $('#searchInput').val().toLowerCase();
                var filteredRows = $('#userTable tbody tr').filter(function () {
                    var rowText = $(this).text().toLowerCase();
                    return rowText.includes(keyword);
                });

                // Show the filtered rows within the specified range
                filteredRows.slice(startIndex, endIndex).show();

                // Update the "Showing X to Y of Z entries" text
                var totalEntries = filteredRows.length;
                var showingTo = Math.min(endIndex, totalEntries);
                var showingFrom = Math.min(startIndex + 1, showingTo);
                $('.showPages p').text('Showing ' + showingFrom + ' to ' + showingTo + ' of ' + totalEntries + ' entries');

                // Update the page number indicator
                $('.page-indicator .num').text(currentPage);
            }


            // Search input keyup event
            $('#searchInput').on('keyup', function () {
                currentPage = 1;
                showEntries();
                updatePagination();
            });

            function updatePagination() {
                // Update the page number indicator
                $('.page-indicator .num').text(currentPage);
            }

            // Show entries change event
            $('.numberInput').on('input', function () {
                // Get the entered value
                var enteredValue = parseInt($(this).val(), 10);

                // Set a maximum limit (e.g., 10)
                var maxLimit = 10;

                // Update the entriesPerPage variable
                entriesPerPage = enteredValue <= maxLimit ? enteredValue : maxLimit;

                // Reset the current page to 1
                currentPage = 1;

                // Show entries and update pagination
                showEntries();
                updatePagination();
            });


            // Next button click event
            $('#next').on('click', function () {
                var totalEntries = $('#userTable tbody tr').length;
                var totalPages = Math.ceil(totalEntries / entriesPerPage);

                if (currentPage < totalPages) {
                    currentPage++;
                    showEntries();
                    updatePagination();
                }
            });

            // Previous button click event
            $('#prev').on('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    showEntries();
                    updatePagination();
                }
            });

            // Initial setup
            showEntries();
            updatePagination();
        });
    </script>


</body>

</html>