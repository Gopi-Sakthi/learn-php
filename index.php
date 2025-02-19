<?php
session_start();
require_once 'controller/RegisterController.php';
require_once 'controller/LoginController.php';
require_once 'controller/LogoutController.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

if ($action == 'register') {
    $registerController = new RegisterController();
    $registerController->handleRegister();
} elseif ($action == 'login') {
    $loginController = new LoginController();
    $loginController->handleLogin();
} elseif ($action == 'logout') {
    $logoutController = new LogoutController();
    $logoutController->logoutUser();
} else {
    // Default Home Page with register/login options
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        echo '<h2>Welcome, ' . $_SESSION['email'] . '!</h2>';
        echo '<a href="index.php?action=logout">Logout</a>';
        echo '<a href="welcome.php">Go to Welcome Page</a>';
    } else {
        echo '<h2>Welcome! Please choose an option:</h2>';
        echo '<a href="index.php?action=register">Register</a><br>';
        echo '<a href="index.php?action=login">Login</a>';
    }
}
?>
