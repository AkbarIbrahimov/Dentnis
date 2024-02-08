<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Dashboard</title>
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #3498db;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 400px;
        }

        .login-header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h2 {
            margin: 0;
            font-size: 24px;
        }

        .login-form {
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        form{
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px 0;
            color: #555;
            font-weight: bold;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: #555;
        }

        button {
            padding: 12px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .forgot-password {
            color: #3498db;
            text-decoration: none;
            margin-top: 10px;
            align-self: flex-end;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h2>Login</h2>
    </div>
    <div class="login-form">
        <form action="{{route('admin.authenticate')}}" method="post">
            @csrf
        <label for="username">Email:</label>
        <input type="email" id="username" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <div class="remember-me">
            <input type="checkbox" id="rememberMe" name="rememberMe">
            <label for="rememberMe">Remember Me</label>
        </div>

        <button type="submit">Login</button>
        </form>
        <a href="#" class="forgot-password">Forgot your password?</a>
    </div>
</div>
</body>
</html>
