<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Consultamos tus resultados reales de la base de datos
$query = "SELECT aciertos, total_preguntas, fecha_intento FROM resultados_quices WHERE usuario_id = '$usuario_id' ORDER BY fecha_intento DESC";
$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Notas - Easy Vocabulary</title>
    <style>
        body {
            background: linear-gradient(135deg, #9CE0DB 0%, #338B85 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .container-resultados {
            background: white;
            max-width: 700px;
            width: 100%;
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 { color: #2d5a43; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #a8e6cf; color: #2d5a43; padding: 12px; }
        td { padding: 12px; border-bottom: 1px solid #eee; color: #555; }
        .score-badge { background: #3b7a57; color: white; padding: 5px 10px; border-radius: 15px; }
        .btn-volver { display: inline-block; margin-top: 30px; color: #3b7a57; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="container-resultados">
    <h1>📈 Mi Progreso</h1>
    <table>
        <thead>
            <tr>
                <th>Fecha y Hora</th>
                <th>Puntaje</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo date('d/m/Y H:i', strtotime($fila['fecha_intento'])); ?></td>
                <td><span class="score-badge"><?php echo $fila['aciertos']; ?> / <?php echo $fila['total_preguntas']; ?></span></td>
                <td>
                    <?php 
                    if ($fila['total_preguntas'] > 0) {
                        $porcentaje = ($fila['aciertos'] / $fila['total_preguntas']) * 100;
                        echo ($porcentaje >= 60) ? '✅ Aprobado' : '❌ Repasar';
                    }
                    ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="inicio.php" class="btn-volver">🏠 Volver al inicio</a>
</div>

</body>
</html>