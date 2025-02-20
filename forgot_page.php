<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{asset('assets/css/forgot_page.css')}}">
</head>

<body>
    <form action="" method="post">
        @csrf
        <div class="row">
            <h1>Forgot Password</h1>
            <h5 class="information-text">Enter your email</h5>

            <div class="form-group">
                <input type="email" name="user_email" id="user_email">
                <p><label for="username"></label></p>
                <button>Confirm</button>
            </div>
            <div class="back">
                <a href="login_page.html">Back to Login Page</a>
            </div>
        </div>
    </form>
</body>

</html>