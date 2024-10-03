<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #5cb85c;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>OTP Verification</h2>

        <?php
        session_start(); // Start the session

        // Check if OTP exists in the session
        if (!isset($_SESSION['otp'])) {
            echo "<p class='error'>No OTP found. Please request a new one.</p>";
            exit;
        }

        // Debugging: Output the session OTP and the entered OTP
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $entered_otp = trim($_POST['otp']);
            
            // Debugging output
            echo "Entered OTP: $entered_otp<br>";
            echo "Session OTP: " . $_SESSION['otp'] . "<br>";

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
                    echo "<p class='error'>Error registering user.</p>";
                }
            } else {
                echo "<p class='error'>Invalid OTP. Please try again.</p>";
            }
        }
        ?>

        <!-- OTP verification form -->
        <form method="POST" action="verify_otp.php">
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" name="otp" required>
            <button type="submit">Verify OTP</button>
        </form>
    </div>
</body>
</html>
