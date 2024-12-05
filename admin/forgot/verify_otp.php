<?php
// Set session lifetime and cookie duration
ini_set('session.gc_maxlifetime', 600);
ini_set('session.cookie_lifetime', 600);
session_start();

// Security headers
header("Content-Security-Policy: default-src 'self'");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Content-Type: application/json");

// Initialize response
$response = ["success" => false, "message" => "An error occurred."];

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "carevisio";

    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        $response["message"] = "Connection failed: " . $conn->connect_error;
        echo json_encode($response);
        exit();
    }

    // Check if session contains the OTP email
    if (isset($_SESSION['otp_email'])) {
        $email = $_SESSION['otp_email'];
        
        // Validate and process OTP input
        if (isset($_POST['otp']) && is_array($_POST['otp'])) {
            $otp_inputs = $_POST['otp'];
            $entered_otp = implode("", $otp_inputs);

            // Verify OTP and its validity
            $stmt = $conn->prepare("
                SELECT * 
                FROM otpa 
                WHERE email = ? 
                AND otp_number = ? 
                AND created_at >= NOW() - INTERVAL 10 MINUTE
            ");
            $stmt->bind_param("ss", $email, $entered_otp);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // OTP is valid
                $_SESSION['reset_email'] = $email;
                $response["success"] = true;
                $response["message"] = "OTP verified.";
            } else {
                // OTP is invalid or expired
                $response["message"] = "Invalid OTP code. Please try again.";
            }
        } else {
            $response["message"] = "Invalid OTP input format.";
        }
    } else {
        $response["message"] = "Session expired or email not set.";
    }

    // Close database connection
    $conn->close();
} else {
    $response["message"] = "Invalid request method.";
}

// Return JSON response
echo json_encode($response);
?>
