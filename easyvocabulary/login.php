<?php
include("conexion.php");

$email = $_POST['email'];
$password = $_POST['password'];

$consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
$usuario = mysqli_fetch_assoc($consulta);

if ($usuario && password_verify($password, $usuario['password'])) {
    // Si la contraseña es correcta, iniciamos sesión
    session_start();
    $_SESSION['usuario'] = $usuario['nombre_completo'];
    header("Location: vocabulario.php"); // Lo mandamos a la página de vocabulario
} else {
    echo '<script>alert("Correo o contraseña incorrectos"); window.location="index.html";</script>';
}
?>