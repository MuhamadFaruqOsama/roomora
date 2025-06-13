<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Booking Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: auto;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.05);
        }
        h2 {
            color: #111827;
            margin-bottom: 10px;
        }
        .message {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        .booking-response {
            font-weight: 700;
            font-size: 20px;
            padding: 12px 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
            letter-spacing: 1px;
        }
        .admin-message {
            background: rgb(237, 237, 237);
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table tr:nth-child(odd) {
            background-color: #f9fafb;
        }
        table tr:nth-child(even) {
            background-color: #ffffff;
        }
        table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }
        table td:first-child {
            font-weight: 600;
            width: 30%;
        }
        .footer {
            font-size: 12px;
            color: #6b7280;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello, {{ $data['username'] }}!</h2>

        <p class="message">
            Thank you for your complaint. We have fixed and handled your complaint..
        </p>

        <p class="message">Here is a message from the admin:</p>

        <p class="admin-message">
            {{ $data['response'] }}
        </p>

        <p class="message">Here your complaint detail:</p>

        <table>
            <tr>
                <td>Complaint ID</td>
                <td>#{{ $data['id'] }}</td>
            </tr>
            <tr>
                <td>Class</td>
                <td>{{ $data['class_room'] }}</td>
            </tr>
            <tr>
                <td>Title</td>
                <td>{{ $data['title'] }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $data['desc'] }}</td>
            </tr>
            <tr>
                <td>Response</td>
                <td>{{ $data['response'] }}</td>
            </tr>
        </table>

        <p class="message">
            Thank you,<br>
            <strong>Roomora Team</strong>
        </p>

        <div class="footer">
            &copy; {{ date('Y') }} Roomora. All rights reserved.
        </div>
    </div>
</body>
</html>
