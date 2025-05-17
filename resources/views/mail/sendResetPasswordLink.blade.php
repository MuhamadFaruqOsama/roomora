<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
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
        }
        .btn-reset {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2563eb;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin: 20px 0;
        }
        .btn-reset:hover {
            background-color: #1d4ed8;
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
        <p>You recently requested to reset your password. Click the button below to proceed:</p>

        <a href="{{ $url }}" class="btn-reset">Reset Password</a>

        <p>If you did not request a password reset, please ignore this email.</p>

        <p>Thank you,<br><strong>Roomora Team</strong></p>

        <div class="footer">
            &copy; {{ date('Y') }} Roomora. All rights reserved.
        </div>
    </div>
</body>
</html>
