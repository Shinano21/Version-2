<?php
session_start();
include "../dbcon.php"; // Database connection

// Check if the user is logged in and not a System Administrator
if (!isset($_SESSION["user"]) || $_SESSION["user_type"] == "System Administrator") {
    header("Location: index.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $resident_id = mysqli_real_escape_string($conn, $_POST['resident_name']);
      $bitten_location = mysqli_real_escape_string($conn, $_POST['bitten_location']);  // New field
    $bite_date = mysqli_real_escape_string($conn, $_POST['bite_date']);
    $treatment_date = mysqli_real_escape_string($conn, $_POST['treatment_date']);
    $bite_location = mysqli_real_escape_string($conn, $_POST['bite_location']);
    $treatment_center = mysqli_real_escape_string($conn, $_POST['treatment_center']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    // Validate required fields
    if (!empty($resident_id) && !empty($bite_date) && !empty($treatment_date) && !empty($bite_location) && !empty($treatment_center)) {
        // Prepare and execute SQL query to insert the new record
       // Prepare and execute SQL query to insert the new record, including bitten_location
$query = "INSERT INTO animal_bite_records (resident_id, bite_date, treatment_date, bite_location, bitten_location, treatment_center, remarks) 
          VALUES ('$resident_id', '$bite_date', '$treatment_date', '$bite_location', '$bitten_location', '$treatment_center', '$remarks')";


        if (mysqli_query($conn, $query)) {
            // Redirect to animal bite records page after successful insertion
            $_SESSION['message'] = "Animal Bite Record added successfully!";
            header("Location: ../services6.php");
            exit();
        } else {
            // Handle SQL error
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        // Handle missing required fields
        $_SESSION['error'] = "Please fill in all the required fields.";
        header("Location: services6.php");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
