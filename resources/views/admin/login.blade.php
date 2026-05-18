<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-primary: #d50000;
            --color-primary-hover: #d50000;
            --color-primary-light: rgba(213, 0, 0, 0.07);
            --color-text: rgba(24, 24, 24, 1);
            --color-text-muted: rgba(127, 127, 127, 1);
            --color-text-light: rgba(103, 103, 103, 1);
            --color-white: rgba(255, 255, 255, 1);
            --color-bg: #ffffff;
            --color-bg-soft: #fcfcfc;
            --color-border: #e5e5e5;
            --color-shadow: rgba(231, 231, 231, 1);
            --font-main: 'Figtree', sans-serif;
            --border-radius-pill: 50px;
            --border-radius-card: 16px;
            --border-radius-lg: 24px;
            --transition-base: 0.2s ease;
            --transition-slow: 0.4s ease;
        }

        * {
            box-sizing: border-box;
            font-family: var(--font-main);
        }

        body {
            margin: 0;
            background-color: var(--color-bg-soft);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background-color: var(--color-white);
            padding: 40px 30px;
            border-radius: var(--border-radius-card);
            box-shadow: 0 4px 12px var(--color-shadow);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-card h1 {
            margin-bottom: 24px;
            color: var(--color-text);
            font-size: 28px;
            font-weight: 600;
        }

        .login-card form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .login-card input[type="email"],
        .login-card input[type="password"] {
            padding: 12px 16px;
            border-radius: var(--border-radius-pill);
            border: 1px solid var(--color-border);
            font-size: 16px;
            color: var(--color-text);
            transition: border var(--transition-base);
        }

        .login-card input[type="email"]:focus,
        .login-card input[type="password"]:focus {
            border-color: var(--color-primary);
            outline: none;
        }

        .login-card button {
            padding: 12px 16px;
            background-color: var(--color-primary);
            color: var(--color-white);
            border: none;
            border-radius: var(--border-radius-pill);
            font-size: 16px;
            cursor: pointer;
            transition: background-color var(--transition-base);
        }

        .login-card button:hover {
            background-color: var(--color-primary-hover);
        }

        .login-card .error-message {
            color: var(--color-primary);
            font-size: 14px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h1>Admin Login</h1>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>