<?php
session_start();


if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About Settings | CareVisio</title>
    <?php include "../user/data/about_us.php"; ?>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/wsHome.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                        <button class="tablinks active" onclick="openTab(event, 'Tab1')">Header</button>
                        <button class="tablinks" onclick="openTab(event, 'Tab2')">Welcome Section</button>
                        <button class="tablinks" onclick="openTab(event, 'Tab3')">Mission/Vision</button>
                        <button class="tablinks" onclick="openTab(event, 'Tab4')">Health Team</button>
                    </div>

                    <div id="Tab1" class="tabcontent">
                        <form action="cms/edit_about.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Header</h5>
                                <input type="hidden" name="header" value="Header">
                                <div class="photo">
                                    <label for="imageInput">Header Image:</label>
                                    <input type="file" id="imageInput" name="bg_img" accept="image/*" required>
                                    <div class="preview">
                                        <?php
                                        if ($headerPic !== null) {
                                            $imageType = strpos($headerPic, '/png') !== false ? 'png' : 'jpeg';
                                            echo "<img id='preview' src='data:image/{$imageType};base64," . base64_encode($headerPic) . "' alt='Preview' style='max-width:250px; max-height:250px;'>";
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
                        <form action="cms/edit_about.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Welcome Section</h5>
                                <input type="hidden" name="header" value="Welcome Section">
                                <div class="formInput" style="width: 100%;">
                                    <label>Heading</label>
                                    <input type="text" value="<?php echo $sectionHead; ?>" name="section_head"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Subheading</label>
                                    <input type="text" value="<?php echo $sectionSubhead; ?>"" name=" section_subhead"
                                        placeholder="Enter data" required>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Body</label>
                                    <textarea placeholder="Enter data" name="section_body"
                                        required><?php echo $sectionBody; ?></textarea>
                                </div>
                                <div class="photo">
                                    <label for="imageInput">Section/Supporting Image:</label>
                                    <input type="file" id="imageInput" name="section_img" accept="image/*" required>
                                    <div class="preview">
                                        <img id="preview" src="#" alt="Preview"
                                            style="display:none; max-width:250px; max-height:250px;">
                                    </div>
                                </div>
                                <div style="width: 100%; display: flex; justify-content: end; align-items: end;">
                                    <button type="submit" name="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="Tab3" class="tabcontent">
                        <form action="cms/edit_about.php" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <h5>Mission and Vision</h5>
                                <input type="hidden" name="header" value="Mission and Vision">
                                <div class="formInput" style="width: 100%;">
                                    <label>Mission</label>
                                    <textarea placeholder="Enter data" name="mission"
                                        required><?php echo $mission; ?></textarea>
                                </div>
                                <div class="formInput" style="width: 100%;">
                                    <label>Vision</label>
                                    <textarea placeholder="Enter data" name="vision"
                                        required><?php echo $vision; ?></textarea>
                                </div>
                                <div class="photo">
                                    <label for="imageInput">Mission Image:</label>
                                    <input type="file" id="imageInput" name="mission_pic" accept="image/*" required>
                                    <div class="preview">
                                        <?php
                                        if ($missionPic !== null) {
                                            $imageType = strpos($missionPic, '/png') !== false ? 'png' : 'jpeg';
                                            echo "<img id='preview' src='data:image/{$imageType};base64," . base64_encode($missionPic) . "' alt='Preview' style='max-width:250px; max-height:250px;'>";
                                        } else {
                                            echo "<img id='preview' src='#' alt='Preview' style='display:none; max-width:250px; max-height:250px;'>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="photo">
                                    <label for="imageInput">Vision Image:</label>
                                    <input type="file" id="imageInput" name="vision_pic" accept="image/*" required>
                                    <div class="preview">
                                        <?php
                                        if ($visionPic !== null) {
                                            $imageType = strpos($visionPic, '/png') !== false ? 'png' : 'jpeg';
                                            echo "<img id='preview' src='data:image/{$imageType};base64," . base64_encode($visionPic) . "' alt='Preview' style='max-width:250px; max-height:250px;'>";
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

                    <div id="Tab4" class="tabcontent">
                        <div class="form">
                            <h5>Barangay Health Team Section</h5>
                            <input type="hidden" name="header" value="Barangay Health Team">
                        </div>

                        <div class="addUser">
                            <a href="wsAddNewBHT.php" class="addUs">
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
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include "data/showHealthTeam.php"; ?>
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