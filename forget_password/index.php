<?php
session_start();
require '../config/connection.php'; // Ensure this uses MySQLi connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM passenger WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Send OTP email
        $subject = "Your Password Reset OTP";
        $message = "Your OTP code is: <b>$otp</b>. It expires in 5 minutes.";
        require 'mailer.php';
        sendMail($email, $subject, $message);

        header("Location: verify_otp.php");
        exit();
    } else {
        $_SESSION['error'] = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="POST">
        <input type="email" name="email" required placeholder="Enter your email">
        <button type="submit">Send OTP</button>
    </form>
    <?php if (isset($_SESSION['error'])) { echo "<p style='color:red'>{$_SESSION['error']}</p>"; unset($_SESSION['error']); } ?>
</body>
</html>
