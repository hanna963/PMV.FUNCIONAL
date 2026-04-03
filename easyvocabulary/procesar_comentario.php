<?php
session_start();
// Tu conexión de confianza
$conexion = mysqli_connect("localhost", "root", "", "easy_vocabulary_db", "3309");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si no hay sesión, usamos 'Invitado'
    $nombre = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
    $mensaje = mysqli_real_escape_string($conexion, $_POST['mensaje']);

    $sql = "INSERT INTO comentarios (nombre_usuario, mensaje) VALUES ('$nombre', '$mensaje')";

    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('¡Gracias por tu comentario!'); window.location.href='inicio.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>