<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../../assets/logo.jpg" type="image/x-icon">
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../css/register_style.css" />
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <title>Nagar-CT | Register</title>
</head>

<body>
  <img class="wave" src="../../assets/wave.png">
  <div class="container">

    <div class="img">
      <img src="../../assets/bg.svg">
    </div>

    <div class="login-content">

      <form action="#" class="sign-in-form">

        <div class="first">
          
            <h2 class="title">Sign Up</h2>
          
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Name" required />
          </div>

          <div class="input-field">
            <label for="gender"><i class="fas fa-venus-mars"></i></label>
            <select id="gender" name="gender"
              style="background: none; border: none; outline: none;font-size: 1.1rem; color: #2E6A50; width: 100%;">
              <option value="" disabled selected>Select your Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div class="input-field">
            <i class="fas fa-address-card"></i>
            <input type="text" placeholder="address" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" required />
          </div>
          <div class="input-field">
            <i class="fas fa-check"></i>
            <input type="password" placeholder="Confirm Password" required />
          </div>
          <button type="submit" class="btn solid">
            Register <i class="fas fa-arrow-right"></i>
          </button>
          <p class="social-text">Already have Account? Sign up <a href="login">here</a></p>
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
</body>
</html>