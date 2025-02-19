<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
    header('Location: index.php');
    exit;
}

echo '<h2>Welcome, ' . $_SESSION['email'] . '!</h2>';
echo '<p>You have successfully logged in.</p>';
echo '<a href="index.php?action=logout">Logout</a>';
?>
