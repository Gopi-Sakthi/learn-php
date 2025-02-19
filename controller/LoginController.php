<?php
require_once 'model/UserModel.php';

class LoginController {

    // Handle the login form submission
    public function handleLogin() {
        session_start(); // Start session to track logged-in status

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $message = $userModel->loginUser($email, $password);
            if ($message === 'Login successful!') {
                // Set session variable for logged-in user
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $email;

                // Redirect to welcome page
                header('Location: welcome.php');
                exit;
            } else {
                echo $message;
            }
        } else {
            // If no POST, show the login form
            include 'view/login.php';
        }
    }
}
?>
