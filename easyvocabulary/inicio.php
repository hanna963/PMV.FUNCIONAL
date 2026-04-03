<?php
session_start();


if (!isset($_SESSION['usuario'])) { header("Location: index.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Vocabulary - Home</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #c8e9dd;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        h1 { color: #4a90e2; }
        .menu-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-top: 30px;
        }
        .card {
            background: #4a90e2;
            color: white;
            padding: 20px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            transition: transform 0.2s, background 0.2s;
        }
        .card:hover {
            background: #357abd;
            transform: scale(1.02);
        }
        .logout {
            margin-top: 20px;
            display: inline-block;
            color: #888;
            text-decoration: none;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Hello, <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Learner"; ?>!</h1>
        <p>¿Qué quieres practicar hoy?</p>

        <div class="menu-grid">
            <a href="vocabulario.php" class="card">📚 My Vocabulary</a>
            <a href="temas_quiz.php" class="card">🧠 Flashcards Quiz</a>
            <a href="clases_envivo.php" class="card">📺 Live Classes</a>
            <a href="mis_resultados.php" class="card">📈 Mi Progreso</a>
        </div>

        <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>
<div class="comentarios-container" style="margin: 20px auto; max-width: 500px; padding: 20px; background: #fff; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    <h3>💬 Cuéntanos tu experiencia</h3>
    <form action="procesar_comentario.php" method="POST">
        <textarea name="mensaje" placeholder="Escribe aquí tu comentario..." required style="width: 100%; height: 100px; border-radius: 10px; border: 1px solid #ddd; padding: 10px; font-family: sans-serif;"></textarea>
        <button type="submit" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 10px 20px; border-radius: 20px; cursor: pointer; margin-top: 10px; width: 100%;">
            Enviar Comentario
        </button>
    </form>
    <div class="lista-comentarios" style="margin-top: 30px; text-align: left;">
    <h4 style="color: #764ba2; border-bottom: 2px solid #eee; padding-bottom: 10px;">💬 Lo que dicen otros aventureros:</h4>
    
    <?php
    // 1. Conectamos a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "easy_vocabulary_db", "3309");

    // 2. Pedimos todos los comentarios, los más nuevos primero
    $consulta = "SELECT nombre_usuario, mensaje, fecha FROM comentarios ORDER BY fecha DESC";
    $resultado = mysqli_query($conexion, $consulta);

    // 3. Los mostramos uno por uno
    if (mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<div style='background: #fdfdfd; padding: 15px; border-radius: 12px; margin-bottom: 15px; border: 1px solid #eee; box-shadow: 2px 2px 5px rgba(0,0,0,0.02);'>";
            echo "<strong style='color: #667eea;'>" . htmlspecialchars($fila['nombre_usuario']) . "</strong>";
            echo "<small style='color: #aaa; float: right;'>" . $fila['fecha'] . "</small>";
            echo "<p style='margin: 8px 0 0; color: #555;'>" . htmlspecialchars($fila['mensaje']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p style='color: #999; text-align: center;'>¡Sé el primero en dejar un comentario!</p>";
    }

    mysqli_close($conexion);
    ?>
</div>
</div>
</body>
</html>