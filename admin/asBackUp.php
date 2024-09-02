<?php
session_start();

include '../dbcon.php';

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] !== "System Administrator") {
    header("Location: index.php");
    exit();
}

// Function to perform database backup
function backupDatabase($host, $user, $password, $database, $backupPath)
{
    $command = "mysqldump -h $host -u $user -p$password $database > $backupPath";
exec($command, $output, $return_var);

if ($return_var === 0) {
    echo "Backup successful!";
} else {
    echo "Backup failed! Error code: $return_var";
    echo "<pre>" . implode("\n", $output) . "</pre>";
}

}

if (isset($_POST['backup'])) {
    // Set your database connection details
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'carevisio';

    // Set the path where you want to save the backup file
    $backupPath = 'path_to_backup_directory/backup.sql';

    // Call the backup function
    backupDatabase($host, $user, $password, $database, $backupPath);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
                                <p>Backup Data</p>
                            </div>
                            <form method="post">
                                <button type="submit" name="backup" class="backupBtn">Backup Database</button>
                            </form>
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
</body>

</html>
