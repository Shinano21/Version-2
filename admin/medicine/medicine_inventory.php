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
.tab {
    margin-top: 47px;
    overflow-x: auto; /* Ensures horizontal scrolling for smaller screens */
    background-color: #ffffff; /* Table background */
    border-radius: 8px; /* Rounded edges for the table container */
    padding: 15px; /* Padding around the table */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: subtle shadow */
}

/* Table Styling */
#medicineTable {
    width: 100%; /* Full width of the container */
    border-collapse: collapse; /* Remove gaps between cells */
    font-size: 14px; /* Font size for readability */
    text-align: left; /* Align text to the left */
    border: 1px solid #ddd; /* Add outer border */
}

/* Table Header */
#medicineTable thead th {
    padding: 12px; /* Space inside header cells */
    border: 1px solid #ddd; /* Borders for header cells */
    font-weight: bold; /* Make header text bold */
    text-align: center; /* Align header text to the left */
}

/* Table Rows */
#medicineTable tbody tr {
    border: 1px solid #ddd; /* Borders around rows */
}

#medicineTable tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Optional: Light background for even rows */
}

#medicineTable tbody td {
    padding: 10px; /* Space inside cells */
    border: 1px solid #ddd; /* Borders for each cell */
    vertical-align: middle; /* Center-align text vertically */
    text-align: center;
}

/* Empty State */
#medicineTable td[colspan="6"] {
    text-align: center; /* Center the "No medicines found" message */
    color: #888; /* Subtle text color */
    font-style: italic; /* Italicize the message */
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
    background-color: #007bff; /* Green */
    color: white;
    padding: 12px;
    font-size: 12px;
    border: none;
    cursor: pointer;
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
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    
}

/* Links inside the dropdown */
.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1; color: black;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #007bff;
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
                <a href="medicine_recieved.php" target="_blank" style="display: block; padding: 10px;">Medicine Received</a>
                <a href="medicine_report.php" target="_blank" style="display: block; padding: 10px;">Medicine Report</a>
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
        <button class="dropbtn">Action</button>
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

</body>
</html>
