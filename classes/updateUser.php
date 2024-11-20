<?php



require_once 'load.php';

// Check if data is being sent via POST
if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email'])) {
    $userId = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

   

    try {
        // Call the update method on the User model
        $result = $User->updateUser($userId, $username, $email);
        
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
