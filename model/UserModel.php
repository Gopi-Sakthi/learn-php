<?php
require_once 'config/db.php';

class UserModel {

    // Register a new user
    public function registerUser($name, $email, $password) {
        global $conn;

        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return "Email already exists!";
        }

        // Insert new user (hashing the password before saving)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        
        if ($stmt->execute()) {
            return "Registration successful!";
        }
        return "Error during registration.";
    }

    // Login user
    public function loginUser($email, $password) {
        global $conn;

        // Retrieve user from database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return "Invalid email or password.";
        }

        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            return "Login successful!";
        } else {
            return "Invalid email or password.";
        }
    }
}
?>
