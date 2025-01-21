<?php
session_start();

include "../dbcon.php"; // Database connection

/// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine_name = mysqli_real_escape_string($conn, $_POST['medicine_name']);
    $medicine_type = mysqli_real_escape_string($conn, $_POST['medicine_type']);
    $quantity = intval($_POST['quantity']);
    $expiration_date = mysqli_real_escape_string($conn, $_POST['expiration_date']);
    $supplier = mysqli_real_escape_string($conn, $_POST['supplier']);
    $received_date = date('Y-m-d'); // Set the current date as received date

    // Check if the medicine with the same name, type, and expiration date exists
    $check_query = "SELECT * FROM medicine_inventory 
                    WHERE medicine_name = '$medicine_name' 
                    AND medicine_type = '$medicine_type' 
                    AND expiration_date = '$expiration_date'";
    $result = mysqli_query($conn, $check_query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        // Medicine exists, update the quantity
        $update_query = "UPDATE medicine_inventory 
                         SET quantity = quantity + $quantity 
                         WHERE medicine_name = '$medicine_name' 
                         AND medicine_type = '$medicine_type' 
                         AND expiration_date = '$expiration_date'";
        if (mysqli_query($conn, $update_query)) {
            header("Location: medicine_inventory.php?success=Quantity updated successfully");
            exit;
        } else {
            $error = "Error updating quantity: " . mysqli_error($conn);
        }
    } else {
        // Insert a new record
        $insert_query = "INSERT INTO medicine_inventory 
                         (medicine_name, medicine_type, quantity, expiration_date, supplier, received_date) 
                         VALUES ('$medicine_name', '$medicine_type', $quantity, '$expiration_date', '$supplier', '$received_date')";
        if (mysqli_query($conn, $insert_query)) {
            header("Location: medicine_inventory.php?success=Medicine added successfully");
            exit;
        } else {
            $error = "Error inserting new record: " . mysqli_error($conn);
        }
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
    <title>Add Medicine | TechCare</title>
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
                                <a href="./medicine_inventory.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Medicine Inventory</h7>
                                </a>
                                <h1>New Medicine Record</h1>
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
                                <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>
                                <hr>
                                <table>
                                    <tr>
                                        <th><b>Medicine Details</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="medicine_name">Medicine Name<span class="req">*</span></label><br>
                                            <input type="text" name="medicine_name" id="medicine_name" list="medicine_list" required>
                                            <datalist id="medicine_list">
                                                <option value="Paracetamol 500mg">
                                                <option value="Amoxicillin 250mg">
                                                <option value="Vitamin C 500mg">
                                                <option value="Cough Syrup 100ml">
                                                <option value="Ibuprofen 200mg">
                                                <option value="Oral Rehydration Salts">
                                                <option value="Metformin 500mg">
                                                <option value="Losartan 50mg">
                                                <option value="Salbutamol Inhaler">
                                                <option value="Cetirizine 10mg">
                                                <option value="Loperamide 2mg">
                                                <option value="Aspirin 81mg">
                                                <option value="Ranitidine 150mg">
                                                <option value="Omeprazole 20mg">
                                                <option value="Clotrimazole Cream">
                                                <option value="Multivitamins Syrup">
                                                <option value="Iron Tablets">
                                                <option value="Calcium Tablets">
                                                <option value="Zinc Tablets">
                                                <option value="Antacid Suspension">
                                                <option value="Hydrocortisone Cream">
                                                <option value="Antifungal Powder">
                                                <option value="Sterile Saline Solution">
                                                <option value="Acetaminophen Drops">
                                                <option value="Diphenhydramine 25mg">
                                                <option value="Loratadine 10mg">
                                                <option value="Bismuth Subsalicylate">
                                             </datalist>

                                        </th>
                                        <th>
                                            <label for="medicine_type">Medicine Type<span class="req">*</span></label><br>
                                            <select name="medicine_type" id="medicine_type" required>
                                                <option value="" disabled selected>Select Medicine Type</option>
                                                <option value="tablet">Tablet</option>
                                                <option value="capsule">Capsule</option>
                                                <option value="liquid_jel">Liquid Jel</option>
                                                <option value="syrup">Syrup</option>
                                                <option value="injection">Injection</option>
                                                <option value="ointment">Ointment</option>
                                                <option value="cream">Cream</option>
                                                <option value="powder">Powder</option>
                                                <option value="spray">Spray</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="quantity">Quantity<span class="req">*</span></label><br>
                                            <input type="number" name="quantity" id="quantity" required>
                                        </th>
                                        <th>
                                            <label for="expiration_date">Expiration Date<span class="req">*</span></label><br>
                                            <input type="date" name="expiration_date" id="expiration_date" required>
                                        </th>
                                    </tr>
                                    <tr>
                                    <th>
                                        <label for="received_date">Received Date<span class="req">*</span></label><br>
                                        <input type="date" name="received_date" id="received_date" value="<?= date('Y-m-d') ?>" required>
                                    </th>
                                </tr>

                                    <tr>
                                        <th>
                                            <label for="supplier">Supplier<span class="req">*</span></label><br>
                                            <input type="text" name="supplier" id="supplier" required>
                                        </th>
                                    </tr>
                                </table>
                                <br>
                                <button type="submit">Add Medicine</button>
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
