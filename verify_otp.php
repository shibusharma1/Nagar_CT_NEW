<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h2>Enter OTP</h2>
    <form action="verify_otp_process.php" method="POST">
        <input type="text" name="otp" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
