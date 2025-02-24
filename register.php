<?php
session_start();
include_once 'config/connection.php'; // Include database connection
require 'mailer.php'; // Include PHPMailer file (if needed)

$errors = []; // Array to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST['name']);
  $gender = $_POST['gender'] ?? '';
  $address = trim($_POST['address']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate Name
  if (empty($name)) {
    $errors['name'] = "Name is required.";
  }

  // Validate Gender
  if (empty($gender)) {
    $errors['gender'] = "Please select your gender.";
  }

  // Validate Address
  if (empty($address)) {
    $errors['address'] = "Address is required.";
  }

  // Validate Email
  if (empty($email)) {
    $errors['email'] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format.";
  } else {
    // Check if email already exists
    $checkEmail = "SELECT id FROM passenger WHERE email = ?";
    $stmt = $conn->prepare($checkEmail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $errors['email'] = "Email already exists!";
    }

    // ✅ Free the result and close the statement properly
    $stmt->free_result();
    $stmt->close();
  }

  // Validate Password
  if (empty($password)) {
    $errors['password'] = "Password is required.";
  } elseif (strlen($password) < 8) {
    $errors['password'] = "Password must be at least 8 characters.";
  }

  // Validate Confirm Password
  if ($password !== $confirm_password) {
    $errors['confirm_password'] = "Passwords do not match.";
  }

  // If no errors, proceed with registration
  if (empty($errors)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $otp = rand(100000, 999999); // Generate OTP
    $otp_expiry = date("Y-m-d H:i:s", strtotime("+2 minutes")); // OTP expiry time

    // ✅ Insert user data with OTP
    $stmt = $conn->prepare("INSERT INTO passenger (name, gender, address, email, password, otp, otp_expiry) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $gender, $address, $email, $hashed_password, $otp, $otp_expiry);

    if ($stmt->execute()) {
      // ✅ Close statement after execution
      $stmt->close();

      // Email Sending Code - PHPMailer
      require 'vendor/autoload.php'; // If you're using Composer for PHPMailer

      $mail = new PHPMailer\PHPMailer\PHPMailer();
      try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'nagarctservices@gmail.com';                 // SMTP username
        $mail->Password = 'temf khyf vayi swpd';                    // SMTP password (Use App Password if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('nagarctservices@gmail.com', 'Nagar-CT');        // Sender's email and name
        $mail->addAddress($email, $name); // Add a recipient

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = "Welcome, $name! Verify Your Email with OTP";

        $mail->Body = "
    <div style='font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 10px;'>
        <h2 style='color: #2c3e50;'>Welcome to Nagar-CT, $name! 🎉</h2>
        <p>We're excited to have you on board. To ensure the security of your account, please verify your email using the OTP below:</p>
        
        <div style='text-align: center; font-size: 22px; font-weight: bold; background: #f3f3f3; padding: 15px; border-radius: 5px; margin: 20px 0;'>
            Your OTP Code: <span style='color: #e74c3c;'>$otp</span>
        </div>

        <p style='color: #555;'>This OTP is valid for the next <b>2 minutes</b>. Please enter it promptly to complete your verification.</p>

        <p>If you did not request this OTP, please ignore this email or contact our support team.</p>

        <hr style='border: none; border-top: 1px solid #ddd;'>

        <p style='color: #333;'><b>Best Regards,</b><br>
        Nagar-CT Team<br>
        <a href='https://www.nagarct.com' style='color: #3498db; text-decoration: none;'>www.nagarct.com</a></p>
    </div>
";

        $mail->AltBody = "Welcome to Nagar-CT, $name! Your OTP code is $otp. It will expire in 2 minutes. If you did not request this, please ignore this email.";

        // $mail->AltBody = "Your OTP code is $otp. It will expire in 2 minutes.";

        $mail->send();
        echo 'Email has been sent successfully';

      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

      //Store OTP and email in session
      $_SESSION['otp'] = $otp;
      $_SESSION['otp_expiry'] = $otp_expiry;
      $_SESSION['email'] = $email;

      //Redirect to OTP verification page
      header("Location: verify_otp"); // Redirect to OTP verification
      exit();
    } else {
      echo "Error: " . $stmt->error;
    }
  }

  //Close database connection at the end
  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <link rel="icon" href="assets/logo.jpg" type="image/x-icon"> -->
  <link rel="icon" type="image/png" sizes="64x64" href="assets/logo1.png" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="register_style.css" />
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <title>Nagar-CT | Register</title>
</head>

<body>
  <img class="wave" src="assets/wave.png">
  <div class="container">

    <div class="img">
      <img src="assets/bg.svg">
    </div>

    <div class="login-content">

      <!-- <form action="" method="POST" class="sign-in-form"> -->
      <form action="" method="POST" class="sign-in-form" onsubmit="return validateForm()">

        <div class="first">

          <h2 class="title">Sign Up</h2>

          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
              required />
            <div class="error">
              <small class="error"><?= $errors['name'] ?? '' ?></small>
            </div>

          </div>

          <div class="input-field">
            <label for="gender"><i class="fas fa-venus-mars"></i></label>
            <select id="gender" name="gender"
              style="background: none; border: none; outline: none;font-size: 1.1rem; color: #2E6A50; width: 100%;">
              <!-- <option value="" disabled selected>Select your Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option> -->
              <option value="" disabled <?= empty($_POST['gender']) ? 'selected' : '' ?>>Select your Gender</option>
              <option value="male" <?= ($_POST['gender'] ?? '') == 'male' ? 'selected' : '' ?>>Male</option>
              <option value="female" <?= ($_POST['gender'] ?? '') == 'female' ? 'selected' : '' ?>>Female</option>
              <option value="other" <?= ($_POST['gender'] ?? '') == 'other' ? 'selected' : '' ?>>Other</option>
            </select>
          </div>

          <div class="input-field">
            <i class="fas fa-address-card"></i>
            <input type="text" placeholder="address" name="address"
              value="<?= htmlspecialchars($_POST['address'] ?? '') ?>" required />
            <div class="error">
              <small class="error"><?= $errors['address'] ?? '' ?></small>
            </div>

          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
              required />
            <div class="error">
              <small class="error"><?= $errors['email'] ?? '' ?></small>
            </div>
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" required />
            <div class="error">
              <small class="error"><?= $errors['password'] ?? '' ?></small>
            </div>
          </div>
          <div class="input-field">
            <i class="fas fa-check"></i>
            <input type="password" placeholder="Confirm Password" name="confirm_password" required />
            <div class="error">
              <small class="error"><?= $errors['confirm_password'] ?? '' ?></small>
            </div>
          </div>
          <button type="submit" class="btn solid">
            Register <i class="fas fa-arrow-right"></i>
          </button>
          <p class="social-text">Already have Account? Sign in <a href="login">here</a></p>
          <p class="social-text">Or Sign in with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    function validateForm() {
      let isValid = true;
      document.querySelectorAll(".error").forEach(e => e.textContent = ""); // Clear errors

      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value;
      const confirm_password = document.getElementById("confirm_password").value;

      if (name === "") {
        document.querySelector("input[name='name'] + .error").textContent = "Name is required.";
        isValid = false;
      }
      if (email === "") {
        document.querySelector("input[name='email'] + .error").textContent = "Email is required.";
        isValid = false;
      } else if (!/\S+@\S+\.\S+/.test(email)) {
        document.querySelector("input[name='email'] + .error").textContent = "Invalid email format.";
        isValid = false;
      }
      if (password.length < 6) {
        document.querySelector("input[name='password'] + .error").textContent = "Password must be at least 6 characters.";
        isValid = false;
      }
      if (password !== confirm_password) {
        document.querySelector("input[name='confirm_password'] + .error").textContent = "Passwords do not match.";
        isValid = false;
      }

      return isValid;
    }
  </script>
</body>

</html>