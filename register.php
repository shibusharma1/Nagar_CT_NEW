<?php
include_once 'config/connection.php'; // Include your database connection file

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
    $stmt->close();
  }

  // Validate Password
  if (empty($password)) {
    $errors['password'] = "Password is required.";
  } elseif (strlen($password) < 6) {
    $errors['password'] = "Password must be at least 6 characters.";
  }

  // Validate Confirm Password
  if ($password !== $confirm_password) {
    $errors['confirm_password'] = "Passwords do not match.";
  }

  // If no errors, proceed with registration
  if (empty($errors)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO passenger (name, gender, address, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $gender, $address, $email, $hashed_password);

    if ($stmt->execute()) {
      header("Location: login");
      exit();
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  }
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