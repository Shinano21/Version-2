<?php
session_start();

include "../dbcon.php"; // Database connection

// Fetch medicine details
if (isset($_GET['id'])) {
    $medicine_id = $_GET['id'];
    $query = "SELECT * FROM medicine_inventory WHERE medicine_id = $medicine_id";
    $result = mysqli_query($conn, $query);
    $medicine = mysqli_fetch_assoc($result);
}

// Update medicine details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_id = $_POST['medicine_id'];
    $medicine_name = $_POST['medicine_name'];
    $medicine_type = $_POST['medicine_type'];
    $quantity = $_POST['quantity'];
    $expiration_date = $_POST['expiration_date'];
    $supplier = $_POST['supplier'];

    $query = "UPDATE medicine_inventory SET 
              medicine_name = '$medicine_name',
              medicine_type = '$medicine_type',
              quantity = '$quantity',
              expiration_date = '$expiration_date',
              supplier = '$supplier'
              WHERE medicine_id = $medicine_id";

    if (mysqli_query($conn, $query)) {
        header("Location: medicine_inventory.php?success=Medicine updated successfully");
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
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
    <title>Edit Medicine | TechCare</title>
    <?php include "head.php"; ?>
</head>

<body onload="display_ct();">

    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <a href="medicine_inventory.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Medicine Inventory</h7>
                                </a>
                                <h1>Edit Medicine Record</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../home.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Inventory</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <section id="main-content">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="sectioning">
                                <br>
                                <p>Update all relevant fields. Fields marked with an asterisk (<span class="req">*</span>) are mandatory.</p>
                                <hr>
                                <input type="hidden" name="medicine_id" value="<?= $medicine['medicine_id'] ?>">

                                <table>
                                    <tr>
                                        <th><b>Medicine Details</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="medicine_name">Medicine Name<span class="req">*</span></label><br>
                                            <input type="text" name="medicine_name" id="medicine_name" value="<?= $medicine['medicine_name'] ?>" required>
                                        </th>
                                        <th>
                                            <label for="medicine_type">Medicine Type<span class="req">*</span></label><br>
                                            <select name="medicine_type" id="medicine_type" required>
                                                <option value="" disabled>Select Medicine Type</option>
                                                <option value="tablet" <?= $medicine['medicine_type'] == 'tablet' ? 'selected' : '' ?>>Tablet</option>
                                                <option value="capsule" <?= $medicine['medicine_type'] == 'capsule' ? 'selected' : '' ?>>Capsule</option>
                                                <option value="syrup" <?= $medicine['medicine_type'] == 'syrup' ? 'selected' : '' ?>>Syrup</option>
                                                <option value="injection" <?= $medicine['medicine_type'] == 'injection' ? 'selected' : '' ?>>Injection</option>
                                                <option value="ointment" <?= $medicine['medicine_type'] == 'ointment' ? 'selected' : '' ?>>Ointment</option>
                                                <option value="cream" <?= $medicine['medicine_type'] == 'cream' ? 'selected' : '' ?>>Cream</option>
                                                <option value="powder" <?= $medicine['medicine_type'] == 'powder' ? 'selected' : '' ?>>Powder</option>
                                                <option value="spray" <?= $medicine['medicine_type'] == 'spray' ? 'selected' : '' ?>>Spray</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="quantity">Quantity<span class="req">*</span></label><br>
                                            <input type="number" name="quantity" id="quantity" value="<?= $medicine['quantity'] ?>" required>
                                        </th>
                                        <th>
                                            <label for="expiration_date">Expiration Date<span class="req">*</span></label><br>
                                            <input type="date" name="expiration_date" id="expiration_date" value="<?= $medicine['expiration_date'] ?>" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="supplier">Supplier<span class="req">*</span></label><br>
                                            <input type="text" name="supplier" id="supplier" value="<?= $medicine['supplier'] ?>" required>
                                        </th>
                                    </tr>
                                </table>
                                <br>
                                <button type="submit">Update Medicine</button>
                                <br><br>
                                <hr>
                            </div>
                        </div>

                        <style>
                            body {
                                background-color: #CDE8E5;
                                overflow-x: hidden;
                            }
                            button[type="submit"] {
                                padding: 10px 40px;
                                border: none;
                                box-shadow: 0px 0px 3px gray;
                                color: white;
                                background-color: rgb(92, 84, 243);
                                border-radius: 10px;
                                float: right;
                                margin: 1%;
                            }

                            input, select {
                                border: none;
                                box-shadow: 0px 0px 2px gray;
                                border-radius: 10px;
                                padding: 7px;
                                width: 90%;
                            }

                            .req {
                                color: red;
                            }

                            table {
                                width: 100%;
                            }

                            th {
                                padding: 10px;
                            }

                            .sectioning {
                                padding: 20px;
                                background-color: #f9f9fd;
                                box-shadow: 0px 0px 2px gray;
                                border-radius: 10px;
                                width: 100%;
                            }

                            .row {
                                position: relative;
                            }
                        </style>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
