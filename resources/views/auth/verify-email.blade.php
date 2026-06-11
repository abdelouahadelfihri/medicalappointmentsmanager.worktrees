<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Medical Appointments Manager</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            padding: 20px 0;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .auth-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .auth-header {
            background: linear-gradient(135deg, #B0C4DE 0%, #A0B4CE 100%);
            padding: 40px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .auth-header i {
            font-size: 3rem;
            color: #000;
            margin-bottom: 15px;
        }

        .auth-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #000;
            margin: 0;
        }

        .auth-header p {
            color: #333;
            margin: 10px 0 0 0;
            font-size: 0.95rem;
        }

        .auth-body {
            padding: 40px;
        }

        .verification-message {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .verification-message h4 {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .verification-message p {
            margin: 0 0 10px 0;
            line-height: 1.6;
        }

        .email-display {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #B0C4DE;
            margin-bottom: 30px;
        }

        .email-display strong {
            display: block;
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 5px;
        }

        .email-display .email-address {
            font-size: 1.1rem;
            color: #000;
            word-break: break-all;
        }

        .btn-verify {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            background: #B0C4DE;
            color: #000;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }

        .btn-verify:hover {
            background: #A0B4CE;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(176, 196, 222, 0.4);
        }

        .btn-secondary-action {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: white;
            color: #000;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }

        .btn-secondary-action:hover {
            background: #f8f9fa;
            border-color: #B0C4DE;
        }

        .footer-text {
            text-align: center;
            color: #666;
            font-size: 0.9rem;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .footer-text a {
            color: #B0C4DE;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .steps {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .steps h5 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .step-item {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .step-item:last-child {
            margin-bottom: 0;
        }

        .step-number {
            background: #B0C4DE;
            color: #000;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            flex-shrink: 0;
        }

        .step-content p {
            margin: 0;
            color: #666;
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="bi bi-envelope-check"></i>
                <h1>Verify Your Email</h1>
                <p>Complete the verification process</p>
            </div>

            <div class="auth-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="verification-message">
                    <h4><i class="bi bi-info-circle"></i> Email Verification Required</h4>
                    <p>To complete your registration, please verify your email address. We've sent you a verification link.</p>
                </div>

                <div class="email-display">
                    <strong><i class="bi bi-envelope"></i> Verification email sent to:</strong>
                    <div class="email-address">{{ auth()->user()->email }}</div>
                </div>

                <div class="steps">
                    <h5>What to do next:</h5>
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <p>Check your email inbox and spam folder for our verification email</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <p>Click the "Verify Email" link in the email</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <p>You'll be redirected to the dashboard after verification</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('verification.resend') }}" method="POST" style="margin-bottom: 15px;">
                    @csrf
                    <button type="submit" class="btn-verify">
                        <i class="bi bi-arrow-repeat"></i> Resend Verification Email
                    </button>
                </form>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-secondary-action">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>

                <div class="footer-text">
                    <p>Wrong email address? <a href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout and register again</a></p>
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
