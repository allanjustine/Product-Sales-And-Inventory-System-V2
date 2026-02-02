<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - AJM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #374151;
            line-height: 1.6;
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.08),
                0 0 0 1px rgba(0, 0, 0, 0.02);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .email-container:hover {
            transform: translateY(-4px);
            box-shadow:
                0 24px 72px rgba(0, 0, 0, 0.12),
                0 0 0 1px rgba(0, 0, 0, 0.03);
        }

        .email-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            padding: 40px 40px 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            background:
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        .logo-container {
            position: relative;
            z-index: 1;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .logo-circle img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .header-subtitle {
            font-size: 16px;
            font-weight: 400;
            opacity: 0.9;
            max-width: 80%;
            margin: 0 auto;
            color: white;
        }

        .email-content {
            padding: 40px;
        }

        .greeting {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 24px;
            line-height: 1.3;
        }

        .greeting strong {
            color: #0d6efd;
            font-weight: 700;
        }

        .message {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 24px;
        }

        .message p {
            margin-bottom: 16px;
        }

        .message p:last-child {
            margin-bottom: 0;
        }

        .verification-section {
            text-align: center;
            margin: 32px 0;
        }

        .verification-button {
            display: inline-block;
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
            text-decoration: none;
            padding: 18px 42px;
            font-size: 17px;
            font-weight: 600;
            border-radius: 14px;
            letter-spacing: 0.2px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            box-shadow:
                0 8px 24px rgba(13, 110, 253, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .verification-button:hover {
            transform: translateY(-2px);
            box-shadow:
                0 12px 32px rgba(13, 110, 253, 0.35),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .verification-button:active {
            transform: translateY(0);
        }

        .verification-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .verification-button:hover::after {
            opacity: 1;
        }

        .button-icon {
            margin-right: 10px;
            font-size: 18px;
        }

        .security-note {
            text-align: center;
            margin: 24px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            border-left: 4px solid #0d6efd;
        }

        .security-icon {
            font-size: 20px;
            color: #0d6efd;
            margin-bottom: 12px;
        }

        .security-text {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
        }

        .expiration-notice {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border-radius: 12px;
            padding: 20px;
            margin: 32px 0;
            border: 1px solid #ffecb5;
            text-align: center;
        }

        .expiration-icon {
            font-size: 24px;
            color: #e6a700;
            margin-bottom: 12px;
        }

        .expiration-text {
            font-size: 14px;
            color: #856404;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .expiration-timer {
            font-size: 18px;
            font-weight: 700;
            color: #e6a700;
        }

        .direct-link {
            margin: 24px 0;
            padding: 20px;
            background: #f9fafb;
            border-radius: 12px;
            word-break: break-all;
        }

        .direct-link-title {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .direct-link-url {
            font-size: 13px;
            color: #0d6efd;
            text-decoration: none;
            line-height: 1.4;
        }

        .email-footer {
            background: #f8f9fa;
            padding: 40px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .footer-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: #0d6efd;
        }

        .footer-disclaimer {
            font-size: 12px;
            color: #9ca3af;
            line-height: 1.5;
            max-width: 80%;
            margin: 0 auto 20px;
        }

        .footer-copyright {
            font-size: 12px;
            color: #9ca3af;
        }

        @media (max-width: 640px) {
            body {
                padding: 20px 12px;
            }

            .email-header {
                padding: 30px 20px 15px;
            }

            .email-content {
                padding: 30px 20px;
            }

            .greeting {
                font-size: 22px;
            }

            .verification-button {
                padding: 16px 32px;
                font-size: 16px;
                width: 100%;
                max-width: 280px;
            }

            .footer-links {
                flex-direction: column;
                gap: 12px;
            }

            .email-footer {
                padding: 30px 20px;
            }

            .header-subtitle {
                max-width: 100%;
            }

            .logo-circle {
                width: 70px;
                height: 70px;
            }

            .logo-circle img {
                width: 50px;
                height: 50px;
            }
        }

        @media screen and (max-width: 480px) {
            .email-container {
                border-radius: 16px;
            }
        }

        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            }

            .email-container {
                background: #2d2d2d;
                box-shadow:
                    0 20px 60px rgba(0, 0, 0, 0.3),
                    0 0 0 1px rgba(255, 255, 255, 0.05);
            }

            .greeting {
                color: #f3f4f6;
            }

            .message {
                color: #d1d5db;
            }

            .security-note {
                background: #374151;
            }

            .direct-link {
                background: #374151;
            }

            .direct-link-title {
                color: #d1d5db;
            }

            .email-footer {
                background: #1f2937;
                border-top-color: #374151;
            }

            .footer-link {
                color: #9ca3af;
            }

            .footer-disclaimer,
            .footer-copyright {
                color: #6b7280;
            }
        }

        @media print {
            body {
                background: white !important;
                padding: 0;
            }

            .email-container {
                box-shadow: none !important;
                border: 1px solid #ddd;
            }

            .verification-button {
                background: #0d6efd !important;
                color: white !important;
                box-shadow: none !important;
            }

            .email-header {
                background: #0d6efd !important;
                color: white !important;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <div class="header-background"></div>
            <div class="logo-container">
                <h1 class="header-title" style="color: white;">Email Verification</h1>
                <p class="header-subtitle">Welcome to AJM! Let's get you verified</p>
            </div>
        </div>

        <div class="email-content">
            <div class="greeting">
                Hello <strong>{{ $user?->name }}</strong>,
            </div>

            <div class="message">
                <p>Welcome to AJM! We're excited to have you join our community.</p>
                <p>To ensure the security of your account and complete your registration, please verify your email
                    address by clicking the button below.</p>
            </div>

            <div class="verification-section">
                <a href="{{ url('/verification/' . $user?->remember_token . '/' . $user?->id) }}" target="_blank"
                    class="verification-button">
                    <span class="button-icon">✓</span>Verify Email Address
                </a>
            </div>

            <div class="security-note">
                <div class="security-icon">🔒</div>
                <p class="security-text">This verification link ensures that only you can access your AJM account.</p>
            </div>

            <div class="direct-link">
                <div class="direct-link-title">Or copy and paste this link in your browser:</div>
                <a href="{{ url('/verification/' . $user?->remember_token . '/' . $user?->id) }}" class="direct-link-url">
                    {{ url('/verification/' . $user?->remember_token . '/' . $user?->id) }}
                </a>
            </div>
        </div>

        <div class="email-footer">
            <div class="footer-links">
                <a href="{{ url('/') }}" class="footer-link">Visit Website</a>
                <a href="{{ url('/about-us') }}" class="footer-link">About Us</a>
                <a href="{{ url('/contact') }}" class="footer-link">Contact Support</a>
            </div>

            <div class="footer-disclaimer">
                <p>If you did not register for an AJM account, you can safely ignore this email. No further action is
                    required.</p>
                <p>For security reasons, please do not share this email with anyone.</p>
            </div>

            <div class="footer-copyright">
                <p>&copy; {{ date('Y') }} AJM Website. All rights reserved.</p>
                <p>This is an automated message, please do not reply to this email.</p>
            </div>
        </div>
    </div>
</body>

</html>
