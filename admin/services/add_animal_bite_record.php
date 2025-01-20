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
    $animal_name = mysqli_real_escape_string($conn, $_POST['animal_name']);
    $bitten_location = mysqli_real_escape_string($conn, $_POST['bitten_location']);
    $bite_date = mysqli_real_escape_string($conn, $_POST['bite_date']);
    $treatment_date = mysqli_real_escape_string($conn, $_POST['treatment_date']);
    $bite_location = mysqli_real_escape_string($conn, $_POST['bite_location']);
    $treatment_center = mysqli_real_escape_string($conn, $_POST['treatment_center']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    // Validate required fields
    if (!empty($resident_id) && !empty($animal_name) && !empty($bitten_location) && 
        !empty($bite_date) && !empty($treatment_date) && !empty($bite_location) && !empty($treatment_center)) {
        
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO animal_bite_records (resident_id, animal_name, bitten_location, bite_date, treatment_date, bite_location, treatment_center, remarks) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $resident_id, $animal_name, $bitten_location, $bite_date, $treatment_date, $bite_location, $treatment_center, $remarks);

        if ($stmt->execute()) {
            // Redirect to animal bite records page after successful insertion
            $_SESSION['message'] = "Animal Bite Record added successfully!";
            header("Location: ../services6.php");
            exit();
        } else {
            // Handle SQL error
            $_SESSION['error'] = "Error adding record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Handle missing required fields
        $_SESSION['error'] = "Please fill in all the required fields.";
    }

    // Redirect back to the form with an error message
    header("Location: services6.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
