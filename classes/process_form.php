<?php
require_once 'User.php';
session_start(); // Start session to store OTP

class process_form {
    public function SignUp() {
        if (isset($_POST['signup'])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Capture form data
                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $confirm_password = trim($_POST['confirm_password']);
                $remember_me = isset($_POST['remember_me']) ? true : false;

                // Validate inputs
                if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                    die("Please fill in all fields.");
                }

                if ($password !== $confirm_password) {
                    die("Passwords do not match.");
                }

                // Generate OTP
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp; // Store OTP in session
                $_SESSION['user_data'] = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password
                ];

                // Send OTP via email (you can replace this with PHPMailer or other mail libraries)
                $subject = "Your OTP Code";
                $message = "Your OTP code is: " . $otp;
                $headers = "From: noreply@yourwebsite.com"; // Replace with your domain
                if (mail($email, $subject, $message, $headers)) {
                    header("Location: verify_otp.php"); // Redirect to OTP verification page
                    exit;
                } else {
                    echo "Failed to send OTP. Please try again.";
                }
            }
        }
    }
}

// Process form if data is submitted
$processForm = new process_form();
$processForm->SignUp();
?>
