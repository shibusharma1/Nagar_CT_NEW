<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Here you would update the database
    // Assume the update is successful
    $_SESSION['success'] = "Profile updated successfully!";
    header("Location: profile.php");
    exit();
}
?>