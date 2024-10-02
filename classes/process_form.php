<?php
require_once 'User.php';

class process_form {
    public function SignUp() {
        if (isset($_POST['signup'])) {
            // Debug: print the entire $_POST array
            

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

                // Create user
                $user = new User();
                if ($user->createUser($username, $email, $password)) {
                    echo "User created successfully.";
                } else {
                    echo "Error registering user.";
                }
            }
        }
    }
}

// Process form if data is submitted
$processForm = new process_form();
$processForm->SignUp();
?>
