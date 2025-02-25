<?php
session_start();
require 'config/connection.php';

if (!isset($_SESSION['email'])) {
    echo "No email session found!";
    exit;
}

$email = $_SESSION['email'];
$otp = rand(100000, 999999); // Generate new OTP
$expiry = date("Y-m-d H:i:s", strtotime("+2 minutes"));

// Update OTP and expiry in database
$stmt = $conn->prepare("UPDATE passenger SET otp = ?, otp_expiry = ? WHERE email = ?");
$stmt->bind_param("sss", $otp, $expiry, $email);
$stmt->execute();

// Send OTP to user (email function)
mail($email, "Your OTP Code", "Your OTP is: $otp. It will expire in 2 minutes.");

// Reset attempts
$_SESSION['otp_attempts'] = 0;

echo "New OTP sent!";
header("Location: verify_otp.php");
exit;
?>

