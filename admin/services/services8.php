<?php
session_start();
include "dbcon.php";

// Redirect if user is not logged in or user type is System Administrator
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
    <title>Add Hypertension Record | CareVisio</title>
    <?php include "partials/head.php"; ?>
    <link rel="stylesheet" href="css/tables.css"> <!-- Ensure to have styles for tables -->
</head>
<body onload="display_ct();">

    <?php
        if ($_SESSION["user_type"] == "System Administrator") {
            include "partials/admin_sidebar.php";
        } else {
            include "partials/sidebar.php";
        }
    ?>
    <?php include "partials/header.php" ?>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row" id="header-row">
                    <div class="title-page">
                        <h1>Hypertension Record</h1>
                        <h6>Add New Hypertension Record</h6>
                    </div>
                </div>

                <section id="main-content">
                    <div class="form-container">
                        <form action="addHypertension.php" method="POST">
                            <div class="form-group">
                                <label for="resident_id">Resident ID:</label>
                                <input type="number" id="resident_id" name="resident_id" required>
                            </div>
                            <div class="form-group">
                                <label for="checkup_date">Checkup Date:</label>
                                <input type="date" id="checkup_date" name="checkup_date" required>
                            </div>
                            <div class="form-group">
                                <label for="medicine_type">Medicine Type:</label>
                                <input type="text" id="medicine_type" name="medicine_type">
                            </div>
                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure:</label>
                                <input type="text" id="blood_pressure" name="blood_pressure">
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

                    <!-- Displaying Records -->
                    <div class="record-display">
                        <h2>Hypertension Records</h2>
                        <table class="table-records">
                            <thead>
                                <tr>
                                    <th>Resident ID</th>
                                    <th>Checkup Date</th>
                                    <th>Medicine Type</th>
                                    <th>Blood Pressure</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include "data/showHypertension.php"; ?> <!-- Fetch and display hypertension records -->
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="js/scripts.js"></script> <!-- Link your JS file -->
</body>
</html>

<!-- <?php 
session_start();
include "../dbcon.php";

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: ../index.php");
    exit();
}

$resident_name = ''; // Initialize an empty variable for the resident's name

// Fetch resident name based on resident ID
if (isset($_POST['resident_id']) && !empty($_POST['resident_id'])) {
    $resident_id = $_POST['resident_id'];
    $resident_query = "SELECT fname, mname, lname, suffix FROM residents WHERE id = '$resident_id'";
    $result = mysqli_query($conn, $resident_query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $resident_name = $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['suffix'];
    } else {
        $resident_name = 'Resident not found';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($resident_name)) {
    $resident_id = $_POST['resident_id'];
    $bite_date = $_POST['bite_date'];
    $treatment_date = $_POST['treatment_date'];
    $bite_location = $_POST['bite_location'];
    $treatment_center = $_POST['treatment_center'];
    $remarks = $_POST['remarks'];

    $query = "INSERT INTO animal_bite_records (resident_id, bite_date, treatment_date, bite_location, treatment_center, remarks)
              VALUES ('$resident_id', '$bite_date', '$treatment_date', '$bite_location', '$treatment_center', '$remarks')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../animal_bite.php?msg=Record added successfully");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
<!--  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Animal Bite Record | CareVisio</title>
    <?php include "../partials/head.php"; ?>
    <link rel="stylesheet" href="../css/tables.css">
</head>

<body>
    <?php include "../partials/sidebar.php"; ?>
    <?php include "../partials/header.php"; ?>

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
                        <form method="POST">
                            <label for="resident_id">Resident ID:</label>
                            <input type="text" name="resident_id" value="<?php echo isset($_POST['resident_id']) ? $_POST['resident_id'] : ''; ?>" required><br>
                            

                            <label for="resident_name">Resident Name:</label>
                            <input type="text" name="resident_name" value="<?php echo $resident_name; ?>" disabled><br>

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

    <?php include "../partials/scripts.php"; ?>
</body>
</html>
 -->