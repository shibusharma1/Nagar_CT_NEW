<?php
session_start();
require 'config.php';

if (!isset($_SESSION['otp_verified'])) {
    die("Unauthorized access!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $email = $_SESSION['email'];

        // Update password in database
        $stmt = $conn->prepare("UPDATE passengers SET password = ? WHERE email = ?");
        $stmt->execute([$hashed_password, $email]);

        session_destroy();
        header("Location: ../login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST">
        <input type="password" name="new_password" required placeholder="New Password">
        <input type="password" name="confirm_password" required placeholder="Confirm Password">
        <button type="submit">Reset Password</button>
    </form>
    <?php if (isset($_SESSION['error'])) { echo "<p style='color:red'>{$_SESSION['error']}</p>"; unset($_SESSION['error']); } ?>
</body>
</html>
