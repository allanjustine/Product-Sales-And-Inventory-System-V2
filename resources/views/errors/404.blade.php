<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .error-container {
            text-align: center;
            margin-top: 30px;
        }

        .error-code {
            font-size: 72px;
            font-weight: bold;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .error-message {
            font-size: 24px;
            color: #343a40;
            margin-bottom: 30px;
        }

        .error-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-container">
            <div class="error-code">404</div>
            <div class="error-message">Oops! Page not found. {{ url()->current() }}</div>
            <img src="https://www.cyberlink.com/support-center/something_wrong.png" alt="Sad Cartoon Image" class="error-image w-25">
            <p class="lead">The page you are looking for might have been removed, had its name changed, or is
                temporarily unavailable.</p>
            <a href="/" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</body>

</html>
