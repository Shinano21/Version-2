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
    <?php include "head.php"; ?>
    <link rel="stylesheet" href="../css/tables.css">
    
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

.modal {
    display: none;
    position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
}

.modal-actions {
    margin-top: 20px;
}

.printBtn {
    background-color: #17a2b8;
}

.printBtn:hover {
    background-color: #138496;
}

.dropdown-content a {
    text-decoration: none;
    color: #333;
    font-size: 14px;
}

.dropdown-content a:hover {
    background-color: #eaeaea;
}

/* Table Container */


/* Table Styling */
#medicineTable {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    text-align: left;
    border: 1px solid #ddd;
}

/* Table Header */
#medicineTable thead th {
    padding: 12px;
    border: 1px solid #ddd;
    font-weight: bold;
    text-align: center;
}

/* Table Rows */
#medicineTable tbody tr {
    border: 1px solid #ddd;
}

#medicineTable tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

#medicineTable tbody td {
    padding: 10px;
    border: 1px solid #ddd;
    vertical-align: middle;
    text-align: center;
}

/* Empty State */
#medicineTable td[colspan="6"] {
    text-align: center;
    color: #888;
    font-style: italic;
}

/* Actions Buttons */
#medicineTable .action-btn {
    padding: 5px 10px;
    font-size: 12px;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

#medicineTable .editBtn {
    background-color: #28a745;
}

#medicineTable .editBtn:hover {
    background-color: #218838;
}

#medicineTable .deleteBtn {
    background-color: #dc3545;
}

#medicineTable .deleteBtn:hover {
    background-color: #c82333;
}

/* Dropdown button */
.dropbtn {
    background-color: #007bff;
    color: white;
    padding: 12px;
    font-size: 12px;
    border: none;
    cursor: pointer;
    display: inline-block;
    position: relative;
}

/* Dropdown container (needed to position the dropdown content) */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #007bff;
    min-width: 120px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    top: 100%; /* Position dropdown below the button */
    left: 0;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #f1f1f1;
    color: black;
}

/* Show the dropdown menu when the dropdown is active */
.dropdown.active .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown.active .dropbtn {
    background-color: #007bff;
}

/* Print Report Dropdown */
.printBtn.action-btn {
    background-color: #17a2b8;
    color: white;
    padding: 12px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    position: relative; /* Makes this container the reference for the dropdown */
}

.printBtn:hover {
    background-color: #138496;
}

/* Dropdown Content */
#dropdownMenu {
    display: none;
    position: absolute; /* Position dropdown content relative to the button */
    background-color: #f9f9f9;
    min-width: 150px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    top: 100%; /* Positions the dropdown directly below the button */
    left: 0; /* Aligns it with the left side of the button */
}

/* Links inside the dropdown */
#dropdownMenu a {
    color: black;
    padding: 10px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
#dropdownMenu a:hover {
    background-color: #eaeaea;
}

</style>
</head>
<body onload="display_ct();">
    <?php include "sidebar.php"; ?>
    <?php include "header.php"; ?>

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
<div class="row no-print" style="width: 100%; position: relative;">
    <!-- Buttons Container -->
    <div class="buttons-container" style="position: absolute; right: 0; top: 0; display: flex; gap: 10px; margin-bottom: 10px;">
        <!-- Add Medicine Button -->
        <button class="addBtn action-btn"  onclick="location.href='add_medicine.php'">
            <span class="fa fa-plus"></span>&nbsp;&nbsp;Add Medicine
        </button>

        <!-- Print Report Dropdown -->
        <div class="printBtn action-btn" onclick="toggleDropdown()">
            Print Report ▼
            <div class="dropdown-content" id="dropdownMenu" style="display: none; position: absolute; background-color: #f9f9f9; min-width: 150px; box-shadow: 0 8px 16px rgba(0,0,0,0.2); z-index: 1;">
                <a href="medicine_recieved.php" target="_blank" style="display: block; padding: 10px; color:black">Medicine Received</a>
                <a href="medicine_report.php" target="_blank" style="display: block; padding: 10px; color:black;">Medicine Report</a>
            </div>
        </div>
    </div>
</div>



                        <!-- Medicine Inventory Table -->
                        <div class="tab" style="margin-top:47px;">
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
    <div class="dropdown">
        <button class="dropbtn">Action ▼</button>
        <div class="dropdown-content">
            <a href="update_medicine.php?id=<?= $medicine['medicine_id'] ?>">Edit</a>
            <a href="#" onclick="showModal(<?= $medicine['medicine_id'] ?>)">Delete</a>
        </div>
    </div>
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h4>Confirm Deletion</h4>
            <p>Are you sure you want to delete this medicine?</p>
            <div class="modal-actions">
                <button class="action-btn deleteBtn" id="confirmDeleteBtn">Delete</button>
                <button class="action-btn addBtn" onclick="hideModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll('.dropbtn').forEach(button => {
        button.addEventListener('click', function (event) {
            let dropdown = this.closest('.dropdown');
            dropdown.classList.toggle('active');
        });
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown.active').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });
</script>

    <script>
        let deleteId = null;

        /**
         * Shows the delete confirmation modal.
         * @param {number} id - The ID of the medicine to delete.
         */
        function showModal(id) {
            deleteId = id;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        /**
         * Hides the delete confirmation modal.
         */
        function hideModal() {
            deleteId = null;
            document.getElementById('deleteModal').style.display = 'none';
        }

        /**
         * Confirms the deletion and redirects to the delete endpoint.
         */
        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteId) {
                window.location.href = `delete_medicine.php?id=${deleteId}`;
            }
        });

        /**
 * Toggles the visibility of the dropdown menu.
 */
function toggleDropdown() {
    const dropdown = document.getElementById('dropdownMenu');
    if (dropdown.style.display === 'none' || dropdown.style.display === '') {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function (event) {
    const dropdown = document.getElementById('dropdownMenu');
    const button = document.querySelector('.printBtn');
    if (!button.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});


function display_ct() {
            var refresh = 1000; // Refresh rate in milliseconds
            setTimeout(display_ct, refresh);
            var x = new Date();
            var options = { timeZone: 'Asia/Manila', hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var timeString = x.toLocaleTimeString('en-US', options);
            var datePart = x.toLocaleDateString('en-US', { weekday: 'short', day: '2-digit', month: 'short', year: 'numeric' });
            var x1 = datePart + ' - ' + timeString;
            document.getElementById('ct').innerHTML = x1;
        }
        display_ct();
    
    </script>

<script>
    document.querySelectorAll('.sidebar-sub-toggle').forEach(toggle => {
    toggle.addEventListener('click', function () {
        // Toggle the visibility of the next sibling UL
        const submenu = this.nextElementSibling;
        if (submenu) {
            const isVisible = submenu.style.display === 'block';
            submenu.style.display = isVisible ? 'none' : 'block';
        }

        // Optional: Add active class for the dropdown indicator (angle icon)
        const icon = this.querySelector('.sidebar-collapse-icon');
        if (icon) {
            icon.classList.toggle('ti-angle-down');
            icon.classList.toggle('ti-angle-up'); // You can replace this with an upward icon
        }
    });
});

</script>
</body>
</html>
