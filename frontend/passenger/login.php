<?php
session_start();
require_once('config/connection.php');

// Get the client's IP address and device name
$ipAddress = $_SERVER['REMOTE_ADDR'];
$deviceName = gethostbyaddr($ipAddress);
$detail = "$deviceName is trying to access Admin Panel and its IP Address is $ipAddress. If this is not you, please modify the Admin Credentials via Code.";
$title = "Admin Login";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = stripcslashes($_POST['email']);
  $password = $_POST['password'];
  $email = mysqli_real_escape_string($conn, $email);

  // Fetch user details
  $sql = "SELECT * FROM passanger WHERE email = '$email'";
  $sresult = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($sresult);

  if ($row && password_verify($password, $row['password'])) {
    $_SESSION['login_success'] = true;
    // $_SESSION['role'] = $row['role'];
    header("Location: index.php");
    exit();
  } else {
    $_SESSION['login_error'] = true;
    $error_message = "Invalid Credentials";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../assets/logo.jpg" type="image/x-icon">
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="register_style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <title>Nagar-CT | Login</title>
  <style>
    .password-container {
      position: relative;
      width: 100%;
    }
    .password-container input {
      width: 100%;
      padding-right: 40px;
    }
    .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
    }
  </style>
</head>
<body>
  <img class="wave" src="assets/wave.png">
  <div class="container">
    <div class="img">
      <img src="assets/bg.svg">
    </div>
    <div class="login-content">
      <form action="" method="POST" class="sign-in-form">
        <div class="first">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Email" name="email" required>
          </div>

          <div class="input-field password-container">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
          </div>

          <?php if (isset($error_message)): ?>
            <p style="color:red; text-align:center; font-size: 0.9rem;"> <?= $error_message ?> </p>
          <?php endif; ?>

          <div class="remember-forget" style="display:flex;flex-direction:row;justify-content: space-between;">
            <div class="remember">
            <label><input type="checkbox"> Remember me</label>
            </div>
            <div class="forget-password">
            <a href="forgetpassword">Forgot password?</a>
            </div>
          </div>

          <button type="submit" class="btn solid">Login <i class="fas fa-arrow-right"></i></button>
          <p class="social-text">Or Sign in with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
          </div>
          <p>Don't have an account? <a href="register">Register</a></p>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById("password");
      const toggleIcon = document.querySelector(".toggle-password");
      
      if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
      } else {
        passwordField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
      }
    }
  </script>
</body>
</html>

<?php include_once 'includes/footer.php'; ?>
