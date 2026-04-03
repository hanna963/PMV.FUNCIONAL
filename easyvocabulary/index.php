<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LexiFlow - Login</title>
    <link rel="stylesheet" href="style.css?v=1.1">
</head>
<body>
    <div class="login-container">
        <form action="validar_login.php" method="POST" class="login-form">
            <h2>Welcome Back!</h2>
            <p>Ready to boost your vocabulary?</p>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="........" required>
            </div>

            <button type="submit" class="btn-login">Start Learning</button>

            <div class="footer-links">
                <a href="#">Forgot password?</a>
                <hr style="margin: 15px 0; border: 0; border-top: 1px solid #eee;">
                <span>¿Eres nuevo aquí? <a href="registro.php" style="font-weight: bold; color: #764ba2;">Create an Account</a></span>
            </div>
        </form>
    </div>
</body>
</html>