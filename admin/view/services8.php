<?php
session_start();
include "../dbcon.php";

// Redirect if the user is not logged in or user type is System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Get the hypertension record ID from the query string
if (isset($_GET['id'])) {
    $hypertension_id = $_GET['id'];

    // Fetch the existing hypertension record based on ID
    $query = "SELECT * FROM hypertension WHERE hypertension_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $hypertension_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found!";
        exit();
    }

    // Fetch residents for the dropdown list
    $resident_query = "SELECT id, fname, lname FROM residents";
    $resident_result = mysqli_query($conn, $resident_query);
} else {
    echo "Invalid request!";
    exit();
}

// Handle the form submission to update the record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resident_id = $_POST['resident_id'];
    $checkup_date = $_POST['checkup_date'];
    $medicine_name = $_POST['medicine_name'];
    $medicine_type = $_POST['medicine_type'];
    $quantity = $_POST['quantity'];
    $blood_pressure = $_POST['blood_pressure'];
    $remarks_type = $_POST['remarks_type'];

    // Update the hypertension record
    $update_query = "UPDATE hypertension SET resident_id = ?, checkup_date = ?, medicine_name = ?, medicine_type = ?, quantity = ?, blood_pressure = ?, remarks_type = ? WHERE hypertension_id = ?";
    $update_stmt = $conn->prepare($update_query);
    
    if (!$update_stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $update_stmt->bind_param("issssisi", $resident_id, $checkup_date, $medicine_name, $medicine_type, $quantity, $blood_pressure, $remarks_type, $hypertension_id);
    
    if ($update_stmt->execute()) {
        header("Location: ../services8.php"); // Redirect after update
        exit();
    } else {
        echo "Error updating record: " . $update_stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-name" content="focus" />
    <title>Update Hypertension Record | TechCare</title>
    <?php include "../services/head.php"; ?>
</head>

<body>
    <?php include "../services/header.php"; ?>
    <?php include "../services/sidebar.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                    <a href="../services8.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Animal Bite Records</h7>
                                </a>
                        <h3>Hypertension Record</h3>
                    </div>
                </div>

                <section id="main-content">
                    <div class="form-container">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="resident_name">Resident Name:<span class="req">*</span></label>
                                <select name="resident_id" id="resident_name" required>
                                    <option value="">Select Resident</option>
                                    <?php
                                    while ($resident_row = mysqli_fetch_assoc($resident_result)) {
                                        $selected = ($resident_row['id'] == $row['resident_id']) ? 'selected' : '';
                                        echo '<option value="' . $resident_row['id'] . '" ' . $selected . '>' . $resident_row['fname'] . ' ' . $resident_row['lname'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="checkup_date">Checkup Date:<span class="req">*</span></label>
                                <input type="date" id="checkup_date" name="checkup_date" value="<?php echo $row['checkup_date']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="medicine_name">Medicine Name:</label>
                                <input 
                                    type="text" 
                                    id="medicine_name" 
                                    name="medicine_name" 
                                    value="<?php echo htmlspecialchars($row['medicine_name'], ENT_QUOTES, 'UTF-8'); ?>" 
                                    list="medicine_options" 
                                    placeholder="Type or select a medicine" 
                                    required
                                >
                                <datalist id="medicine_options">
                                    <option value="Metoprolol"></option>
                                    <option value="Losartan"></option>
                                    <option value="Amlodipine"></option>
                                    <option value="Cinnarizine"></option>
                                </datalist>
                            </div>

                             <div class="form-group">
                                <label for="medicine_type">Medicine Type:</label>
                                 <select 
                                id="medicine_type" 
                                name="medicine_type" 
                                required
                                 >
                                <option value="" disabled selected>Select Medicine Type</option>
                                <option value="tablet" <?php echo ($row['medicine_type'] === 'tablet') ? 'selected' : ''; ?>>Tablet</option>
                                <option value="capsule" <?php echo ($row['medicine_type'] === 'capsule') ? 'selected' : ''; ?>>Capsule</option>
                                <option value="syrup" <?php echo ($row['medicine_type'] === 'syrup') ? 'selected' : ''; ?>>Syrup</option>
                                <option value="injection" <?php echo ($row['medicine_type'] === 'injection') ? 'selected' : ''; ?>>Injection</option>
                                <option value="ointment" <?php echo ($row['medicine_type'] === 'ointment') ? 'selected' : ''; ?>>Ointment</option>
                                <option value="cream" <?php echo ($row['medicine_type'] === 'cream') ? 'selected' : ''; ?>>Cream</option>
                                <option value="powder" <?php echo ($row['medicine_type'] === 'powder') ? 'selected' : ''; ?>>Powder</option>
                                <option value="spray" <?php echo ($row['medicine_type'] === 'spray') ? 'selected' : ''; ?>>Spray</option>
                                </select>
                             </div>

                                <div class="form-group">
                                
                                    <label for="quantity">Quantity<span class="req">*</span></label><br>
                                    <input 
                                    type="number" 
                                    name="quantity" 
                                    id="quantity" 
                                    value="<?php echo $row['quantity']; ?>"  
                                    min="1" 
                                    required>
                                </div>

                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure:<span class="req">*</span></label>
                                <input type="text" id="blood_pressure" name="blood_pressure" value="<?php echo $row['blood_pressure']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="remarks_type">Remarks:</label>
                                <textarea id="remarks_type" name="remarks_type"><?php echo $row['remarks_type']; ?></textarea>
                            </div>
                            <div class="form-group"> 
                                <div class="button-container"> 
                                    <button type="submit" class="submit-btn">
                                        Update Record
                                    </button> 
                                </div> 
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <style>
    body {
        overflow-x: hidden;
        background-color: #CDE8E5;
    }
    .content-wrap {
        padding: 20px;
    }
    .main {
        margin: 0 auto;
        max-width: auto;
    }
    #header-row {
        padding: 20px 0;
    }
    /* .title-page h7 {
        font-size: 1rem;
        color: #333;
    } */
    .title-page h3 {
        font-size: 1.5rem;
        margin-top: 10px;
    }
    .form-container {
        padding: 20px;
        background-color: #f9f9fd;
        box-shadow: 0px 0px 2px gray;
        border-radius: 10px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .req {
        color: red;
    }
    textarea, input, select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0px 0px 2px gray;
    }
.button-container { 
    display: flex; 
    justify-content: flex-end; /* Align the button to the right */ 
}
    .submit-btn {
        padding: 10px 40px;
        border: none;
        box-shadow: 0px 0px 3px gray;
        color: white;
        background-color: rgb(92, 84, 243);
        border-radius: 10px;
        margin-top: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .submit-btn:hover {
        background-color: #4D869C;
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
    </script>

    <!-- Script imports -->
    <script src="../js/lib/jquery.min.js"></script>
    <script src="../js/lib/jquery.nanoscroller.min.js"></script>
    <script src="../js/lib/menubar/sidebar.js"></script>
    <script src="../js/lib/preloader/pace.min.js"></script>
    <script src="../js/scripts.js"></script>
    <script>
    // Function to make fields readonly if they have pre-filled values
    function makeFieldsReadonlyIfNotEmpty() {
        const inputs = document.querySelectorAll("input[type='text'], input[type='date']");
        inputs.forEach(input => {
            if (input.value.trim() !== "") {
                input.setAttribute("readonly", "readonly");
            } else {
                input.removeAttribute("readonly");
            }
        });
    }

    // Run the function when the page loads
    window.onload = makeFieldsReadonlyIfNotEmpty;

    // Optional: Make all fields editable again if needed
    function enableFields() {
        const inputs = document.querySelectorAll("input[readonly]");
        inputs.forEach(input => {
            input.removeAttribute("readonly");
        });
    }
</script>
</body>
</html>
