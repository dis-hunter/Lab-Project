<?php
// Include database connection
require_once 'load.php';

try {
    $users = $User->getUsers(); // Fetch users from the database

    // Debugging: Check if $users is an array
    if (is_array($users)) {
        echo json_encode(['status' => 'success', 'users' => $users]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Returned data is not an array']);
    }

} catch (Exception $e) {
    // Handle error and return an error message
    echo json_encode(['error' => $e->getMessage()]);
}
?>
