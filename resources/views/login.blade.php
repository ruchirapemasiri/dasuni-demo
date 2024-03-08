<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        body {
            background-color: #222;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 300px;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"],
        button {
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }

        input[type="email"],
        input[type="password"] {
            background-color: #444;
            color: #fff;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .center {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2vh;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="center">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="center">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
