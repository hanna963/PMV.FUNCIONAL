<?php
session_start();
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $aciertos = 0;
    $total_preguntas = 0;

    foreach ($_POST as $key => $respuesta_usuario) {
        if (strpos($key, 'p') === 0) {
            $total_preguntas++;
            $id_pregunta = substr($key, 1);

            $consulta = mysqli_query($conexion, "SELECT respuesta_correcta FROM quices WHERE id = '$id_pregunta'");
            $fila = mysqli_fetch_assoc($consulta);

            if ($fila && $fila['respuesta_correcta'] == $respuesta_usuario) {
                $aciertos++;
            }
        }
    }

    // Guardar en la base de datos
    mysqli_query($conexion, "INSERT INTO resultados_quices (usuario_id, aciertos, total_preguntas) 
                             VALUES ('$usuario_id', '$aciertos', '$total_preguntas')");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Easy Vocabulary</title>
    <style>
        body {
            background: linear-gradient(135deg, #a8e6cf 0%, #dcedc1 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }
        .resultado-box {
            background: white;
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .emoji-resultado { font-size: 4rem; }
        h1 { color: #2d5a43; }
        .score { font-size: 2rem; font-weight: bold; color: #3b7a57; margin: 20px 0; }
        .btn-volver {
            display: inline-block;
            padding: 12px 25px;
            background: #3b7a57;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn-volver:hover { background: #2d5a43; transform: translateY(-3px); }
    </style>
</head>
<body>
    <div class="resultado-box">
        <div class="emoji-resultado">
            <?php echo ($aciertos == $total_preguntas) ? '🥳' : (($aciertos >= $total_preguntas/2) ? '🙂' : '😮'); ?>
        </div>
        <h1><?php echo ($aciertos == $total_preguntas) ? '¡Excelente trabajo!' : '¡Buen intento!'; ?></h1>
        <p>Has completado la evaluación de hoy.</p>
        <div class="score">
            <?php echo $aciertos; ?> / <?php echo $total_preguntas; ?>
        </div>
        <p>Tus aciertos han sido guardados en tu progreso.</p>
        <br>
        <a href="inicio.php" class="btn-volver">Volver al Inicio</a>
    </div>
</body>
</html>

<?php
} else {
    header("Location: inicio.php");
}
?>