<?php
session_start();
require 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $entered_otp = $_POST['otp'];

    // Fetch OTP details from DB
    $stmt = $conn->prepare("SELECT * FROM passenger WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $name = $user['name'];
        $email = $user['email'];
        $stored_otp = $user['otp'];
        $otp_expiry = $user['otp_expiry'];
        $is_verified = $user['is_verified'];


        // If already verified
        if ($is_verified == 1) {
            echo "User already verified!";
            exit;
        }

        // Check if OTP matches and is not expired
        if ($entered_otp == $stored_otp && strtotime($otp_expiry) >= time()) {
            // Mark user as verified
            $update = $conn->prepare("UPDATE passenger SET is_verified = 1, otp = NULL, otp_expiry = NULL WHERE email = ?");
            $update->bind_param("s", $email);
            $update->execute();

            // echo "OTP verified! Registration complete.";

            // Email Sending Code - PHPMailer
            require 'vendor/autoload.php'; // If you're using Composer for PHPMailer

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            try {
                // Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host = 'smtp.gmail.com';                       // Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   // Enable SMTP authentication
                $mail->Username = 'nagarctservices@gmail.com';                 // SMTP username
                $mail->Password = 'gnpl gqhu pukx gmal';                    // SMTP password (Use App Password if 2FA is enabled)
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587;                                    // TCP port to connect to

                // Recipients
                $mail->setFrom('nagarctservices@gmail.com', 'NAGAR-CT');        // Sender's email and name
                $mail->addAddress($email, $name); // Add a recipient

                // Content
                $mail->isHTML(true);                                        // Set email format to HTML
                $mail->Subject = "Welcome, $name! Verify Your Email with OTP";

                $mail->Body = "
    <div style='font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 10px;'>
        <h2 style='color: #2c3e50;'>Welcome to Nagar-CT, $name! 🎉</h2>
        <p>Congratulations! Your account has been successfully created on <b>Nagar-CT</b>.</p>
        
        <div style='text-align: center; font-size: 20px; font-weight: bold; background: #f3f3f3; padding: 15px; border-radius: 5px; margin: 20px 0;'>
            You can now log in using your registered email: <span style='color: #e74c3c;'>$email</span>
        </div>

        <p style='color: #555;'>Get started by logging into your account and exploring our services.</p>

        <div style='text-align: center; margin: 20px 0;'>
            <a href='http://localhost/Nagar-CT/login' style='background: #3498db; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;'>Login to Your Account</a>
        </div>

        <p>If you have any questions or need assistance, feel free to contact our support team.</p>

        <hr style='border: none; border-top: 1px solid #ddd;'>

        <p style='color: #333;'><b>Best Regards,</b><br>
        Nagar-CT Team<br>
        <a href='https://www.nagarct.com' style='color: #3498db; text-decoration: none;'>www.nagarct.com</a></p>
    </div>
";

                $mail->AltBody = "Welcome to Nagar-CT, $name! Your account has been successfully created. You can now log in using your email: $email. Visit https://www.nagarct.com/login to access your account.";


                // $mail->AltBody = "Welcome to Nagar-CT, $name! Your OTP code is $otp. It will expire in 2 minutes. If you did not request this, please ignore this email.";

                // $mail->AltBody = "Your OTP code is $otp. It will expire in 2 minutes.";

                $mail->send();
                echo 'Email has been sent successfully';

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            header("Location: login");
            exit;
        } else {
            // Track incorrect attempts
            $_SESSION['otp_attempts'] = isset($_SESSION['otp_attempts']) ? $_SESSION['otp_attempts'] + 1 : 1;

            if ($_SESSION['otp_attempts'] >= 3) {
                // Delete user record after 3 failed attempts
                $delete = $conn->prepare("DELETE FROM passenger WHERE email = ?");
                $delete->bind_param("s", $email);
                $delete->execute();

                echo "Too many failed attempts. Registration removed!";
                session_destroy();
                exit;
            }

            echo "Invalid or expired OTP!";
        }
    } else {
        echo "User not found!";
    }
}
?>