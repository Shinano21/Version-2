<?php
session_start();
include "../dbcon.php";

// Redirect if user is not logged in or user type is System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Query to fetch residents from the database
$query = "SELECT id, fname, lname FROM residents";
$result = mysqli_query($conn, $query);

// Query to fetch available medicines from the inventory
$medicineQuery = "SELECT medicine_name FROM medicine_inventory WHERE quantity > 0";
$medicineResult = mysqli_query($conn, $medicineQuery);
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>Add Hypertension Record | TechCare</title>
    <?php include "head.php"; ?>
</head>

<body onload="display_ct();">

    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                    <a href="../services8.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Hypertension Records</h7>
                                </a>
                        <h3>Hypertension Record</h3>
                        <h6>Add New Hypertension Record</h6>
                    </div>
                </div>
<!-- Modal for Quantity Check -->
<div id="quantityModal" class="modal">
    <div class="modal-content">
        <h4>Quantity Exceeded</h4>
        <p>The requested quantity exceeds the available inventory. Please adjust the quantity.</p>
        <button id="modalCloseBtn">OK</button>
    </div>
</div>

<style>
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1000; 
        left: 0; 
        top: 0; 
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgb(0, 0, 0); 
        background-color: rgba(0, 0, 0, 0.4); 
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; 
        padding: 20px; 
        border: 1px solid #888; 
        width: 30%;
        text-align: center;
        border-radius: 10px;
    }
    #modalCloseBtn {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    #modalCloseBtn:hover {
        background-color: #0056b3;
    }
</style>

                <section id="main-content">
                    <div class="form-container">
                        <form action="add_hypertension.php" method="POST">
                            <div class="form-group">
                                <label for="resident_name">Resident Name:<span class="req">*</span></label>
                                <select name="resident_id" id="resident_name" required>
                                    <option value="">Select Resident</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['id'] . '">' . $row['fname'] . ' ' . $row['lname'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="checkup_date">Checkup Date:<span class="req">*</span></label>
                                <input type="date" id="checkup_date" name="checkup_date" required>
                            </div>
                            <div class="form-group">
                            <label for="medicine_name">Medicine Name<span class="req">*</span></label>
                            <input 
                                type="text" 
                                id="medicine_name" 
                                name="medicine_name" 
                                list="medicine_options" 
                                placeholder="Type or select a medicine" 
                                required
                            >
                            <datalist id="medicine_options">
                                <?php
                                while ($medicine = mysqli_fetch_assoc($medicineResult)) {
                                    echo '<option value="' . htmlspecialchars($medicine['medicine_name']) . '"></option>';
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="form-group">
    <label for="medicine_type">Medicine Type<span class="req">*</span></label>
    <input 
        type="text" 
        id="medicine_type" 
        name="medicine_type" 
        list="medicine_type_options" 
        placeholder="Medicine type will auto-fill if available or can be manually entered" 
    >
    <datalist id="medicine_type_options">
        <option value="Tablet"></option>
        <option value="Capsule"></option>
        <option value="Syrup"></option>
        <option value="Injection"></option>
        <option value="Ointment"></option>
        <option value="Cream"></option>
        <option value="Powder"></option>
        <option value="Spray"></option>
    </datalist>
</div>



                            <div class="form-group">
                        <label for="quantity">Quantity<span class="req">*</span></label><br>
                        <input type="number" name="quantity" id="quantity" min="1" placeholder="pcs" required>
                    </th>
                            </div>

                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure:<span class="req">*</span></label>
                                <input type="text" id="blood_pressure" name="blood_pressure" required>
                            </div>
                            <div class="form-group">
                                <label for="remarks_type">Remarks:</label>
                                <textarea id="remarks_type" name="remarks_type"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-btn">Add Record</button>
                            </div>
                        </form>
                    </div>

                   
                </section>
            </div>
        </div>
    </div>

    <script src="js/scripts.js"></script> <!-- Link your JS file -->

    <style>
    
        body {
            background-color: #CDE8E5;
            overflow-x: hidden;
        }
        button[type="submit"] {
    display: inline-block;
    padding: 10px 40px;
    border: none;
    box-shadow: 0px 0px 3px gray;
    color: white;
    background-color: rgb(92, 84, 243);
    border-radius: 10px;
    margin-top: 10px; /* Adjusted for spacing */
    margin-right: 1%; /* Ensure it doesn't float too close to the right */
    float: none; /* Prevent overlapping by not floating the button */
    text-align: center; /* Center the text */
}

        textarea, input, select {
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
        th, td {
            padding: 10px;
        }
        .form-container, .record-display {
            padding: 20px;
            background-color: #f9f9fd;
            box-shadow: 0px 0px 2px gray;
            border-radius: 10px;
            width: 100%;
            margin-bottom: 20px;
        }
        .table-records {
            width: 100%;
            border-collapse: collapse;
        }
        .table-records th, .table-records td {
            border: 1px solid #ddd;
        }
        .title-page{
            padding: 20px;
        }
        .form-group {
            display: flex; justify-content: flex-end; /* Align items to the right */
        }
    </style>

<script>
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

        const medicineNameInput = document.getElementById('medicine_name');
const medicineTypeInput = document.getElementById('medicine_type');

medicineNameInput.addEventListener('input', function () {
    const medicineName = this.value.trim();

    if (medicineName) {
        fetch('fetch_medicine_type.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ medicine_name: medicineName }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                medicineTypeInput.value = data.medicine_type;
                medicineTypeInput.setAttribute('readonly', true); // Lock if fetched successfully
            } else {
                medicineTypeInput.value = ''; // Clear if no match
                medicineTypeInput.removeAttribute('readonly'); // Allow manual entry
            }
        })
        .catch(error => {
            console.error('Error fetching medicine type:', error);
            alert('An error occurred while fetching the medicine type.');
            medicineTypeInput.removeAttribute('readonly'); // Allow manual entry
        });
    } else {
        medicineTypeInput.value = ''; // Clear type if no name is entered
        medicineTypeInput.removeAttribute('readonly'); // Allow manual entry
    }
});


// modal
const form = document.querySelector('form');
const medicineInput = document.getElementById('medicine_name');
const quantityInput = document.getElementById('quantity');
const modal = document.getElementById('quantityModal');
const closeModal = document.getElementById('modalCloseBtn');
let availableQuantity = null; // To store the fetched available quantity

// Event to close modal
closeModal.addEventListener('click', () => (modal.style.display = 'none'));

// Event to fetch available quantity when medicine changes
medicineInput.addEventListener('input', () => {
    const medicineName = medicineInput.value.trim();

    if (medicineName) {
        fetch('check_medicine_inventory.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ medicine_name: medicineName }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    availableQuantity = data.available_quantity; // Update available quantity
                } else {
                    availableQuantity = null; // Reset if no data
                    alert('Unable to fetch inventory. Please select a valid medicine.');
                }
            })
            .catch(error => {
                console.error('Error fetching inventory:', error);
                availableQuantity = null;
                alert('An error occurred while fetching inventory.');
            });
    } else {
        availableQuantity = null; // Reset if no medicine name
    }
});

// Event to validate quantity dynamically when it changes
quantityInput.addEventListener('input', () => {
    const quantity = parseInt(quantityInput.value, 10);

    if (availableQuantity !== null && quantity > availableQuantity) {
        showModal(`The requested quantity exceeds the available stock. Only ${availableQuantity} left.`);
    }
});

// Form submission validation
form.addEventListener('submit', (event) => {
    const medicineName = medicineInput.value.trim();
    const quantity = parseInt(quantityInput.value, 10);

    if (!medicineName || availableQuantity === null) {
        showModal('Please select a valid medicine and wait for the inventory to load.');
        event.preventDefault();
        return;
    }

    if (quantity > availableQuantity) {
        showModal(`The requested quantity exceeds the available stock. Only ${availableQuantity} left.`);
        event.preventDefault(); // Stop form submission
    } else if (availableQuantity === 0) {
        showModal('This medicine is out of stock.');
        event.preventDefault(); // Stop form submission
    }
});

function showModal(message) {
    const modalContent = document.querySelector('.modal-content p');
    modalContent.textContent = message;
    modal.style.display = 'block';
}

    </script>

    <!-- Script imports -->
    <script src="../js/lib/jquery.min.js"></script>
    <script src="../js/lib/jquery.nanoscroller.min.js"></script>
    <script src="../js/lib/menubar/sidebar.js"></script>
    <script src="../js/lib/preloader/pace.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
