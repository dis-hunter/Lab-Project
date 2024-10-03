<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = trim($_POST['otp']);
    
    // Verify OTP
    if ($entered_otp == $_SESSION['otp']) {
        // OTP matches, proceed to user creation
        require_once 'User.php';

        $user_data = $_SESSION['user_data'];
        $user = new User();

        if ($user->createUser($user_data['username'], $user_data['email'], $user_data['password'])) {
            // User created successfully
            unset($_SESSION['otp']); // Clear OTP
            unset($_SESSION['user_data']); // Clear user data
            header("Location: ViewUsers.html"); // Redirect after successful registration
            exit;
        } else {
            echo "Error registering user.";
        }
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>

<!-- OTP verification form -->
<form method="POST" action="verify_otp.php">
    <label for="otp">Enter OTP:</label>
    <input type="text" id="otp" name="otp" required>
    <button type="submit">Verify OTP</button>
</form>
