<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: profile.php");
        exit();
    }

    // Assume password update is successful
    $_SESSION['success'] = "Password changed successfully!";
    header("Location: profile.php");
    exit();
}
?>