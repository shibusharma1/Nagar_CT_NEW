<?php
session_start();
require 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $entered_otp = $_POST['otp'];

    // Fetch OTP details from DB
    $stmt = $conn->prepare("SELECT otp, otp_expiry FROM passenger WHERE email = ? AND is_verified = 0");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $stored_otp = $user['otp'];
        $otp_expiry = $user['otp_expiry'];

        // Check if OTP matches and is not expired
        if ($entered_otp == $stored_otp && strtotime($otp_expiry) >= time()) {
            // Update user as verified
            $update = $conn->prepare("UPDATE passenger SET is_verified = 1, otp = NULL, otp_expiry = NULL WHERE email = ?");
            $update->bind_param("s", $email);
            $update->execute();

            echo "OTP verified! Registration complete.";
            header("Location: login");

        } else {
            echo "Invalid or expired OTP!";
        }
    } else {
        echo "User not found or already verified.";
        
    }
}
?>
