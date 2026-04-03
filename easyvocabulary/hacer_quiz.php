<?php
session_start();
include("conexion.php");

// Verificamos sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

// 1. Capturamos la categoría que viene de temas_quiz.php
$categoria = isset($_GET['cat']) ? $_GET['cat'] : 'General';

// 2. Traemos 5 preguntas al azar de ESA categoría
$query = "SELECT * FROM quices WHERE categoria = '$categoria' ORDER BY RAND() LIMIT 5";
$resultado = mysqli_query($conexion, $query);

// Si no hay preguntas, mandamos un aviso amigable
if (mysqli_num_rows($resultado) == 0) {
    echo "<script>
            alert('¡Ups! Aún estamos preparando las preguntas de $categoria.');
            window.location.href = 'temas_quiz.php';
          </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Easy Vocabulary - <?php echo $categoria; ?></title>
    <style>
        body {
            background: linear-gradient(135deg, #a8e6cf 0%, #dcedc1 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .quiz-container {
            background: white;
            max-width: 600px;
            width: 100%;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        h2 { color: #2d5a43; text-align: center; }
        .pregunta-block {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            border-left: 5px solid #a8e6cf;
        }
        .opcion {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }
        .opcion:hover { background: #e0f2f1; }
        .btn-enviar {
            width: 100%;
            padding: 15px;
            background: #3b7a57;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-enviar:hover { background: #2d5a43; transform: scale(1.02); }
    </style>
</head>
<body>

<div class="quiz-container">
    <h2>Prueba de: <?php echo $categoria; ?></h2>
    <form action="procesar_quiz.php" method="POST">
        
        <?php while($row = mysqli_fetch_assoc($resultado)): ?>
            <div class="pregunta-block">
                <p><strong>¿<?php echo $row['pregunta']; ?>?</strong></p>
                
                <label class="opcion">
                    <input type="radio" name="p<?php echo $row['id']; ?>" value="a" required> 
                    <?php echo $row['opcion_a']; ?>
                </label>
                
                <label class="opcion">
                    <input type="radio" name="p<?php echo $row['id']; ?>" value="b"> 
                    <?php echo $row['opcion_b']; ?>
                </label>
                
                <label class="opcion">
                    <input type="radio" name="p<?php echo $row['id']; ?>" value="c"> 
                    <?php echo $row['opcion_c']; ?>
                </label>
                
                <label class="opcion">
                    <input type="radio" name="p<?php echo $row['id']; ?>" value="d"> 
                    <?php echo $row['opcion_d']; ?>
                </label>
            </div>
        <?php endwhile; ?>

        <button type="submit" class="btn-enviar">Terminar Evaluación ✨</button>
    </form>
</div>

</body>
</html>