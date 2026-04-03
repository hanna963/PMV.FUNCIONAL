<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location: index.php"); exit(); }

// 1. Conexión a la base de datos (Puerto 3309)
$conexion = mysqli_connect("localhost", "root", "", "easy_vocabulary_db", "3309");

// 2. Obtenemos el tema de la URL
$tema = isset($_GET['tema']) ? mysqli_real_escape_string($conexion, $_GET['tema']) : 'Frutas';

// 3. Consulta limpia
$consulta = "SELECT * FROM vocabulario WHERE categoria = '$tema'";
$resultado = mysqli_query($conexion, $consulta);
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['usuario'])) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Easy Vocabulary - Temas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: #5DC1B9; font-family: sans-serif; text-align: center; padding: 20px;">

    <h1 style="color: #032a52; margin-top: 50px;">🍎 Elige un tema para aprender ⚽</h1>
    
    
    <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; margin-top: 40px;">
        
        <a href="ver_tema.php?tema=Fruit" style="text-decoration: none; color: inherit;">
            <div style="background: white; padding: 20px; border-radius: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.08); width: 150px; transition: 0.3s;">
                <span style="font-size: 50px;">🍎</span>
                <h3 style="margin-top: 10px; color: #333;">Fruit</h3>
            </div>
        </a>

        <a href="ver_tema.php?tema=Sports" style="text-decoration: none; color: inherit;">
            <div style="background: white; padding: 20px; border-radius: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.08); width: 150px; transition: 0.3s;">
                <span style="font-size: 50px;">⚽</span>
                <h3 style="margin-top: 10px; color: #333;">Sports</h3>
            </div>
        </a>

        <a href="ver_tema.php?tema=Colors" style="text-decoration: none; color: inherit;">
            <div style="background: white; padding: 20px; border-radius: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.08); width: 150px; transition: 0.3s;">
                <span style="font-size: 50px;">🎨</span>
                <h3 style="margin-top: 10px; color: #333;">Colors</h3>
            </div>
        </a>
        <a href="ver_tema.php?tema=Solar System" style="text-decoration: none; color: inherit;">
    <div style="background: white; padding: 20px; border-radius: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); width: 150px; text-align: center;">
        <span style="font-size: 50px;">☀️</span>
        <h3 style="margin-top: 10px; color: #333;">Solar System</h3>
    </div>
</a>

    </div>
    
    <br><br>
    <a href="inicio.php" style="color: #032a52; font-weight: bold; text-decoration: none;">🏠 Volver al inicio</a>

</body>
</html>