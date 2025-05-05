<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            letter-spacing: 4px;
            margin: 20px 0;
        }
        .footer {
            font-size: 12px;
            color: #6b7280;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello, {{ $username }}!</h2>
        <p>Thank you for registering. Please use the following OTP code to verify your email address:</p>

        <div class="otp-code">{{ $otp }}</div>

        <p>This code will expire in 10 minutes. If you didn’t request this, you can ignore this email.</p>

        <p>Thank you,<br><strong>Roomora</strong></p>

        <div class="footer">
            &copy; {{ date('Y') }} Roomora. All rights reserved.
        </div>
    </div>
</body>
</html>
