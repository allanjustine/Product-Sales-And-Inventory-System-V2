<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .email-header img {
            width: 150px;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="email-container">

        <p>Hello <strong>{{ $user->name }}</strong>,</p>
        <p>Thank you for registering with us. Please click the button below to verify your email address and complete
            your registration:</p>

        <a target="_blank" href="{{ url("/verification/" . $user->remember_token . "/" . $user->id) }}" class="btn">Verify Email</a>

        <div class="footer">
            <p>If you did not register, no further action is required.</p>
            <p>&copy; {{ date('Y') }} AJM Website. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
