<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Database.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection(); // Correctly assign connection to $this->conn
    }

    // Create a new user
    public function createUser($username, $email, $password) {
        $query = "INSERT INTO clients (email, username, password) VALUES (:email, :username, :password)";
        $stmt = $this->conn->prepare($query);

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Binding parameters
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get all users
    public function getUsers() {
        try {
            // Prepare the SQL statement to fetch users
            $stmt = $this->conn->prepare("SELECT id, username, email FROM clients");
            $stmt->execute();

            // Fetch all results as an associative array
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if the result is an array
            if (is_array($users)) {
                return $users; // Return users as an array
            } else {
                throw new Exception('Data retrieved is not an array.');
            }

        } catch (PDOException $e) {
            // Handle database connection/query errors
            throw new Exception("Database query failed: " . $e->getMessage());
        }
    }

    // Update user information (only email and username)
    public function updateUser($id, $username, $email) {
        $query = "UPDATE clients SET username = :username, email = :email WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);

        // Execute the query and return the result
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete user by id
    public function deleteUser($id) {
        $query = "DELETE FROM clients WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind id parameter
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
