<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login – Yono Apps Portal</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Login Page Stylesheet -->
    <style>
        :root {
            --bg-color: #090d16;
            --glass-bg: rgba(17, 24, 39, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-muted: #64748b;
            --accent-gradient: linear-gradient(135deg, #3b82f6, #8b5cf6);
            --danger-color: #f87171;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top right, #1e1b4b, var(--bg-color) 70%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Glassmorphic Login Container Card */
        .login-card {
            width: 100%;
            max-width: 400px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .login-header {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .login-logo {
            background: var(--accent-gradient);
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
            margin-bottom: 8px;
        }

        .login-title {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .login-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Form Inputs */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text-main);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px 12px 42px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: white;
            font-size: 13.5px;
            font-family: inherit;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #3b82f6;
            background: rgba(255,255,255,0.06);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .remember-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .remember-checkbox {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 13px;
            background: var(--accent-gradient);
            color: white;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25);
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        /* Validation Alerts */
        .validation-errors {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12px;
            color: var(--danger-color);
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        
        .validation-errors ul {
            list-style: none;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <div class="login-logo">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h2 class="login-title">Admin Dashboard</h2>
            <span class="login-subtitle">Enter your credentials to secure access</span>
        </div>

        <!-- Validation errors -->
        @if ($errors->any())
            <div class="validation-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('admin.login') }}" method="POST" class="login-form">
            @csrf
            
            <div class="form-group">
                <label for="email">Admin Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="name@example.com" value="{{ old('email') }}" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
                </div>
            </div>

            <div class="remember-section">
                <label class="remember-checkbox">
                    <input type="checkbox" name="remember" style="accent-color: #3b82f6;">
                    <span>Remember me</span>
                </label>
                <a href="{{ route('home') }}" style="color: var(--accent-color); text-decoration: none;">Back to Site</a>
            </div>

            <button type="submit" class="login-btn">Log In Access</button>
        </form>
    </div>
</body>
</html>
