<?php 
session_start();
include "../dbcon.php";

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: ../index.php");
    exit();
}

$resident_name = ''; // Initialize an empty variable for the resident's name

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if resident ID is set and valid
    if (isset($_POST['resident_id']) && !empty($_POST['resident_id'])) {
        $resident_id = $_POST['resident_id'];

        // Fetch resident name for display purposes
        $resident_query = "SELECT fname, mname, lname, suffix FROM residents WHERE id = '$resident_id'";
        $result = mysqli_query($conn, $resident_query);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $resident_name = $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['suffix'];
        } else {
            $resident_name = 'Resident not found';
        }

        // Collect all form data
        $bite_date = $_POST['bite_date'];
        $treatment_date = $_POST['treatment_date'];
        $bite_location = $_POST['bite_location'];
        $treatment_center = $_POST['treatment_center'];
        $remarks = $_POST['remarks'];

        // Debugging: Check if data is being posted correctly
        if (!empty($resident_id) && !empty($bite_date)) {
            // Insert data into the animal_bite_records table
            $query = "INSERT INTO animal_bite_records (resident_id, bite_date, treatment_date, bite_location, treatment_center, remarks)
                      VALUES ('$resident_id', '$bite_date', '$treatment_date', '$bite_location', '$treatment_center', '$remarks')";
            
            if (mysqli_query($conn, $query)) {
                // Redirect on success
                header("Location: ../services6.php?msg=Record added successfully");
                exit();
            } else {
                // Error handling: Display the error message for debugging
                echo "Error inserting record: " . mysqli_error($conn);
            }
        } else {
            echo "Error: Resident ID or Bite Date is missing!";
        }
    } else {
        echo "Error: No Resident ID selected!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Animal Bite Record | CareVisio</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                        <h1>Add Animal Bite Record</h1>
                    </div>
                    <div class="bc-page">
                        <ol class="bc">
                            <li class="breadcrumb-item"><a href="../home.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="../animal_bite.php">Animal Bite Records</a></li>
                            <li class="breadcrumb-item active">Add Record</li>
                        </ol>
                    </div>
                </div>

                <section id="main-content">
                    <div class="row">
                        <form method="POST" action="">
                            <label for="resident_id">Resident Name:</label>
                            <select id="resident_id" name="resident_id" class="resident-select" required>
                                <option value="">Select a Resident</option>
                                <?php
                                    // Fetch all residents to populate the dropdown
                                    $resident_query = "SELECT id, fname, mname, lname, suffix FROM residents";
                                    $residents = mysqli_query($conn, $resident_query);
                                    
                                    while ($row = mysqli_fetch_assoc($residents)) {
                                        $resident_fullname = $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['suffix'];
                                        echo "<option value='" . $row['id'] . "'>" . $resident_fullname . "</option>";
                                    }
                                ?>
                            </select><br>

                            <label for="bite_date">Bite Date:</label>
                            <input type="date" name="bite_date" required><br>

                            <label for="treatment_date">Treatment Date:</label>
                            <input type="date" name="treatment_date"><br>

                            <label for="bite_location">Bite Location:</label>
                            <input type="text" name="bite_location"><br>

                            <label for="treatment_center">Treatment Center:</label>
                            <input type="text" name="treatment_center"><br>

                            <label for="remarks">Remarks:</label>
                            <textarea name="remarks"></textarea><br>

                            <button type="submit">Add Record</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Scripts for Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 on the resident dropdown
            $('.resident-select').select2({
                placeholder: "Select or search for a resident",
                allowClear: true
            });
        });
    </script>
</body>
</html>
