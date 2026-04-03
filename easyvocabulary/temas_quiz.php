<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Easy Vocabulary - Temas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilo para que haga juego con tu degradado púrpura */
        body {
            background: linear-gradient(135deg, #9CE0DB 0%, #338B85 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        .temas-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 900px;
            width: 90%;
        }

        h1 { color: #4b3d8e; margin-bottom: 10px; }
        p { color: #666; margin-bottom: 30px; }

        .temas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }

        .card-tema {
            background: white;
            padding: 25px;
            border-radius: 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            border: 2px solid #f0f0f0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-tema:hover {
            transform: translateY(-10px);
            border-color: #764ba2;
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.2);
            background: #f8f9ff;
        }

        .emoji-grande {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .btn-volver {
            display: inline-block;
            margin-top: 30px;
            color: #764ba2;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        .btn-volver:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="temas-box">
        <h1>¡Elige tu desafío! 🚀</h1>
        <p>Selecciona un tema para poner a prueba tus conocimientos</p>

        <div class="temas-grid">
            <a href="hacer_quiz.php?cat=Animals" class="card-tema">
                <span class="emoji-grande">🐶</span>
                Animals
            </a>
            <a href="hacer_quiz.php?cat=Fruit" class="card-tema">
                <span class="emoji-grande">🍎</span>
                Fruit
            </a>
            <a href="hacer_quiz.php?cat=Colors" class="card-tema">
                <span class="emoji-grande">🎨</span>
                Colors
            </a>
            <a href="hacer_quiz.php?cat=Sports" class="card-tema">
                <span class="emoji-grande">⚽</span>
                Sports
            </a>
            <a href="hacer_quiz.php?cat=Solar System" class="card-tema">
                <span class="emoji-grande">☀️</span>
                Solar System
            </a>
            <a href="hacer_quiz.php?cat=Body" class="card-tema">
                <span class="emoji-grande">🧘</span>
                Body
            </a>
        </div>

        <a href="inicio.php" class="btn-volver">🏠 Volver al menú principal</a>
    </div>

</body>
</html>