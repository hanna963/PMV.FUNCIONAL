<?php
$servidor = "localhost:3309"; // Añadimos el puerto aquí
$usuario  = "root";
$clave    = ""; 
$base_datos = "easy_vocabulary_db"; 

// Intentamos la conexión
$conexion = mysqli_connect($servidor, $usuario, $clave, $base_datos);

if (!$conexion) {
    echo "<h1>Error de conexión</h1>";
    // Esto nos dirá si el puerto sigue siendo el problema
    echo "Detalle: " . mysqli_connect_error();
    exit();
}

mysqli_set_charset($conexion, "utf8");
?>