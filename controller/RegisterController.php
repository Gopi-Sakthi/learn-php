<?php
require_once 'model/UserModel.php';

class RegisterController {

    // Handle the registration form submission
    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $message = $userModel->registerUser($name, $email, $password);
            echo $message;
            // Optionally, after registration, show login form
            if ($message === 'Registration successful!') {
                echo '<a href="index.php?action=login">Login Now</a>';
            }
        } else {
            // If no POST, show the registration form
            include 'view/register.php';
        }
    }
}
?>
