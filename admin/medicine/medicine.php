<?php
session_start();
include "../dbcon.php";

// Redirect if user is not logged in or user type is System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Fetch medicines securely using prepared statements
$medicines = [];
$query = "SELECT * FROM medicine_inventory";
if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $result = $stmt->get_result();
    $medicines = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    die("Error fetching medicines: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Inventory | TechCare</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/tables.css">
    <style>
        body {
            background-color: #CDE8E5;
        }
        .action-btn {
            padding: 5px 10px;
            font-size: 14px;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .addBtn {
            background-color: #007bff;
        }
        .addBtn:hover {
            background-color: #0056b3;
        }
        .editBtn {
            background-color: #28a745;
        }
        .editBtn:hover {
            background-color: #218838;
        }
        .deleteBtn {
            background-color: #dc3545;
        }
        .deleteBtn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <?php include "partials/sidebar.php"; ?>
    <?php include "partials/header.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                        <h1>Medicine Inventory</h1>
                        <h6>Manage Your Medicines</h6>
                    </div>
                </div>
                <section id="main-content">
                    <div class="row">
                        <!-- Add Medicine Button -->
                        <div class="buttons">
                            <button class="addBtn action-btn" onclick="location.href='add_medicine.php'">
                                <span class="fa fa-plus"></span>&nbsp;&nbsp;Add Medicine
                            </button>
                        </div>

                        <!-- Medicine Inventory Table -->
                        <div class="tab">
                            <table id="medicineTable" class="tableResidents">
                                <thead>
                                    <tr>
                                        <th>Medicine Name</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Expiration Date</th>
                                        <th>Supplier</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($medicines)) : ?>
                                        <?php foreach ($medicines as $medicine) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($medicine['medicine_name']) ?></td>
                                                <td><?= htmlspecialchars($medicine['medicine_type']) ?></td>
                                                <td><?= (int)$medicine['quantity'] ?></td>
                                                <td><?= htmlspecialchars($medicine['expiration_date']) ?></td>
                                                <td><?= htmlspecialchars($medicine['supplier']) ?></td>
                                                <td>
                                                    <button class="editBtn action-btn" onclick="location.href='edit_medicine.php?id=<?= $medicine['medicine_id'] ?>'">Edit</button>
                                                    <button class="deleteBtn action-btn" onclick="deleteMedicine(<?= $medicine['medicine_id'] ?>)">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6">No medicines found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        /**
         * Deletes a medicine after confirmation.
         * @param {number} id - The ID of the medicine to delete.
         */
        function deleteMedicine(id) {
            if (confirm("Are you sure you want to delete this medicine?")) {
                window.location.href = `delete_medicine.php?id=${id}`;
            }
        }
    </script>
</body>
</html>
