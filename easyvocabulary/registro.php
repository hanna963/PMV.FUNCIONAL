<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - easyvocabulary</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form action="procesar_registro.php" method="POST" class="login-form">
            <h2>Únete a easyvocabulary</h2>
            <p>Empieza a aprender inglés hoy mismo</p>

            <div class="input-group">
                <label>Nombre Completo</label>
                <input type="text" name="nombre" placeholder="Tu nombre" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="correo@ejemplo.com" required>
            </div>

            <div class="input-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Mínimo 6 caracteres" required>
            </div>

            <button type="submit" class="btn-login">Crear mi cuenta</button>

            <div class="footer-links">
                <span>¿Ya tienes cuenta? <a href="index.php">Inicia sesión</a></span>
            </div>
        </form>
    </div>
</body>
</html>