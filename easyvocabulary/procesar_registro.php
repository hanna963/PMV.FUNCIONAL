<?php
// 1. Conexión con el nombre exacto de tu imagen y el puerto 3309
$conexion = mysqli_connect("localhost", "root", "", "easy_vocabulary_db", "3309");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 2. Recogemos los datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // 3. Insertamos usando 'nombre_completo' que es el nombre en tu tabla
    $sql = "INSERT INTO usuarios (nombre_completo, email, password) VALUES ('$nombre', '$email', '$password')";

    if (mysqli_query($conexion, $sql)) {
        // Si funciona, nos manda al login
        header("Location: index.php?registro=exito");
        exit();
    } else {
        echo "Error al guardar: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>