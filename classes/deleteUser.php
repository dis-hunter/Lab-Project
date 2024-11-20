<?php
require_once 'load.php';

// Check if the id is being sent via POST
if (isset($_POST['id'])) {
    $userId = $_POST['id'];

   

    try {
        // Call the delete method on the User model
        $result = $User->deleteUser($userId);

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
