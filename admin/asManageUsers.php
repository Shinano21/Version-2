<?php
session_start();

include '../dbcon.php';

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] !== "System Administrator") {
    header("Location: index.php");
    exit();
}

// Handle success or error messages passed via URL
$modalMessage = isset($_GET['message']) ? $_GET['message'] : "";
$modalType = isset($_GET['type']) ? $_GET['type'] : "";
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

    <?php include "partials/admin_sidebar.php" ?>
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

    <!-- Success/Error Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="resultModalMessage">
                    <!-- Modal message will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="modalButtonAction" data-bs-dismiss="modal">Close</button>
                </div>
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
            
            var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var timeString = x.toLocaleTimeString('en-US', options);

            var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });

            var x1 = datePart + ' - ' + timeString;

            document.getElementById('ct').innerHTML = x1;
            tt = display_c();
        }

        // Check for PHP modal messages
        var modalMessage = "<?php echo $modalMessage; ?>";
        var modalType = "<?php echo $modalType; ?>";

        if (modalMessage !== "") {
            var modalLabel = document.getElementById('resultModalLabel');
            var modalBody = document.getElementById('resultModalMessage');
            var modalButton = document.getElementById('modalButtonAction');
            
            if (modalType === "success") {
                modalLabel.innerText = "Success";
                modalBody.innerText = modalMessage;
            } else {
                modalLabel.innerText = "Error";
                modalBody.innerText = modalMessage;
            }

            var myModal = new bootstrap.Modal(document.getElementById('resultModal'), {});
            myModal.show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/preview.js"></script>

    <script>
        $(document).ready(function () {
            var entriesPerPage = 10; 
            var currentPage = 1;

            function showEntries() {
                var startIndex = (currentPage - 1) * entriesPerPage;
                var endIndex = startIndex + entriesPerPage;

                $('#userTable tbody tr').hide();

                var keyword = $('#searchInput').val().toLowerCase();
                var filteredRows = $('#userTable tbody tr').filter(function () {
                    var rowText = $(this).text().toLowerCase();
                    return rowText.includes(keyword);
                });

                filteredRows.slice(startIndex, endIndex).show();

                var totalEntries = filteredRows.length;
                var showingTo = Math.min(endIndex, totalEntries);
                var showingFrom = Math.min(startIndex + 1, showingTo);
                $('.showPages p').text('Showing ' + showingFrom + ' to ' + showingTo + ' of ' + totalEntries + ' entries');

                $('.page-indicator .num').text(currentPage);
            }

            $('#searchInput').on('keyup', function () {
                currentPage = 1;
                showEntries();
            });

            $('.numberInput').on('input', function () {
                var enteredValue = parseInt($(this).val(), 10);
                var maxLimit = 10;
                entriesPerPage = enteredValue <= maxLimit ? enteredValue : maxLimit;
                currentPage = 1;
                showEntries();
            });

            $('#next').on('click', function () {
                var totalEntries = $('#userTable tbody tr').length;
                var totalPages = Math.ceil(totalEntries / entriesPerPage);

                if (currentPage < totalPages) {
                    currentPage++;
                    showEntries();
                }
            });

            $('#prev').on('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    showEntries();
                }
            });

            showEntries();
        });
    </script>
</body>

</html>
