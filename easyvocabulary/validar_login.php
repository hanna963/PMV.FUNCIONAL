<?php
include("conexion.php");
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Consultamos al usuario
$consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
$usuario = mysqli_fetch_assoc($consulta);

if ($usuario && password_verify($password, $usuario['password'])) {
    // Guardamos los datos en la sesión
    $_SESSION['usuario'] = $usuario['nombre_completo'];
    $_SESSION['usuario_id'] = $usuario['id']; 
    
    header("Location: inicio.php");
    exit();
} else {
    echo '<script>alert("Datos incorrectos"); window.location="index.php";</script>';
}
?>