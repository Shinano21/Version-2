<?php
session_start();
include "../dbcon.php";

if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Animal Bite Record</title>
    <?php include "../partials/head.php"; ?>
</head>

<body>
    <div class="container">
        <h1>Add Animal Bite Record</h1>
        <form method="POST">
            <label for="resident_id">Resident ID:</label>
            <input type="text" name="resident_id" required><br>
            
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
</body>
</html>
