<?php session_start(); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .countdown {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: red;
        }
        .disabled {
            background-color: gray;
            cursor: not-allowed;
        }
        .resend-otp {
            display: none;
            margin-top: 10px;
        }
    </style>
    <script>
        let countdown = 119; // 1:59 in seconds
        function startCountdown() {
            let timerDisplay = document.getElementById("timer");
            let verifyButton = document.getElementById("verify-btn");
            let resendOtp = document.getElementById("resend-otp");

            let timer = setInterval(() => {
                let minutes = Math.floor(countdown / 60);
                let seconds = countdown % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                timerDisplay.innerText = `${minutes}:${seconds}`;
                countdown--;

                if (countdown < 0) {
                    clearInterval(timer);
                    timerDisplay.innerText = "00:00";
                    verifyButton.disabled = true;
                    verifyButton.classList.add("disabled");
                    resendOtp.style.display = "block";
                }
            }, 1000);
        }
    </script>
</head>
<body onload="startCountdown()">
    <div class="container">
        <h2>Enter OTP</h2>
        <p>Time left: <span class="countdown" id="timer">2:00</span></p>
        <form action="verify_otp_process.php" method="POST">
            <input type="text" name="otp" required placeholder="Enter OTP">
            <br><br>
            <button type="submit" id="verify-btn">Verify</button>
        </form>

        <div id="resend-otp" class="resend-otp">
            <p>OTP expired! <a href="resend_otp.php">Resend OTP</a></p>
        </div>
    </div>
</body>
</html>
