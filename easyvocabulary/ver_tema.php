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


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aprendiendo <?php echo $tema; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: #f4f7f6; font-family: sans-serif; text-align: center; padding: 20px;">

    <h1 style="color: #764ba2;">Tema: <?php echo $tema; ?> 🌟</h1>
    <a href="vocabulario.php" style="text-decoration: none; color: #764ba2; font-weight: bold;">⬅ Volver a temas</a>

    <div style="display: flex; justify-content: center; gap: 25px; flex-wrap: wrap; margin-top: 40px;">
        
        <?php while($fila = mysqli_fetch_assoc($resultado)): ?>
            <div style="background: white; padding: 20px; border-radius: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); width: 220px;">
                
                <img src="img/<?php echo $fila['imagen_url']; ?>.png" 
                     alt="<?php echo $fila['palabra_en']; ?>" 
                     style="width: 120px; height: 120px; object-fit: contain;">
                
                <h2 style="color: #667eea; margin: 15px 0 5px;"><?php echo $fila['palabra_en']; ?></h2>
                <h4 style="color: #aaa; margin: 0; font-weight: normal;"><?php echo $fila['palabra_es']; ?></h4>
                
                <button onclick="playAudio('<?php echo $fila['audio_url']; ?>')" 
                        style="margin-top: 15px; background: #764ba2; color: white; border: none; padding: 8px 15px; border-radius: 15px; cursor: pointer;">
                    🔊 Escuchar
                </button>
            </div>
        <?php endwhile; ?>

    </div>

   <script>
    function playAudio(archivo) {
        // Esta línea construye la ruta a la carpeta 'audio/'
        var audio = new Audio("audio/" + archivo);
        
        // Esto le da la orden de sonar
        audio.play().catch(function(error) {
            console.error("No se pudo reproducir el audio: ", error);
            alert("No se encontró el archivo de audio: audio/" + archivo);
        });
    }
</script>

</body>
</html>