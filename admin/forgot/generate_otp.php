<?php
session_start();

// Security Headers
header("Content-Security-Policy: default-src 'self'");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");

// Include PHPMailer classes
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "carevisio";

    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        header("Location: Forgot.html?error=" . urlencode("Database connection failed."));
        exit();
    }

    // Sanitize and validate email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: Forgot.html?error=" . urlencode("Invalid email format."));
        exit();
    }

    // Check if email exists in `administrator` table
    $stmt = $conn->prepare("SELECT * FROM administrator WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate OTP
        $otp = generateOTP();

        // Insert OTP into `otpa` table
        $stmt = $conn->prepare("INSERT INTO otpa (email, otp_number, created_at) VALUES (?, ?, NOW()) 
                                ON DUPLICATE KEY UPDATE otp_number = VALUES(otp_number), created_at = NOW()");
        $stmt->bind_param("ss", $email, $otp);

        if ($stmt->execute()) {
            $stmt->close();

            // Store email in session
            $_SESSION['otp_email'] = $email;

            // Send OTP via email
            if (sendOTPEmail($email, $otp)) {
                header("Location: otp.html?email=" . urlencode($email));
                exit();
            } else {
                header("Location: Forgot.html?error=" . urlencode("Failed to send OTP email. Please try again."));
                exit();
            }
        } else {
            header("Location: Forgot.html?error=" . urlencode("Failed to save OTP. Please try again."));
            exit();
        }
    } else {
        header("Location: Forgot.html?error=" . urlencode("Email not found in our records."));
        exit();
    }

    $conn->close();
}

/**
 * Generate a 6-digit OTP
 */
function generateOTP() {
    return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT); // Ensures a 6-digit OTP
}

/**
 * Send OTP email using PHPMailer
 */
function sendOTPEmail($email, $otp) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'techcare4ever@gmail.com';
        $mail->Password   = 'clortcmydzqkaxfh'; // Use an app-specific password for security
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Email settings
        $mail->setFrom('techcare4ever@gmail.com', 'TechCare');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP code is <b>$otp</b>. It will expire in 15 minutes.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log error for debugging
        error_log("Failed to send email: " . $mail->ErrorInfo);
        return false;
    }
}
?>
