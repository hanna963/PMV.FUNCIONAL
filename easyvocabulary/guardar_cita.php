<?php
session_start();
include 'conexion.php';

// Verificamos qué llega para estar seguros
if (isset($_POST['fecha']) && isset($_POST['hora']) && isset($_SESSION['usuario_id'])) {
    
    $usuario_id = $_SESSION['usuario_id']; 
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Insertamos
    $query = "INSERT INTO citas (usuario_id, fecha, hora, estado) 
              VALUES ('$usuario_id', '$fecha', '$hora', 'pendiente')";
    
    if (mysqli_query($conexion, $query)) {
        echo "success";
    } else {
        echo "Error de base de datos: " . mysqli_error($conexion);
    }
} else {
    // Esto nos dirá qué falta exactamente
    if(!isset($_SESSION['usuario_id'])) {
        echo "Error: El ID de usuario no está en la sesión. ¡Cierra sesión y vuelve a entrar!";
    } else {
        echo "Error: Faltan datos de fecha u hora.";
    }
}
?>