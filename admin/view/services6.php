<?php
session_start();

include "../dbcon.php";  // Database connection

// Ensure the user is authenticated and not a System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Get the record ID from the URL (assuming it's passed as a GET parameter)
$record_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($record_id <= 0) {
    echo "Invalid record ID.";
    exit();
}

// Handle form submission
if (isset($_POST['update_bite_record'])) {
    $resident_id = mysqli_real_escape_string($conn, $_POST['resident_name']);
    $bite_date = mysqli_real_escape_string($conn, $_POST['bite_date']);
    $animal_name = mysqli_real_escape_string($conn, $_POST['animal_name']);
    $treatment_date = mysqli_real_escape_string($conn, $_POST['treatment_date']);
    $bite_location = mysqli_real_escape_string($conn, $_POST['bite_location']);
    $bitten_location = mysqli_real_escape_string($conn, $_POST['bitten_location']); // Added bitten_location
    $treatment_center = mysqli_real_escape_string($conn, $_POST['treatment_center']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    // Update the animal bite record in the database
    $update_query = "
        UPDATE animal_bite_records 
        SET resident_id = '$resident_id', bite_date = '$bite_date', animal_name = '$animal_name', treatment_date = '$treatment_date', 
            bite_location = '$bite_location', bitten_location = '$bitten_location', treatment_center = '$treatment_center', remarks = '$remarks' 
        WHERE id = $record_id";


    if (mysqli_query($conn, $update_query)) {
        // Redirect after successful update
        header("Location: ../services6.php?success=1");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Query to fetch the existing record data based on the ID
$record_query = "SELECT * FROM animal_bite_records WHERE id = $record_id";
$record_result = mysqli_query($conn, $record_query);

if (mysqli_num_rows($record_result) == 0) {
    echo "Record not found.";
    exit();
}

$record = mysqli_fetch_assoc($record_result);

// Query to fetch residents for the dropdown
$residents_query = "SELECT id, fname, lname FROM residents";
$residents_result = mysqli_query($conn, $residents_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-name" content="focus" />
    <title>Update Animal Bite Record | CareVisio</title>
    <?php include "../services/head.php"; ?>
</head>

<body onload="display_ct();">

    <?php include "../services/header.php"; ?>
    <?php include "../services/sidebar.php"; ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <a href="../services6.php">
                                    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Animal Bite Records</h7>
                                </a>
                                <h1>Update Animal Bite Record</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="../home.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Services</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <section id="main-content">
                    <form action="services6.php?id=<?php echo $record_id; ?>" method="post">
                        <div class="row">
                            <div class="sectioning">
                                <br>
                                <p>Please fill out all fields marked by asterisks (<span class="req">*</span>)</p>
                                <hr>
                                <table>
                                    <tr>
                                        <th><b>Resident Name<span class="req">*</span></b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="resident_name">Resident Name<span class="req">*</span></label><br>
                                            <select name="resident_name" id="resident_name" required>
                                                <option value="">Select Resident</option>
                                                <?php
                                                // Populate the dropdown and select the current resident
                                                while($row = mysqli_fetch_assoc($residents_result)) {
                                                    $selected = ($row['id'] == $record['resident_id']) ? 'selected' : '';
                                                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['fname'] . ' ' . $row['lname'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </th>
                                        <th>
                                        <label for="bitten_location">Bitten Location (Place where you get bitten)<span class="req">*</span></label><br>
                                        <input type="text" name="bitten_location" id="bitten_location" value="<?php echo $record['bitten_location']; ?>" placeholder="ex: purok 1" required>
                                    </th>
                                    </tr>
                                    <tr>
                                        <th><b>Bite Details</b></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="bite_date">Bite Date<span class="req">*</span></label><br>
                                            <input type="date" name="bite_date" id="bite_date" value="<?php echo $record['bite_date']; ?>" required>
                                        </th>
                                        <th>
                                            <label for="animal_name">Animal Name<span class="req">*</span></label><br>
                                            <input type="text" name="animal_name" id="animal_name" placeholder="ex: Dog" value="<?php echo $record['animal_name']; ?>" required>
                                            </th>
                                        </th>
                                        <th>
                                            <label for="treatment_date">Treatment Date<span class="req">*</span></label><br>
                                            <input type="date" name="treatment_date" id="treatment_date" value="<?php echo $record['treatment_date']; ?>" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="bite_location">Bite Location<span class="req">*</span></label><br>
                                            <input type="text" name="bite_location" id="bite_location" value="<?php echo $record['bite_location']; ?>" required>
                                        </th>
                                        <th>
                                            <label for="treatment_center">Treatment Center<span class="req">*</span></label><br>
                                            <input type="text" name="treatment_center" id="treatment_center" value="<?php echo $record['treatment_center']; ?>" required>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="remarks">Remarks</label><br>
                                            <textarea name="remarks" id="remarks"><?php echo $record['remarks']; ?></textarea>
                                        </th>
                                    </tr>
                                </table>
                                <br>
                                <button type="submit" name="update_bite_record">Update</button>
                                <br><br>
                                <hr>
                            </div>
                        </div>

                        <style>
                            body {
                                overflow-x: hidden;
               background-color: #CDE8E5;

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
