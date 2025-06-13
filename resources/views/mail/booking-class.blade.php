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
        .accepted {
            background-color: #ecfdf5;
            color: #059669;
        }
        .rejected {
            background-color: #fef2f2;
            color: #dc2626;
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
            Thank you for booking a class with <strong>Roomora</strong>. Your booking has been received and is currently being processed.
        </p>

        <p class="message">Your booking status is:</p>

        {{-- Ubah antara "accepted" atau "rejected" --}}
        <div class="booking-response {{ $data['status'] == 'accepted' ? 'accepted' : 'rejected' }}">
            {{ $data['status'] == 'accepted' ? 'ACCEPTED' : 'REJECTED' }}
        </div>
        <!--
        <div class="booking-response rejected">
            REJECTED
        </div>
        -->

        <p class="message">Here are the details of your booking:</p>

        <table>
            <tr>
                <td>Booking ID</td>
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
            Or you can visit the app trough this link: <a href="https://roomora.test/app/response/{{ $data['history_id'] }}">open detail</a>. If you didn’t make this request, you can safely ignore this message.
        </p>

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
