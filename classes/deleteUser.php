<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Database.php'; // Ensure your DB connection file is included
require_once 'User.php'; // Include your User model file

// Check if the id is being sent via POST
if (isset($_POST['id'])) {
    $userId = $_POST['id'];

    $user = new User();

    try {
        // Call the delete method on the User model
        $result = $user->deleteUser($userId);

        if ($result) {
            echo 'success';
        } else {
            echo 'Error deleting user';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid input data';
}
?>
