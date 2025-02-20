<?php
session_start();
require_once ('config/connection.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = mysqli_real_escape_string($conn, $_POST['old-password']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['new-password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm-password']);
    
    // Assuming user is logged in and has a session user ID
    if (!isset($_SESSION['uid'])) {
        header("Location: login.php");
        exit();
    }
    
    $userId = $_SESSION['uid'];
    
    // Fetch current password from database
    $query = "SELECT password FROM users WHERE id='$userId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    if (password_verify($oldPassword, $row['password'])) {
        if ($newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updateQuery = "UPDATE users SET password='$hashedPassword' WHERE id='$userId'";
            if (mysqli_query($conn, $updateQuery)) {
                $_SESSION['success'] = "Password successfully updated!";
            } else {
                $_SESSION['error'] = "Error updating password. Please try again.";
            }
        } else {
            $_SESSION['error'] = "New passwords do not match!";
        }
    } else {
        $_SESSION['error'] = "Old password is incorrect!";
    }
    header("Location: passreset.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="assets/css/passreset.css">
</head>
<body>
    <div class="pass-reset">
        <form action="" method="post">
            <h2>Password Reset</h2>
            <?php if (isset($_SESSION['error'])): ?>
                <p style="color: red;"> <?= $_SESSION['error']; unset($_SESSION['error']); ?> </p>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                <p style="color: green;"> <?= $_SESSION['success']; unset($_SESSION['success']); ?> </p>
            <?php endif; ?>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="old-password" placeholder="Old Password" required>
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="new-password" placeholder="New Password" required>
            </div>
            <div class="input-field">
                <i class="fas fa-check"></i>
                <input type="password" name="confirm-password" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>
    </div>
</body>
</html>
