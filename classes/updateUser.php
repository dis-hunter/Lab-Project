<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Database.php'; // Ensure your DB connection file is included
require_once 'User.php'; // Include your User model file

// Check if data is being sent via POST
if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email'])) {
    $userId = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $user = new User();

    try {
        // Call the update method on the User model
        $result = $user->updateUser($userId, $username, $email);
        
        if ($result) {
            echo 'success';
        } else {
            echo 'Error updating user';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid input data';
}
?>
