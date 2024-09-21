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
    <title>Animal Bite Records | CareVisio</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/tables.css">
</head>

<body>
    <?php
    if ($_SESSION["user_type"] == "System Administrator") {
        include "partials/admin_sidebar.php";
    } else {
        include "partials/sidebar.php";
    }
    include "partials/header.php";
    ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                        <h1>Animal Bite Records</h1>
                        <h6>List of Bite Incidents</h6>
                    </div>
                    <div class="bc-page">
                        <ol class="bc">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Services</li>
                        </ol>
                    </div>
                </div>
                
                <section id="main-content">
                    <div class="row">
                        <div class="buttons">
                            <a href="services/services6.php"><button class="addBtn"><span class="fa fa-plus"></span>&nbsp;&nbsp;Record</button></a>
                            <a href="template/animal_bite_print.php" target="_blank"><button class="printBtn"><span class="fa fa-print">&nbsp;&nbsp;</span>Print Records</button></a>
                        </div>
                        
                        <div class="tab">
                            <table id="animalBiteTable" class="tableResidents">
                                <thead class="head">
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Bite Date</th>
                                        <th>Treatment Date</th>
                                        <th>Location</th>
                                        <th>Treatment Center</th>
                                        <th>Remarks</th>
                                        <th class="lastCol">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include "data/showAnimalBites.php"; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include "partials/scripts.php"; ?>
</body>
</html>
