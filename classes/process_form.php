<?php
session_start(); // Start the session
require 'C:/xampp/htdocs/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/PHPMailer/src/SMTP.php';
require 'C:/xampp/htdocs/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
                $_SESSION['otp'] = $otp;
                $_SESSION['user_data'] = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password
                ];

                // Send OTP via PHPMailer
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->isSMTP();                                           // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                      // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
                    $mail->Username   = 'eoringe372@gmail.com';                // SMTP username
                    $mail->Password   = 'wdjk opaf jhdx wjjr';                 // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                    $mail->Port       = 587;                                   // TCP port to connect to

                    //Recipients
                    $mail->setFrom('eoringe372@gmail.com', 'Emmanuel\'s Website');
                    $mail->addAddress($email);                                 // Add the recipient's email address

                    // Content
                    $mail->isHTML(true);                                       // Set email format to HTML
                    $mail->Subject = 'Your OTP Code';
                    $mail->Body    = 'Your OTP code is: ' . $otp;

                    $mail->send();
                    header("Location: verify_otp.php");
                    exit;
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
}

$processForm = new process_form();
$processForm->SignUp();
