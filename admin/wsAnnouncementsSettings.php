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
    <title>Announcement Settings | TechCare</title>
    <?php include "../user/data/home.php"; ?>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/wsHome.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
          body{
    background-color: #CDE8E5;
  }
    </style>
</head>

<body onload="display_ct();">

    <?php include "partials/sidebar.php"?>
    <!-- Sidebar -->
    <?php include "partials/header.php" ?>
    <!-- Header -->

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <section id="main-content">
                    <div class="tab">
                        <button class="tablinks active" onclick="openTab(event, 'Tab1')">Header Image</button>
                        <button class="tablinks" onclick="openTab(event, 'Tab2')">Announcements</button>
                    </div>

                    <div id="Tab1" class="tabcontent">
                        <form action="cms/edit_announcements.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Header Section</h5>
                                <div class="photo">
                                    <label for="imageInput">Header/ Background Image:</label>
                                    <input type="file" id="imageInput" name="bg_img" accept="image/*" required>
                                    <div class="preview">
                                        <?php
                                        if ($announcePic !== null) {
                                            $imageType = strpos($announcePic, '/png') !== false ? 'png' : 'jpeg';
                                            echo "<img id='preview' src='data:image/{$imageType};base64," . base64_encode($announcePic) . "' alt='Preview' style='max-width:250px; max-height:250px;'>";
                                        } else {
                                            echo "<img id='preview' src='#' alt='Preview' style='display:none; max-width:250px; max-height:250px;'>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                    <button type="submit" name="submit">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div id="Tab2" class="tabcontent">
                        <div class="form">
                            <h5>Announcements</h5>
                        </div>
                        <div class="addUser">
                            <a href="wsAddAnnouncements.php" class="addUs">
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
                                        <th>Post Date</th>
                                        <th>Heading</th>
                                        <th>Body</th>
                                        <th>Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include "data/showAnnouncements.php"; ?>
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
    <script>
    window.onload = function() {
        document.getElementById('Tab1').classList.add("show");
        document.querySelector('.tablinks.active').classList.remove('active');
        document.querySelector('.tablinks').classList.add('active');
    };

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.remove("show");
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        document.getElementById(tabName).classList.add("show");
        evt.currentTarget.classList.add("active");
    }
    </script>
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
    <script src="js/preview.js"></script>
</body>

</html>